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

    //Ruta para crear nuevo
    Route::get('create',[
        'uses' => 'MaterialController@create',
        'as' => 'materiales.create'
    ]);

    //Ruta para actualizar 
    Route::get('edit/{id}',[
        'uses' => 'MaterialController@edit',
        'as'=> 'materiales.edit'
    ]);


    //POST REQUESTS
    Route::post('create',[
        'uses' => 'MaterialController@store',
        'as'=> 'materiales.create'
    ]);

    Route::post('update',[
        'uses'=>'MaterialController@update',
        'as'=> 'materiales.update'
    ]);
});
