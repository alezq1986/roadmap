<?php

namespace App;

use App\Projeto;
use App\Competencia;
use App\Alocacao;
use App\Roadmap;
use App\Recurso;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Atividade extends Model
{
    protected $fillable =
        ['atividade_codigo', 'projeto_id',
            'descricao', 'competencia_id',
            'prazo', 'data_inicio_real',
            'data_fim_real', 'recurso_id',
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
     * @param null $data_inicio
     * @param int $modo : 0 - dias corridos, 1 - exclui fins de semana, 2 - exclui fins de semana e feriados
     * @param Collection $feriados
     * @return mixed
     */
    public function calcularDataFimPorPercentual(Roadmap $roadmap, Recurso $recurso, $data_inicio = null, $modo = 2, Collection $feriados = null)
    {

        if (is_null($feriados)) {

            $municipio_padrao = Parametro::where('codigo', '=', 1)->first();

            $municipio = Municipio::find($municipio_padrao->valor);

            $feriados = Feriado::feriadosPorLocal($municipio);
        }

        $prioridade = DB::table('projeto_roadmap')->select('prioridade')->where(
            'projeto_id', '=', $this->projeto->id)->where('roadmap_id', '=', $roadmap->id)
            ->first()->prioridade;

        $datas_indisponiveis = $recurso->datasIndisponiveis($roadmap, $prioridade);


        if (is_null($this->data_inicio_real)) {

            $dias_utilizados = 0;

        } else {

            $dias_utilizados = FuncoesData::calcularDias($this->data_inicio_real, $roadmap->data_base, $modo, 0, $datas_indisponiveis, $feriados);

        }

        if ($this->percentual_real == 0 || is_null($this->percentual_real)) {

            $dias_totais_necessarios = $this->prazo;

        } else {

            $dias_totais_necessarios = ceil($dias_utilizados / ($this->percentual_real / 100));

        }

        $dias_remanescentes = $dias_totais_necessarios - $dias_utilizados;

        $data_reinicio = max(FuncoesData::moverDiaUtil($roadmap->data_base, 1, $feriados), $data_inicio);

        $data_fim = FuncoesData::calcularDataFim($data_reinicio, $dias_remanescentes, $datas_indisponiveis, $feriados);


        return $data_fim;
    }

    public function calcularPercentualPorDataFim($data_fim, $modo, Roadmap $roadmap, Recurso $recurso, Collection $feriados)
    {

        if (is_null($feriados)) {

            $municipio_padrao = Parametro::where('codigo', '=', 1)->first();

            $municipio = Municipio::find($municipio_padrao->valor);

            $feriados = Feriado::feriadosPorLocal($municipio);
        }

        $prioridade = DB::table('projeto_roadmap')->select('prioridade')->where(
            [['projeto_id', '=', $this->projeto->id], ['roadmap_id', '=', $roadmap->id]]
        )->first()->prioridade;

        $datas_indisponiveis = $recurso->datasIndisponiveis($roadmap, $prioridade);

        $dias_utilizados = FuncoesData::calcularDias($this->data_inicio_real, $roadmap->data_base, $modo, 0, $datas_indisponiveis, $feriados);

        $dias_totais_necessarios = FuncoesData::calcularDias($this->data_inicio_real, $data_fim, $modo, 0, $datas_indisponiveis, $feriados);

        $percentual = number_format($dias_utilizados * 100 / $dias_totais_necessarios, 2, '.', ',');

        return $percentual;

    }

}
