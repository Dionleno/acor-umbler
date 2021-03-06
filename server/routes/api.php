<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});










Route::resource('categorias', 'CategoriaAPIController');

Route::resource('posts', 'PostAPIController');

Route::resource('projetos', 'ProjetoAPIController');

Route::resource('videos', 'VideoAPIController');

Route::resource('eventos', 'EventoAPIController');

Route::resource('servicos', 'ServicoAPIController');

Route::resource('links', 'LinkAPIController');

Route::resource('beneficios', 'BeneficioAPIController');

Route::resource('planos', 'PlanoAPIController');