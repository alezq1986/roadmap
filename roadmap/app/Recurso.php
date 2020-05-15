<?php

namespace App;

use App\Bloqueio;
use App\Competencia;
use App\Equipe;
use App\Alocacao;
use App\Roadmap;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Recurso extends Model
{
    protected $fillable = ['nome', 'data_inicio', 'data_fim'];

    public function competencias()
    {
        return $this->belongsToMany('App\Competencia')->orderBy('id', 'ASC');
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

    public function alocacoesRoadmap(Roadmap $roadmap)
    {
        return $this->alocacoes->where('roadmap_id', '=', $roadmap->id);
    }

    public static function criarRecurso(Request $request)
    {

        DB::transaction(function () use ($request) {

            $recurso = Recurso::create([
                'nome' => $request->input('nome'),
                'data_inicio' => $request->input('data_inicio'),
                'data_fim' => $request->input('data_fim'),
            ]);

            while ($request->session()->get('aguardar')) {
                $a = 1;
            }

            if ($request->session()->has('filhos')) {

                $recurso->criarRecursoFilhos($request);
            }
        });
    }

    public static function atualizarRecurso(Request $request, Recurso $recurso)
    {


        DB::transaction(function () use ($request, $recurso) {

            $recurso->nome = $request->input('nome');
            $recurso->data_inicio = $request->input('data_inicio');
            $recurso->data_fim = $request->input('data_fim');

            $recurso->save();

            while ($request->session()->get('aguardar')) {
                $a = 1;
            }

            if ($request->session()->has('filhos')) {

                $recurso->criarRecursoFilhos($request);
            }
        });
    }

    public function criarRecursoFilhos(Request $request)
    {
        if (isset($request->session()->get('filhos')['filhos_incluir'])) {

            foreach ($request->session()->get('filhos')['filhos_incluir'] as $filho) {

                switch ($filho['modelo']) {

                    case 'Competencia':

                        DB::table('competencia_recurso')->insertOrIgnore([
                            'recurso_id' => $this->id,
                            'competencia_id' => $filho['id']
                        ]);

                        break;
                    case 'Equipe':

                        DB::table('equipe_recurso')->insertOrIgnore([
                            'recurso_id' => $this->id,
                            'equipe_id' => $filho['id']
                        ]);

                        break;

                    default:
                }
            }
        }

        if (isset($request->session()->get('filhos')['filhos_deletar'])) {

            foreach ($request->session()->get('filhos')['filhos_deletar'] as $filho) {

                switch ($filho['modelo']) {

                    case 'Competencia':

                        DB::table('competencia_recurso')->where(
                            'recurso_id', '=', $this->id
                        )->where(
                            'competencia_id', '=', $filho['id']
                        )->delete();

                        break;
                    case 'Equipe':

                        DB::table('equipe_recurso')->where(
                            'recurso_id', '=', $this->id
                        )->where(
                            'equipe_id', '=', $filho['id']
                        )->delete();

                        break;

                    default:
                }
            }
        }
        $request->session()->forget('filhos');
    }

    /**
     * @param \App\Roadmap $roadmap
     * @param null $prioridade
     * @return \Illuminate\Support\Collection
     */
    public function datasIndisponiveis(Roadmap $roadmap, $prioridade = null)
    {
        $datas_indisponiveis = collect();

        $bloqueios = $this->bloqueios;

        $alocacoes = $this->alocacoesRoadmap($roadmap);

        if (!is_null($prioridade)) {
            $alocacoes = $alocacoes->filter(function ($alocacao) use ($prioridade) {

                return $alocacao->atividade->projeto->prioridade < $prioridade;

            });
        }

        foreach ($bloqueios as $bloqueio) {
            $datas_indisponiveis->push(['data_inicio' => $bloqueio->data_inicio, 'data_fim' => $bloqueio->data_fim]);
        }

        foreach ($alocacoes as $alocacao) {
            $datas_indisponiveis->push(['data_inicio' => $alocacao->data_inicio_proj, 'data_fim' => $alocacao->data_fim_proj]);
        }

        $datas_indisponiveis = $datas_indisponiveis->sortBy('data_inicio')->values();

        return $datas_indisponiveis;
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

        $datas_indisponiveis = $this->datasIndisponiveis($roadmap, $atividade->projeto->prioridade);

        $dependencias = $atividade->depende_de;

        $ultima_data_dependencias = 0;

        foreach ($dependencias as $dependencia) {
            $data_fim_proj = $dependencia->alocacoes->where('roadmap_id', '=', $roadmap->id)->first()->data_fim_proj;

            $ultima_data_dependencias = max($ultima_data_dependencias, $data_fim_proj);

        }

        $primeira_data_apos_dependencias = FuncoesData::moverDiaUtil($ultima_data_dependencias, 1, $feriados);

        $primeira_data_apos_indisponiveis = 0;

        if ($datas_indisponiveis) {
            $ultima_data_indisponiveis = $datas_indisponiveis->max('data_fim');

            $primeira_data_apos_indisponiveis = FuncoesData::moverDiaUtil($ultima_data_indisponiveis, 1, $feriados);
        }

        $primeira_data_apos_dependencias_indisponiveis = max($primeira_data_apos_dependencias, $primeira_data_apos_indisponiveis);

        $datas_limite_recurso = array('data_inicio' => $this->data_inicio, 'data_fim' => $this->data_fim);

        if (FuncoesData::calcularDataFim($primeira_data_apos_dependencias_indisponiveis, $prazo, $datas_indisponiveis, $feriados) <= $datas_limite_recurso['data_fim']) {
            $primeira_data_recurso = $primeira_data_apos_dependencias_indisponiveis;

        } else {

            $primeira_data_recurso = null;

        }

        for ($i = 0; $i < (sizeof($datas_indisponiveis) - 1); $i++) {
            $data_inicio = max(FuncoesData::moverDiaUtil($datas_indisponiveis->get($i)['data_fim'], 1, $feriados), $datas_limite_recurso['data_inicio'], $primeira_data_apos_dependencias);

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
