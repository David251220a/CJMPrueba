<?php

use Illuminate\Support\Facades\Route;
use App\Exports\PLanillaExport;

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
    return view('Auth/login');
});

/*
EJEMPLOS PARA HACER PDF
$pdf = App::make('dompdf.wrapper');
$pdf->loadHTML('<h1>Test</h1>');
PARA VER PDF
return $pdf->stream();
PARA DESCARGAR PDF
return $pdf->stream();

$pdf = PDF::loadHTML('<h1>Test</h1>');
$pdf = PDF::loadView('<h1>Test</h1>');
Route::get('/{slug?}', 'HomeController@index')->name('home');
*/


Route::resource('afiliado/persona', 'PersonaController');
Route::resource('afiliado/personainactiva', 'PersonaInactiva');
Route::resource('planillamensual/generar', 'PlanillaMensualController');
Route::resource('planillamensual/importar', 'PlanillaMensualImportController');
Route::resource('planillamensual/historico', 'PlanillaHistoricoController');
Route::resource('prestamoplanilla/generar', 'PrestamoPlanillaController');
Route::resource('inicio/inicio', 'InicioController');
Route::resource('ayuda/index', 'AyudaController');


Route::get('pdf/planillamensual/planillaPDF/{id}', 'PlanillaMensualPDF@Generar');
Route::get('pdf/planillamensual/planillaPDF/historico/{id}', 'PlanillaMensualPDF@GenerarHistorico');
Route::get('pdf/planillamensual/planillaPDF/import/{id}', 'PlanillaMensualPDF@GenerarImport');
Route::get('planillamensual/exportar/exportar', 'PlanillaMensualImportController@GenerarExcelAyuda');



Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
