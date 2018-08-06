
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