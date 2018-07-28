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
Route::get('/', 'PaginaPublicaController@index');

/***Rutas para materiales***/
Route::group(['prefix'=>'materiales'], function (){

    //Ruta principal 
    Route::get('',[
        'uses' => 'MaterialController@index',
        'as' => 'materiales.index'
    ]);

    //Routa para crear nuevo
    Route::get('create',[
        'uses' => 'MaterialController@create',
        'as' => 'materiales.create'
    ]);


    //POST REQUESTS
    Route::post('create',[
        'uses' => 'MaterialController@store',
        'as'=> 'materiales.create'
    ]);
});
