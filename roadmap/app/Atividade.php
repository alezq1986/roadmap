<?php

namespace App;

use App\Projeto;
use App\Competencia;
use App\Alocacao;
use App\Roadmap;
use App\Recurso;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Atividade extends Model
{
    protected $fillable =
        ['atividade_codigo', 'projeto_id',
            'descricao', 'competencia_id',
            'prazo', 'data_inicio_real',
            'data_fim_real', 'recurso_real_id',
            'percentual_real'
        ];

    public function projeto()
    {
        return $this->belongsTo('App\Projeto');
    }

    public function competencia()
    {
        return $this->belongsTo('App\Competencia');
    }

    public function alocacoes()
    {
        return $this->hasMany('App\Alocacao');
    }

    public function depende_para()
    {
        return $this->belongsToMany('App\Atividade', 'atividade_dependencia', 'dependencia_id', 'atividade_id');
    }

    public function depende_de()
    {
        return $this->belongsToMany('App\Atividade', 'atividade_dependencia', 'atividade_id', 'dependencia_id');
    }

    public function prioridade($roadmap)
    {
        $prioridade = integerValue(DB::table('projeto_roadmap')->where('projeto_id', '=', $this->projeto->id)->first()->prioridade);
    }

    public static function criarDependencias(Projeto $projeto)
    {

        $atividades = $projeto->atividades;

        if ($atividades->count() == 0) {

            return null;
        }
        $contador_testes = 0;

        foreach ($atividades as $atividade) {

            if ($atividade->competencia_id == 5) {

                $contador_testes++;
            }

            $ap = array();

            switch ($atividade->competencia_id) {

                case 1:

                    $ap = [4];

                    break;

                case 2:

                    $ap = [4];

                    break;

                case 3:

                    $ap = [4];

                    break;

                case 4:

                    break;

                case 5:
                    if ($contador_testes > 1) {

                        $ap = [5];

                    } else {

                        $ap = [1, 2, 3];

                    }

                    break;

                case 6:

                    $ap = [1];

                    break;

                case 7:

                    $ap = [2];

                    break;

                case 8:

                    $ap = [3];

                    break;
            }

            if ($contador_testes > 1 && $atividade->competencia_id == 5) {

                $atividades_predecessoras = Atividade::where('projeto_id', '=', $atividade->projeto->id)->whereIn
                ('competencia_id', $ap)->orderBy('atividade_codigo', 'ASC')->skip($contador_testes - 2)->limit(1)->get();

            } else {

                $atividades_predecessoras = Atividade::where('projeto_id', '=', $atividade->projeto->id)->whereIn
                ('competencia_id', $ap)->get();

            }

            if ($atividades_predecessoras->isNotEmpty()) {

                foreach ($atividades_predecessoras as $atividade_predecessora) {

                    $ap = DB::table('atividade_dependencia')->insert([
                        'atividade_id' => $atividade->id,
                        'dependencia_id' => $atividade_predecessora->id
                    ]);

                }
            }

        }
    }

    public static function atualizarAtividades(Request $request)
    {

        $dados = json_decode($request->get('dados'), true);

        $limpar_recursos = $dados['parametros']['limpar_recursos'];

        unset($dados['parametros']['limpar_recursos']);

        foreach ($dados['atividades'] as $k => $v) {

            unset($v['equipe_id']);

            unset($v['competencia_id']);

            $data_base = Roadmap::find($dados['parametros']['roadmap_id'])->data_base;

            if ($v['data_inicio_proj'] <= $data_base) {

                $v['data_inicio_real'] = $v['data_inicio_proj'];
            }

            if ($v['percentual_real'] == 100) {

                $v['data_fim_real'] = $v['data_fim_proj'];


            } elseif ($v['percentual_real'] == 0) {

                if ($limpar_recursos) {

                    $v['recurso_real_id'] = null;

                } else {

                    unset($v['recurso_real_id']);

                }

            }

            unset($v['data_inicio_proj']);

            unset($v['data_fim_proj']);

            $a = Atividade::find($k);

            $a->fill($v);

            $a->save();
        }

    }


    public function alocarAtividade(Roadmap $roadmap)
    {
        ini_set('memory_limit', '512M');

        $lista_negra = collect();

        //se a atividade está concluída, apenas repito os dados na alocação
        if ($this->percentual_real == 100) {

            $data_inicio_proj = $this->data_inicio_real;

            $data_fim_proj = $this->data_fim_real;

            $recurso_id = $this->recurso_real_id;

        } else {

            //se não está, mas já tenho recurso alocado...
            if (!is_null($this->recurso_real_id)) {

                $recurso_id = $this->recurso_real_id;

                $recurso = Recurso::find($recurso_id);

                //... e ele já iniciou a atividade, eu repito a data de início na alocação...
                if (!is_null($this->data_inicio_real)) {

                    $data_inicio_proj = $this->data_inicio_real;

                    //...senão eu calculo a data de início
                } else {

                    $data_inicio_proj = $recurso->calcularPrimeiraData($this, $roadmap);

                    //se não há data de início possível, eu passo o recurso para a lista negra e aloco a atividade de novo...
                    if (is_null($data_inicio_proj)) {

                        $lista_negra->push($recurso);

                        $melhor_recurso = $this->calcularMelhorRecurso($roadmap, $lista_negra);

                        //se eu conseguir alocar, crio os dados da alocação...
                        if (!is_null($melhor_recurso['recurso'])) {

                            $recurso = $melhor_recurso['recurso'];

                            $recurso_id = $recurso->id;

                            $data_inicio_proj = $melhor_recurso['data'];

                            //... mas se eu não conseguir, retorno null
                        } else {

                            return null;

                        }

                    }
                }

                //com os dados da alocação, calculo a data final
                $data_fim_proj = $this->calcularDataFimPorPercentual($roadmap, $recurso, $data_inicio_proj);

                //se ela passou a data fim do recurso...
                if ($data_fim_proj > $recurso->data_fim) {

                    $melhor_recurso = $this->calcularMelhorRecurso($roadmap);

                    //aloco de novo
                    if (!is_null($melhor_recurso['recurso'])) {

                        $recurso = $melhor_recurso['recurso'];

                        $recurso_id = $recurso->id;

                        $data_inicio_proj = $melhor_recurso['data'];

                    } else {

                        return null;

                    }

                    $data_fim_proj = $this->calcularDataFimPorPercentual($roadmap, $recurso, $data_inicio_proj);

                }

                //se não tem recurso alocado, eu aloco do 0
            } else {

                $melhor_recurso = $this->calcularMelhorRecurso($roadmap);

                if (!is_null($melhor_recurso['recurso'])) {

                    $recurso = $melhor_recurso['recurso'];

                    $recurso_id = $recurso->id;

                    $data_inicio_proj = $melhor_recurso['data'];

                } else {

                    return null;

                }

                $data_fim_proj = $this->calcularDataFimPorPercentual($roadmap, $recurso, $data_inicio_proj);

            }

        }

        Log::info('alocacao', ['atividade' => $this]);

        //crio a alocação
        $alocacao = new Alocacao (['roadmap_id' => $roadmap->id, 'atividade_id' => $this->id,
            'data_inicio_proj' => $data_inicio_proj, 'data_fim_proj' => $data_fim_proj, 'recurso_id' => $recurso_id]);

        //atualizo o recurso alocado na atividade
        $this->recurso_real_id = $recurso_id;

        try {

            $resultado = DB::transaction(function () use ($alocacao) {

                $this->save();

                Alocacao::updateOrCreate(['roadmap_id' => $alocacao->roadmap_id, 'atividade_id' => $alocacao->atividade_id],
                    ['data_inicio_proj' => $alocacao->data_inicio_proj, 'data_fim_proj' => $alocacao->data_fim_proj, 'recurso_id' => $alocacao->recurso_id]);

            });

            return is_null($resultado) ? null : $resultado;

        } catch (Exception $e) {

            return null;
        }
    }


    /**
     * @param \App\Roadmap $roadmap
     * @param Collection|null $lista_negra
     * @return array
     */
    public function calcularMelhorRecurso(Roadmap $roadmap, Collection $lista_negra = null)
    {

        $todos_recursos = Recurso::recursosCompetentes($this)->where('data_fim', '>', $roadmap->data_base);

        if (!is_null($lista_negra)) {

            $recursos = $todos_recursos->reject(function ($r, $key) use ($lista_negra) {

                return $lista_negra->contains($r);

            });

        } else {

            $recursos = $todos_recursos;

        }

        $primeiro_recurso = null;

        $primeira_data = null;

        foreach ($recursos as $recurso) {

            $primeira_data_recurso = $recurso->calcularPrimeiraData($this, $roadmap);

            if (!is_null($primeira_data_recurso)) {

                if (!isset($primeira_data)) {

                    $primeira_data = $primeira_data_recurso;

                    $primeiro_recurso = $recurso;

                } else {

                    if ($primeira_data_recurso < $primeira_data) {

                        $primeira_data = $primeira_data_recurso;

                        $primeiro_recurso = $recurso;

                    }
                }

            }

        }

        return array('recurso' => $primeiro_recurso, 'data' => $primeira_data);
    }

    /**
     * @param Roadmap $roadmap
     * @param Recurso $recurso
     * @param null $data_base
     * @param null $data_inicio
     * @param int $modo : 0 - dias corridos, 1 - exclui fins de semana, 2 - exclui fins de semana e feriados
     * @param Collection $feriados
     * @return mixed
     */
    public function calcularDataFimPorPercentual(Roadmap $roadmap, Recurso $recurso, $data_base = null, $data_inicio = null, $modo = 2, Collection $feriados = null)
    {

        if (is_null($feriados)) {

            $municipio_padrao = Parametro::where('codigo', '=', 1)->first();

            $municipio = Municipio::find($municipio_padrao->valor);

            $feriados = Feriado::feriadosPorLocal($municipio);
        }

        if (is_null($data_base)) {

            $data_base = $roadmap->data_base;

        }

        $prioridade = DB::table('projeto_roadmap')->select('prioridade')->where(
            'projeto_id', '=', $this->projeto->id)->where('roadmap_id', '=', $roadmap->id)
            ->first()->prioridade;

        $datas_indisponiveis = $recurso->datasIndisponiveis($roadmap, $prioridade);


        if (is_null($this->data_inicio_real)) {

            $dias_utilizados = 0;

        } else {

            $dias_utilizados = FuncoesData::calcularDias($this->data_inicio_real, $data_base, $modo, 0, $datas_indisponiveis, $feriados);

        }

        if ($this->percentual_real == 0 || is_null($this->percentual_real)) {

            $dias_totais_necessarios = $this->prazo;

        } else {

            $dias_totais_necessarios = ceil($dias_utilizados / ($this->percentual_real / 100));

        }

        $dias_remanescentes = $dias_totais_necessarios - $dias_utilizados;

        $data_reinicio = max(FuncoesData::moverDiaUtil($data_base, 1, $feriados), $data_inicio);

        $data_fim = FuncoesData::calcularDataFim($data_reinicio, $dias_remanescentes, $datas_indisponiveis, $feriados);


        return $data_fim;
    }

    public function calcularPercentualPorDataFim(Roadmap $roadmap, Recurso $recurso, $data_fim, $data_base = null, $data_inicio = null, $modo = 2, Collection $feriados = null)
    {

        if (is_null($feriados)) {

            $municipio_padrao = Parametro::where('codigo', '=', 1)->first();

            $municipio = Municipio::find($municipio_padrao->valor);

            $feriados = Feriado::feriadosPorLocal($municipio);
        }

        if (is_null($data_inicio)) {

            $data_inicio = $this->data_inicio_real;

        }

        if (is_null($data_base)) {

            $data_base = $roadmap->data_base;

        }

        $prioridade = DB::table('projeto_roadmap')->select('prioridade')->where(
            [['projeto_id', '=', $this->projeto->id], ['roadmap_id', '=', $roadmap->id]]
        )->first()->prioridade;

        $datas_indisponiveis = $recurso->datasIndisponiveis($roadmap, $prioridade);

        $dias_utilizados = FuncoesData::calcularDias($data_inicio, $data_base, $modo, 0, $datas_indisponiveis, $feriados);

        $dias_totais_necessarios = FuncoesData::calcularDias($data_inicio, $data_fim, $modo, 0, $datas_indisponiveis, $feriados);

        $percentual = number_format($dias_utilizados * 100 / $dias_totais_necessarios, 2, '.', ',');

        return $percentual;

    }

}
