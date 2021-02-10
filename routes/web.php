<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/teste', 'AjaxController@teste');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('clientes', 'ClienteController');

Route::resource('recursos', 'RecursoController');

Route::prefix('roadmaps')->group(function () {

    Route::get('{id}/configurar', array('as' => 'roadmaps.configurar', 'uses' => 'RoadmapController@configurarRoadmap'));

    Route::get('{id}/gantt', array('as' => 'roadmaps.gantt', 'uses' => 'RoadmapController@gantt'));

    Route::post('gantt-dados', array('as' => 'roadmaps.ganttDados', 'uses' => 'RoadmapController@ganttDados'));

    Route::post('alocar', 'RoadmapController@alocarRoadmap');

    Route::post('exportar', 'RoadmapController@exportarRoadmap');

});

Route::resource('roadmaps', 'RoadmapController');

Route::resource('competencias', 'CompetenciaController');

Route::resource('equipes', 'EquipeController');

Route::prefix('projetos')->group(function () {

    Route::post('incluir-roadmap', 'ProjetoController@incluirProjetosRoadmap');

    Route::get('reprovar', array('as' => 'projetos.reprovar', 'uses' => 'ProjetoController@reprovar'));

    Route::post('importar', 'ProjetoController@importarProjetosExcel');

});

Route::resource('projetos', 'ProjetoController');

Route::resource('feriados', 'FeriadoController');

Route::resource('locais', 'LocalController');

Route::prefix('atividades')->group(function () {

    Route::post('atualizar-massa', 'AtividadeController@atualizarAtividades');

    Route::post('calcular-datas', 'AtividadeController@calcularDatas');

    Route::post('calcular-percentual', 'AtividadeController@calcularPercentual');
});

Route::resource('atividades', 'AtividadeController');

Route::prefix('ajax')->group(function () {

    Route::post('consultar', 'AjaxController@consultar');

    Route::post('incluir', 'AjaxController@incluir');

});

Route::prefix('relatorios')->group(function () {

    Route::get('/dashboard', array('as' => 'relatorios.dashboard', 'uses' => 'RelatorioController@dashboard'));

    Route::post('/histograma-atraso', 'RelatorioController@histogramaAtraso');

    Route::post('/tabela-atraso', 'RelatorioController@tabelaAtraso');

});


