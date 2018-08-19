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
        'as'=> 'auth.password'
    ]);

    Route::post('update',
    [
      'uses'=>'ResetController@update',
      'as'=>'auth.update'
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


    Route::get('edit', [
        'uses' => 'Auth\RegisterController@edit',
        'as' => 'auth.edit',
        'middleware' => 'can:admin-all'
    ]);

    Route::post('update', [
        'uses' => 'Auth\RegisterController@update',
        'as' => 'auth.update',
        'middleware' => 'can:admin-all'
    ]);

    Route::post('show', [
        'uses' => 'Auth\RegisterController@getCliente',
        'as' => 'auth.show'
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


    Route::get('grafico', [
        'uses' => 'CentroAcopioController@getFiltroGrafico',
        'as' => 'centros.reporte',
        'middleware' => 'can:admin-all'
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

    Route::post('showGrafico', [
        'uses' => 'CentroAcopioController@grafico',
        'as' => 'centros.grafico',
        'middleware' => 'can:admin-all'
    ]);



});

Route::get('dashboard',[
    'uses' => 'PaginaPublicaController@getUserDashboard',
    'as' => 'principal.dashboard'
]);

/***Rutas para materiales***/
Route::group(['prefix'=>'materiales'], function (){

      //Ruta principal 
    Route::get('', [
        'uses' => 'MaterialController@index',
        'as' => 'materiales.index'
    ]);

    Route::group(['middleware' => 'auth'], function () {

  

    //Ruta para crear nuevo
        Route::get('create', [
            'uses' => 'MaterialController@create',
            'as' => 'materiales.create',
            'middleware' => 'can:admin-all'
        ]);

    //Ruta para actualizar 
        Route::get('edit/{id}', [
            'uses' => 'MaterialController@edit',
            'as' => 'materiales.edit',
            'middleware' => 'can:admin-all,id'
        ]);


    //POST REQUESTS
        Route::post('create', [
            'uses' => 'MaterialController@store',
            'as' => 'materiales.create',
            'middleware' => 'can:admin-all'
        ]);

        Route::post('update', [
            'uses' => 'MaterialController@update',
            'as' => 'materiales.update',
            'middleware' => 'can:admin-all'
        ]);

        Route::post('delete/{id}',[
            'uses'=> 'MaterialController@destroy',
            'as' => 'materiales.delete',
            'middleware'=>'can:admin-all'
        ]);
    });    


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

     //Ruta para reducir -1 la cant del elemento en el shopping cart
    Route::get('reducir-cant/{id}', [
        'uses' => 'CanjeController@reducirEnUno',
        'as' => 'canjes.reducirCant',
        'middleware' => 'can:admin-center,id'
    ]);

     //Ruta para eliminar un elemento del shopping cart
    Route::get('eliminar-material/{id}', [
        'uses' => 'CanjeController@eliminarElemento',
        'as' => 'canjes.eliminarMaterial',
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

    Route::get('agregar-cupon/{id}',[
        'uses' => 'CanjeCuponController@agregarCupon',
        'as' => 'billeteravirtual.agregarCupon',
        'middleware' => 'can:cliente'
    ]);

     //Ruta para reducir -1 la cant del elemento en el shopping cart
    Route::get('reducir-cant/{id}', [
        'uses' => 'CanjeCuponController@reducirEnUno',
        'as' => 'billeteravirtual.reducirCant',
        'middleware' => 'can:cliente,id'
    ]);

     //Ruta para eliminar un elemento del shopping cart
    Route::get('eliminar-cupon/{id}', [
        'uses' => 'CanjeCuponController@eliminarElemento',
        'as' => 'billeteravirtual.eliminarCupon',
        'middleware' => 'can:cliente,id'
    ]);

    Route::get('show-all', [
        'uses' => 'CanjeCuponController@mostrarCuponesCanjeados',
        'as' => 'billeteravirtual.showAll',
        'middleware' => 'can:cliente'
    ]);

    Route::get('downloadPDF/{id}/{cant}', [
        'uses' => 'CanjeCuponController@descargarPDF',
        'as' => 'billeteravirtual.reportePDF',
        'middleware'=>'can:cliente'
    ]);

    //Rutas POST
    Route::post('create', [
        'uses' => 'CanjeCuponController@store',
        'as' => 'billeteravirtual.create',
        'middleware' => 'can:cliente'
    ]);

});


Auth::routes();