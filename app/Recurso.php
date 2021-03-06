<?php

namespace App;

use App\Bloqueio;
use App\Competencia;
use App\Equipe;
use App\Alocacao;
use App\Roadmap;
use App\FuncoesFilhos;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class Recurso extends Model
{
    protected $fillable = ['nome', 'data_inicio', 'data_fim'];

    public function competencias()
    {
        return $this->belongsToMany('App\Competencia')->withPivot('id', 'permite_aloc_automatica')->orderBy('id', 'ASC');
    }

    public function equipes()
    {
        return $this->belongsToMany('App\Equipe');
    }

    public function bloqueios()
    {
        return $this->hasMany('App\Bloqueio');
    }

    public function alocacoes()
    {
        return $this->hasMany('App\Alocacao');
    }

    /**
     * @param Atividade $atividade
     * @return int
     * @throws Exception
     */
    public static function recursosCompetentes(Atividade $atividade)
    {
        $equipe = $atividade->projeto->equipe_id;

        $competencia = $atividade->competencia_id;

        $resultados = DB::table('recursos')->select('recursos.id', 'recursos.data_inicio', 'recursos.data_fim')
            ->leftJoin('equipe_recurso', 'recursos.id', '=', 'equipe_recurso.recurso_id')
            ->leftJoin('competencia_recurso', 'recursos.id', '=', 'competencia_recurso.recurso_id')
            ->where('competencia_recurso.competencia_id', '=', $competencia)
            ->where('competencia_recurso.permite_aloc_automatica', '=', '1')
            ->where('equipe_recurso.equipe_id', '=', $equipe)
            ->get();

        if ($resultados->count() == 0) {

            $resultados = DB::table('recursos')->select('recursos.id', 'recursos.data_inicio', 'recursos.data_fim')
                ->leftJoin('equipe_recurso', 'recursos.id', '=', 'equipe_recurso.recurso_id')
                ->leftJoin('competencia_recurso', 'recursos.id', '=', 'competencia_recurso.recurso_id')
                ->where('competencia_recurso.competencia_id', '=', $competencia)
                ->where('equipe_recurso.equipe_id', '=', $equipe)
                ->get();

        }

        if ($resultados->count()) {

            return Recurso::hydrate($resultados->toArray());

        } else {

            throw new Exception('Não há recursos competentes para a tarefa.');
        }

    }

    public function alocacoesRoadmap(Roadmap $roadmap)
    {
        return $this->alocacoes->where('roadmap_id', '=', $roadmap->id);
    }

    /**
     * @param Request $request
     * @return int|mixed
     */
    public static function criarRecurso(Request $request)
    {
        try {

            $resultado = DB::transaction(function () use ($request) {

                $recurso = Recurso::create([
                    'nome' => $request->input('nome'),
                    'data_inicio' => $request->input('data_inicio'),
                    'data_fim' => $request->input('data_fim'),
                ]);


                if ($request->session()->has('filhos')) {

                    FuncoesFilhos::criarFilhos($request, $recurso);
                }

                return $recurso;

            });

            return $resultado;

        } catch (Exception $e) {

            return 1;

        }
    }

    /**
     * @param Request $request
     * @param Recurso $recurso
     * @return int|mixed
     */
    public static function atualizarRecurso(Request $request, Recurso $recurso)
    {

        try {

            $resultado = DB::transaction(function () use ($request, $recurso) {

                $recurso->nome = $request->input('nome');
                $recurso->data_inicio = $request->input('data_inicio');
                $recurso->data_fim = $request->input('data_fim');

                $recurso->save();


                if ($request->session()->has('filhos')) {

                    FuncoesFilhos::criarFilhos($request, $recurso);

                }


                return $recurso;

            });

            return $resultado;

        } catch (Exception $e) {

            return 1;

        }
    }

    /**
     * @param \App\Roadmap $roadmap
     * @param null $prioridade
     * @return Collection
     */
    public function datasIndisponiveis(Roadmap $roadmap, $prioridade = null)
    {
        $datas_indisponiveis = collect();

        $bloqueios = $this->bloqueios;

        $alocacoes = $this->alocacoesRoadmap($roadmap);

        if ($alocacoes->count()) {

            if (!is_null($prioridade)) {

                $alocacoes = $alocacoes->filter(function ($alocacao) use ($roadmap, $prioridade) {

                    $prioridade_projeto = (DB::table('projeto_roadmap')->where('projeto_id', '=', $alocacao->atividade->projeto->id)->where('roadmap_id', '=', $roadmap->id)->first())->prioridade;

                    return $prioridade_projeto < $prioridade;

                });
            }

            foreach ($alocacoes as $alocacao) {
                $datas_indisponiveis->push(['data_inicio' => $alocacao->data_inicio_proj, 'data_fim' => $alocacao->data_fim_proj]);
            }

        }

        if ($bloqueios->count()) {

            foreach ($bloqueios as $bloqueio) {

                $datas_indisponiveis->push(['data_inicio' => $bloqueio->data_inicio, 'data_fim' => $bloqueio->data_fim]);

            }

        }

        $datas_indisponiveis_consolidadas = collect();

        if ($datas_indisponiveis->count()) {

            $datas_indisponiveis = $datas_indisponiveis->sortBy('data_inicio')->values();

            $key = 0;

            foreach ($datas_indisponiveis as $data_indisponivel) {

                if ($datas_indisponiveis_consolidadas->count() == 0) {

                    $datas_indisponiveis_consolidadas->push($data_indisponivel);

                } else {

                    if ($data_indisponivel['data_inicio'] < $datas_indisponiveis_consolidadas->get($key)['data_fim']) {

                        $intervalo = ['data_inicio' => $datas_indisponiveis_consolidadas->get($key)['data_inicio'], 'data_fim' => max($datas_indisponiveis_consolidadas->get($key)['data_fim'], $data_indisponivel['data_fim'])];

                    } else {

                        $intervalo = ['data_inicio' => $data_indisponivel['data_inicio'], 'data_fim' => $data_indisponivel['data_fim']];

                        $key++;

                    }

                    $datas_indisponiveis_consolidadas->put($key, $intervalo);

                }

            }

        }

        return $datas_indisponiveis_consolidadas;
    }


    /**
     * @param Atividade $atividade
     * @param \App\Roadmap $roadmap
     * @param Collection $feriados
     * @return mixed|null
     */
    public function calcularPrimeiraData(Atividade $atividade, Roadmap $roadmap, Collection $feriados = null)
    {
        if (is_null($feriados)) {

            $municipio_padrao = Parametro::where('codigo', '=', 1)->first();

            $municipio = Municipio::find($municipio_padrao->valor);

            $feriados = Feriado::feriadosPorLocal($municipio);

        }

        $prazo = $atividade->prazo;

        $prioridade = (DB::table('projeto_roadmap')->where('projeto_id', '=', $atividade->projeto->id)->where('roadmap_id', '=', $roadmap->id)->first())->prioridade;

        $datas_indisponiveis = $this->datasIndisponiveis($roadmap, $prioridade);

        $dependencias = $atividade->depende_de;

        if (!is_null($dependencias) && $dependencias->count()) {

            $ultima_data_dependencias = 0;

            foreach ($dependencias as $dependencia) {

                $alocacao = $dependencia->alocacoes->where('roadmap_id', '=', $roadmap->id)->first();

                if (!is_null($alocacao)) {

                    $data_fim_proj = $alocacao->data_fim_proj;

                } else {

                    $data_fim_proj = null;
                }

                $ultima_data_dependencias = max($ultima_data_dependencias, $data_fim_proj);

            }
        } else {

            $ultima_data_dependencias = $roadmap->data_base;

        }

        $primeira_data_apos_dependencias = FuncoesData::moverDiaUtil($ultima_data_dependencias, 1, $feriados);

        if (!is_null($datas_indisponiveis) && $datas_indisponiveis->count()) {

            $ultima_data_indisponiveis = max($datas_indisponiveis->max('data_fim'), $roadmap->data_base);


        } else {

            $ultima_data_indisponiveis = $roadmap->data_base;

        }

        $primeira_data_apos_indisponiveis = FuncoesData::moverDiaUtil($ultima_data_indisponiveis, 1, $feriados);

        $primeira_data_apos_dependencias_indisponiveis = max($primeira_data_apos_dependencias, $primeira_data_apos_indisponiveis);

        $datas_limite_recurso = array('data_inicio' => $this->data_inicio, 'data_fim' => $this->data_fim);

        if (FuncoesData::calcularDataFim($primeira_data_apos_dependencias_indisponiveis, $prazo, $datas_indisponiveis, $feriados) <= $datas_limite_recurso['data_fim']) {

            $primeira_data_recurso = $primeira_data_apos_dependencias_indisponiveis;

        } else {

            $primeira_data_recurso = null;

        }

        for ($i = 0; $i < (sizeof($datas_indisponiveis) - 1); $i++) {

            if (!$i) {

                $prazo_inicial_data = max($roadmap->data_base, $this->data_inicio, $primeira_data_apos_dependencias);

                $prazo_inicial_disponivel = FuncoesData::calcularDias($prazo_inicial_data, $datas_indisponiveis->get(0)['data_inicio'], 2, 0, $di = collect(), $feriados);

                if ($prazo_inicial_disponivel >= $prazo) {

                    $primeira_data_recurso = $prazo_inicial_data;

                    break;

                }

            }

            $data_inicio = max(FuncoesData::moverDiaUtil($datas_indisponiveis->get($i)['data_fim'], 1, $feriados), $datas_limite_recurso['data_inicio'], $primeira_data_apos_dependencias, FuncoesData::moverDiaUtil($roadmap['data_base'], 1, $feriados));

            $data_fim = min(FuncoesData::moverDiaUtil($datas_indisponiveis->get($i + 1)['data_inicio'], -1, $feriados), $datas_limite_recurso['data_fim']);

            $prazo_disponivel = FuncoesData::calcularDias($data_inicio, $data_fim, 2, 0, $di = collect(), $feriados);

            if ($prazo_disponivel >= $prazo) {

                $primeira_data_recurso = $data_inicio;

                break;

            }


        }

        return $primeira_data_recurso;
    }
}
