function tokenLoja() {

    $('form').submit(function(event) {

        event.preventDefault();
        $.ajax({

            url: 'http://localhost/ecommerce/cliente/login',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json'



        }).done(function(data) {
            $('#menssagem').html('Cliente cadstrado!!');
            console.log(data);
            localStorage.setItem('token', data.token);
            $('#home').show();
            $('#landing').hide();

            // window.location = 'http://localhost/ecommerce/views/LISTAR_CLIENTE.html'
            // tirar window, arrumar o form, dentro do done ocultar section landipage e mostrar todo home

        });

    });

}