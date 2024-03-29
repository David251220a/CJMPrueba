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

//Route::get('/inicio/inicio', 'InicioController@index')->name('inicio.inicio');

//Route::get('/inicio/inicio', 'InicioController@index')->name('inicio.inicio');

Route::resource('afiliado/persona', 'apo_Afiliado_Inst_MunicController');
Route::resource('afiliado/personainactiva', 'apo_Afiliado_Inst_Munic_Inactivo_Controller');
Route::resource('afiliado/capacidad', 'apo_Afiliado_CapacidadController');

Route::resource('planillamensual/generar', 'PlanillaMensualController');
Route::resource('planillamensual/importar', 'PlanillaMensualImportController');
Route::resource('planillamensual/historico', 'PlanillaHistoricoController');

Route::resource('prestamoplanilla/generar', 'PrestamoPlanillaController');

Route::resource('inicio/inicio', 'InicioController');

Route::resource('constancia/aporte', 'apo_AporteController');

Route::resource('resumen/aporte', 'apo_Aporte_ResumenController');

Route::resource('constancia/prestamo', 'pre_Constancia_PrestamoController');
Route::resource('rendicionaporte/generar', 'apo_Rendicion_AporteController');
Route::resource('rendicionaporte/importar', 'apo_Rendicion_Aporte_ImportarController');
Route::resource('ayuda/index', 'AyudaController');


Route::get('pdf/planillamensual/planillaPDF/{id}', 'PlanillaMensualPDF@Generar');
Route::get('pdf/constanciaaporte/{id}', 'PDFController@ConstanciaAporte');
Route::get('constancia/aporte/{id}', 'PlanillaMensualPDF@Generar');
Route::get('pdf/planillamensual/planillaPDF/historico/{id}', 'PlanillaMensualPDF@GenerarHistorico');
Route::get('pdf/planillamensual/planillaPDF/import/{id}', 'PlanillaMensualPDF@GenerarImport');
Route::get('planillamensual/exportar/exportar', 'PlanillaMensualImportController@GenerarExcelAyuda');



Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

