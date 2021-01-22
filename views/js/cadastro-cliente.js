function cadastroCliente() {

    $('#form-cliente form').submit(function(event) {

        event.preventDefault();
        $.ajax({

            url: 'http://localhost/ecommerce/cliente/inserir',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json'


        }).done(function(data) {

            $('#menssagem-cliente').html('Cliente cadstrado!!');
            $('#form-cliente form')[0].reset();
            console.log(data);
            $('#form-cliente').hide();
            $('#listar-cliente').show();
            listarCliente();

        });
        $(this).off(event);

    });

}