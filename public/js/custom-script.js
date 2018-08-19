
/*
*  Función Ajax para traer un cliente de la base de datos 
*/
$(".show").on('click','.buscarCliente',function(e){

    e.preventDefault();

    $.ajax({
        type:'POST',
        url:'/clientes/show',
        datatype:'json',
        data:{
            '_token':$('input[name=_token]').val(),
            'emailCliente':$('#emailCliente').val()
        },
        success:function(data){
            if ((data.errors)) {
                
                $.each(data.errors, function(key, value){
                    $('.alert-danger').show();
                    $('.alert-danger').append('<p>'+value+'</p>');
                });
            }else{

                if (data.name != null) {
                    $('#lblNombreCliente').text(data.name);
                    $('#cliente_id').val(data.id);
                }else{
                    $('#lblNombreCliente').text('No existe el usuario');
                }
               
            }
        }
    });
});

/*
*  Función Ajax para traer un admin centro acopio de la base de datos 
*/
$(".show").on('click','.buscarAdmin',function(e){

    e.preventDefault();

    $.ajax({
        type:'POST',
        url:'/auth/show',
        datatype:'json',
        data:{
            '_token':$('input[name=_token]').val(),
            'emailCliente':$('#emailCliente').val()
        },
        success:function(data){
            if ((data.errors)) {
                
                $.each(data.errors, function(key, value){
                    $('.alert-danger').show();
                    $('.alert-danger').append('<p>'+value+'</p>');
                });
            }else{

                if (data.name != null) {
                    $('#lblNombreCliente').text(data.name);
                    $('#cliente_id').val(data.id);
                    $('#name').val(data.name);
                    $('#direccion').val(data.direccion);
                    $('#telefono').val(data.telefono);
                    $('#email').val(data.email);
                    
                }else{
                    $('#lblNombreCliente').text('No existe el usuario');
                }
               
            }
        }
    });
});