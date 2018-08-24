<?php

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

Auth::routes();

Route::get('/', 'Auth\LoginController@index')->name('login');
Route::get('/login', 'Auth\LoginController@index');

Route::get('/preguntas', 'Auth\ForgotPasswordController@index');
Route::post('/preguntas', 'Auth\ForgotPasswordController@validarPreguntas');
Route::get('/recuperar/{id}', 'Auth\ResetPasswordController@index');
Route::patch('/recuperar/{id}', 'Auth\ResetPasswordController@actualizar');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'CarteleraController@indexPage');
Route::get('/news/{id}', 'CarteleraController@show')->middleware('can:super-admin');

Route::resource('/admin/news', 'CarteleraController')->middleware('can:super-admin');
Route::resource('/admin/escuelas', 'EscuelasController')->middleware('can:super-admin');
Route::resource('/admin/cargos', 'CargosController')->middleware('can:super-admin');
Route::resource('/admin/profesores', 'ProfesoresController')->middleware('can:super-admin');
Route::resource('/admin/egresados', 'EgresadosController')->middleware('can:super-admin');
Route::resource('/admin/procesos_electorales', 'Procesos_ElectoralesController')->middleware('can:super-admin');
Route::resource('/admin/comision_electoral', 'ComisionElectoralController')->middleware('can:super-admin');
Route::resource('/admin/comision_electoral/miembros', 'MiembrosCEController')->middleware('can:super-admin');
Route::resource('/admin/cargos-por-escuelas', 'CargosPorEscuelasController');
Route::resource('/admin/impugnaciones', 'ImpugnacionesController')->middleware('can:super-admin');
Route::get('/admin/comision_electoral/{id}/miembros/', 'MiembrosCEController@show')->middleware('can:super-admin');;
Route::get('/admin/comision_electoral/{id}/miembros/create', 'MiembrosCEController@create')->middleware('can:super-admin');
Route::post('/admin/comision_electoral/{id}/miembros/', 'MiembrosCEController@store')->middleware('can:super-admin');
Route::get('/admin/comision_electoral/{id_ce}/miembros/{id}/edit', 'MiembrosCEController@edit')->middleware('can:super-admin');

Route::get('/resultados', 'ResultadosController@index');
Route::get('/certificados', 'CertificadosController@index');
Route::get('/perfil', function () {
    return view('perfil');
});
Route::get('/postulaciones', 'PostulacionesController@index');
Route::post('/postulaciones', 'PostulacionesController@store');
Route::get('/votaciones', 'VotacionesController@index');
Route::get('/votaciones/{id}', 'VotacionesController@show');
Route::post('/votaciones/{id}', 'VotacionesController@store');
Route::post('/votaciones', 'VotacionesController@store');