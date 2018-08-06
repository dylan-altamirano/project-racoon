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
        'as' => 'centros.create',
        'middleware'=> 'can:admin-all'
    ]);

    //Ruta para actualizar 
    Route::get('edit/{id}',[
        'uses' => 'CentroAcopioController@edit',
        'as'=> 'centros.edit',
        'middleware' => 'can:admin-all, id'
    ]);

    Route::get('habilitar/{id}',[
        'uses' => 'CentroAcopioController@habilitar',
        'as'=> 'centros.habilitar',
        'middleware' => 'can:admin-all, id'
    ]);

   

    //POST REQUESTS
    Route::post('create',[
        'uses' => 'CentroAcopioController@store',
        'as'=> 'centros.create',
        'middleware' => 'can:admin-all'
    ]);

    Route::post('update',[
        'uses'=>'CentroAcopioController@update',
        'as'=> 'centros.update',
        'middleware' => 'can:admin-all'
    ]);



});

Route::get('dashboard',[
    'uses' => 'PaginaPublicaController@getUserDashboard',
    'as' => 'principal.dashboard'
]);

/***Rutas para materiales***/
Route::group(['prefix'=>'materiales', 'middleware'=> 'auth'], function (){

    //Ruta principal 
    Route::get('',[
        'uses' => 'MaterialController@index',
        'as' => 'materiales.index'
    ]);

    //Ruta para crear nuevo
    Route::get('create',[
        'uses' => 'MaterialController@create',
        'as' => 'materiales.create',
        'middleware' => 'can:admin-all'
    ]);

    //Ruta para actualizar 
    Route::get('edit/{id}',[
        'uses' => 'MaterialController@edit',
        'as'=> 'materiales.edit',
        'middleware' => 'can:admin-all,id'
    ]);


    //POST REQUESTS
    Route::post('create',[
        'uses' => 'MaterialController@store',
        'as'=> 'materiales.create',
        'middleware' => 'can:admin-all'
    ]);

    Route::post('update',[
        'uses'=>'MaterialController@update',
        'as'=> 'materiales.update',
        'middleware' => 'can:admin-all'
    ]);
});

/*Rutas para Canjes */
Route::group(['prefix'=>'canjes','middleware' => 'auth'], function (){

    //Ruta principal
    Route::get('',[
        'uses' => 'CanjeController@index',
        'as' => 'canjes.index',
        'middleware' => 'can:admin-center'
    ]);

    //Ruta para el shopping cart
    Route::get('agregar-canje/{id}', [
        'uses' => 'CanjeController@agregarMaterial',
        'as'=> 'canjes.agregarMaterial',
        'middleware' => 'can:admin-center,id'
    ]);

    //Ruta para crear el canje
    Route::get('create',[
        'uses' => 'CanjeController@create',
        'as' => 'canjes.create',
        'middleware' => 'can:admin-center'
    ]);
    
    //Ruta para guardar el canje
    Route::post('create', [
        'uses' => 'CanjeController@store',
        'as' => 'canjes.create',
        'middleware' => 'can:admin-center'
    ]);

    //Ruta para mostrar un canje
    Route::get('show/{id}',[
        'uses' => 'CanjeController@show',
        'as' => 'canjes.show',
        'middleware' => 'can:admin-center,id'
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
Route::group(['prefix'=>'cupones', 'middleware'=> 'auth'], function (){

    //Ruta principal 
    Route::get('',[
        'uses' => 'CuponController@index',
        'as' => 'cupones.index',
    ]);

    //Ruta para crear nuevo
    Route::get('create',[
        'uses' => 'CuponController@create',
        'as' => 'cupones.create',
        'middleware' => 'can:admin-all'
    ]);

    //Ruta para actualizar 
    Route::get('edit/{id}',[
        'uses' => 'CuponController@edit',
        'as'=> 'cupones.edit',
        'middleware' => 'can:admin-all, id'
    ]);
    //POST REQUESTS
    Route::post('create',[
        'uses' => 'CuponController@store',
        'as'=> 'cupones.create',
        'middleware' => 'can:admin-all'
    ]);

    Route::post('update',[
        'uses'=>'CuponController@update',
        'as'=> 'cupones.update',
        'middleware' => 'can:admin-all'
    ]);

});

Route::get('acerca', function () {
    return view('otros.acerca-de');
})->name('otros.acerca');


/***Rutas para BILLETERA VIRTUAL-CANJECUPONES***/
Route::group(['prefix' => 'billeteravirtual'], function () {

    //Ruta principal 
    Route::get('', [
        'uses' => 'CanjeCuponController@index',
        'as' => 'billeteravirtual.index',
        'middleware'=>'can:cliente'
    ]);

    Route::get('create',[
        'uses' => 'CanjeCuponController@create',
        'as' => 'billeteravirtual.create',
        'middleware'=>'can:cliente'
    ]);

});


Auth::routes();