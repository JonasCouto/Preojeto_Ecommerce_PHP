function cadastroProduto() {

    $('#form-produto form').submit(function(event) {

        event.preventDefault();
        $.ajax({

            url: 'http://localhost/ecommerce/produto/inserir',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            headers: {

                "Authorization": localStorage.getItem('token')

            }

        }).done(function(data) {

            $('#menssagem-produto').html('Produto cadstrado!!');
            $('#form-produto form')[0].reset();
            console.log(data);
            $('#listar-produto').show();
            $('#form-produto').hide();
            $('#listar-cliente').hide();
            listarProduto();

        });
        $(this).off(event);

    });
}