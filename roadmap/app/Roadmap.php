<?php

namespace App;

use App\Atividade;
use App\Alocacao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Roadmap extends Model
{
    protected $fillable = ['data_base'];


    public function alocacoes()
    {
        return $this->hasMany('App\Alocacao');
    }

    public function projetos()
    {
        return $this->belongsToMany('App\Projeto')->withPivot('prioridade');
    }

    public function atividades()
    {
        $projetos = $this->projetos;

        $atividades = collect();

        foreach ($projetos as $projeto) {

            $atividades->push($projeto->atividades);

        }
        return $atividades->flatten();
    }


    public function alocar()
    {
        DB::table('alocacoes')->where('roadmap_id', '=', $this->id)->delete();

        $max_id = DB::table('alocacoes')->max('id');

        $max_id = is_null($max_id) ? 1 : $max_id + 1;

        DB::update(DB::raw('ALTER SEQUENCE alocacoes_id_seq RESTART WITH ' . $max_id));

        $atividades = $this->atividades();

        foreach ($atividades as $atividade) {

            $continuar = (parse_ini_file(storage_path('alocar.ini')))['continuar'];

            if ($continuar == 1) {

                $atividade->alocarAtividade($this);
            } else {

                return 1;
            }
        }

        return 0;

    }


    public static function criarRoadmap(Request $request)
    {

        DB::transaction(function () use ($request) {

            $roadmap = Roadmap::create([
                'data_base' => $request->input('data_base'),
                'descricao' => $request->input('descricao'),
                'alocado' => 0,
            ]);

            if ($request->session()->has('filhos')) {

                FuncoesFilhos::criarFilhos($request, $roadmap);

            }

            if ($request->session()->has('filhos_pivot')) {

                FuncoesFilhos::criarFilhosPivot($request, $roadmap);
            }

        });
    }

    public static function atualizarRoadmap(Request $request, Roadmap $roadmap)
    {
        DB::transaction(function () use ($request, $roadmap) {

            $roadmap->data_base = $request->input('data_base');

            $roadmap->save();

            if ($request->session()->has('filhos')) {

                FuncoesFilhos::criarFilhos($request, $roadmap);

            }

            if ($request->session()->has('filhos_pivot')) {

                FuncoesFilhos::criarFilhosPivot($request, $roadmap);
            }

        });
    }

    public function exportarRoadmapExcel()
    {

        $spreadsheet = new Spreadsheet();

        $alocacoes = $this->alocacoes;

        $header = ['Projeto', 'Atividade', 'Data Início', 'Data Fim', 'Prazo (dias)', 'Recurso', 'Percentual (%)'];

        $spreadsheet->getActiveSheet()
            ->fromArray(
                $header,
                NULL,
                'A1'
            );

        $i = 2;
        foreach ($alocacoes as $alocacao) {

            $arr = [$alocacao->atividade->projeto->descricao, $alocacao->atividade->descricao, $alocacao->data_inicio_proj, $alocacao->data_fim_proj, $alocacao->atividade->prazo, $alocacao->recurso->nome, $alocacao->atividade->percentual_real];

            $spreadsheet->getActiveSheet()
                ->fromArray(
                    $arr,
                    NULL,
                    'A' . $i
                );

            $i++;

        }

        $writer = new Xlsx($spreadsheet);

        try {

            $writer->save('roadmap.xlsx');

            $resultado = true;

        } catch (\Exception $e) {

            Log::error('exportarRoadmap', ['roadmap' => $this->id, 'mensagem' => $e]);

        }

        return $resultado;


    }

}
