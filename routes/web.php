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

Route::get('/', 'PaginaPublicaController@index');

Route::get('dashboard','PaginaPublicaController@getUserDashboard');

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

/*Rutas para Canjes */
Route::group(['prefix'=>'canjes'], function (){

    //Ruta principal
    Route::get('',[
        'uses' => 'CanjeController@index',
        'as' => 'canjes.index'
    ]);

    //Ruta para el shopping cart
    Route::get('agregar-canje/{id}', [
        'uses' => 'CanjeController@agregarMaterial',
        'as'=> 'canjes.agregarMaterial'
    ]);

    //Ruta para crear el canje
    Route::get('create',[
        'uses' => 'CanjeController@create',
        'as' => 'canjes.create'
    ]);

});



Auth::routes();