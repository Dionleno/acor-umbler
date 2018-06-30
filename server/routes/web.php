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
 
Route::get('/','Auth\LoginController@showLoginForm');


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('categorias', 'CategoriaController');

Route::resource('posts', 'PostController');

Route::resource('projetos', 'ProjetoController');

Route::resource('videos', 'VideoController');

Route::resource('eventos', 'EventoController');

Route::resource('servicos', 'ServicoController');

Route::resource('links', 'LinkController');
Route::group(['prefix' => 'associados'],function(){ 
    Route::resource('associado-beneficios', 'AssociadoBeneficioController');
    Route::resource('associado-planos', 'AssociadoPlanoController');
});
Route::group(['prefix' => 'club'],function(){ 
    Route::resource('beneficios', 'BeneficioController');
    Route::resource('planos', 'PlanoController');
});
Route::post('upload_image','CkeditorController@uploadImage')->name('upload');
// Route::get('/associados/associado-planos','PlanoController@indexAssociado')->name('associado_planos'); 
