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



Route::get('/', ['uses' => 'PaginaPublicaController@index','as'=> 'principal.index']);


Route::group(['prefix'=>'auth'], function (){

    Route::get('edit/{id}',[
        'uses' => 'ResetController@reset',
        'as'=> 'auth.resetpassword'
    ]);


    Route::post('update',[
        'uses'=>'ResetController@update',
        'as'=> 'auth.update'
    ]);
  
    Route::get('create',
    [
      'uses'=>'Auth\RegisterController@getAdminCreate',
      'as'=>'auth.registeradmin'
      
    ]);
    Route::post('create',
    [
      'uses'=>'Auth\RegisterController@createAdministrador',
      'as'=>'auth.registeradmin'
    ]);

    //Ruta principal 
    Route::get('',[
        'uses' => 'Auth\RegisterController@index',
        'as' => 'auth.index'
    ]);

    ///Edit del user
    Route::get('edit',
    [
      'uses'=>'Auth\RegisterController@edit',
      'as'=>'auth.edit'
      
    ]);
    Route::post('update',
    [
      'uses'=>'Auth\RegisterController@update',
      'as'=>'auth.update'
    ]);
});



/***Rutas para centros de acopio***/
Route::group(['prefix'=>'centros'], function (){

    //Ruta principal 
    Route::get('',[
        'uses' => 'CentroAcopioController@index',
        'as' => 'centros.index'
    ]);

    //Ruta para crear nuevo
    Route::get('create',[
        'uses' => 'CentroAcopioController@create',
        'as' => 'centros.create'
    ]);

    //Ruta para actualizar 
    Route::get('edit/{id}',[
        'uses' => 'CentroAcopioController@edit',
        'as'=> 'centros.edit'
    ]);

    Route::get('habilitar/{id}',[
        'uses' => 'CentroAcopioController@habilitar',
        'as'=> 'centros.habilitar'
    ]);

   

    //POST REQUESTS
    Route::post('create',[
        'uses' => 'CentroAcopioController@store',
        'as'=> 'centros.create'
    ]);

    Route::post('update',[
        'uses'=>'CentroAcopioController@update',
        'as'=> 'centros.update'
    ]);



});

Route::get('dashboard',[
    'uses' => 'PaginaPublicaController@getUserDashboard',
    'as' => 'principal.dashboard'
]);

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
    
    //Ruta para guardar el canje
    Route::post('create', [
        'uses' => 'CanjeController@store',
        'as' => 'canjes.create'
    ]);

    //Ruta para mostrar un canje
    Route::get('show/{id}',[
        'uses' => 'CanjeController@show',
        'as' => 'canjes.show'
    ]);

});

Route::group(['prefix'=>'clientes'], function(){

    //Ruta para obtener un cliente

    Route::post('show', [
        'uses' => 'ClienteController@getCliente',
        'as' => 'clientes.show'
    ]);

});



/***Rutas para cupones***/
Route::group(['prefix'=>'cupones'], function (){

    //Ruta principal 
    Route::get('',[
        'uses' => 'CuponController@index',
        'as' => 'cupones.index'
    ]);

    //Ruta para crear nuevo
    Route::get('create',[
        'uses' => 'CuponController@create',
        'as' => 'cupones.create'
    ]);

    //Ruta para actualizar 
    Route::get('edit/{id}',[
        'uses' => 'CuponController@edit',
        'as'=> 'cupones.edit'
    ]);
    //POST REQUESTS
    Route::post('create',[
        'uses' => 'CuponController@store',
        'as'=> 'cupones.create'
    ]);

    Route::post('update',[
        'uses'=>'CuponController@update',
        'as'=> 'cupones.update'
    ]);

});

Route::get('acerca', function () {
    return view('otros.acerca-de');
})->name('otros.acerca');



Auth::routes();