function listarCliente() {
    $(document).on('click', '.deletar', function(event) {

        var id = $(this).parent().parent().attr('id');
        console.log(id);

        var element = $(this).parent().parent();

        event.preventDefault();
        $.ajax({

            url: 'http://localhost/ecommerce/cliente/deletar/' + id,
            type: 'DELETE',
            headers: {

                "Authorization": localStorage.getItem('token')

            }

        }).done(function(data) {

            element.remove();
            console.log(data);

        });
        // $(this).off(event);

    });

    $(document).on('click', '.editar', function(event) {
        $('#form-cliente').show();
        $('#listar-cliente').hide();
        $('#form-produto').hide();
        // teste da linha 33



        var id = $(this).parent().parent().attr('id');
        console.log(id);

        event.preventDefault();

        $.ajax({

            url: 'http://localhost/ecommerce/cliente/buscar/id/' + id,
            type: 'GET',
            headers: {

                "Authorization": localStorage.getItem('token')

            }

        }).done(function(data) {

            $('#form-cliente input[name=nome]').val(data.nome);
            $('#form-cliente input[name=idade]').val(data.idade);
            $('#form-cliente input[name=email]').val(data.email);
            $('#form-cliente input[name=endereco]').val(data.endereco);
            $('#form-cliente input[name=cep]').val(data.cep);
            $('#form-cliente input[name=telefone]').val(data.telefone);
            $('#form-cliente input[name=login]').val(data.login);
            $('#form-cliente input[name=senha]').val(data.senha);
            console.log(data);

        });

        $('#form-cliente form').submit(function(event) {

            event.preventDefault();
            $.ajax({

                url: 'http://localhost/ecommerce/cliente/atualizar/' + id,
                type: 'PUT',
                data: $(this).serialize(),
                dataType: 'json',
                headers: {

                    "Authorization": localStorage.getItem('token')
                }


            }).done(function(data) {
                $('#menssagem-cliente').html('Cliente Atualizado!!');
                $('#form-cliente').hide();
                $('#listar-cliente').show();
                $('#form-cliente form')[0].reset();
                listarCliente();

                console.log(data);

            });
            $(this).off(event);
        });
        $(this).off(event);

    });


    $.ajax({

        url: 'http://localhost/ecommerce/cliente/listar',
        type: 'GET',
        headers: {

            "Authorization": localStorage.getItem('token')

        }

    }).done(function(data) {
        console.log(data);

        var str = `
        <table border='1'>
        <tr>
            <th style='text-align: left;'>Id</th>
            <th style='text-align: left;'>Nome</th>
            <th style='text-align: left;'>Idade</th>
            <th style='text-align: left;'>E-mail</th>
            <th style='text-align: left;'>Telefone</th>
            <th style='text-align: left;'>Endereço</th>
            <th style='text-align: left;'>Login</th>
            <th style='text-align: left;'>Senha</th>
            <th style='text-align: left;'>Editar</th>
            <th style='text-align: left;'>Deletar</th>
        </tr>
        `;

        data.forEach(element => {

            str += `
            <tr id=${element.id}>
                <td>${element.id}</td>
                <td>${element.nome}</td>
                <td>${element.idade}</td>
                <td>${element.email}</td>
                <td>${element.telefone}</td>
                <td>${element.endereco}</td>
                <td>${element.login}</td>
                <td>**</td>
                <td><a class= "editar" href="">Editar</a></td>
                <td><a class= "deletar" href="">Deletar</a></td>
             </tr>
            
            `;
            console.log(element.id)

        });

        str += ` 

        </table>

        `;

        $('#tabela').html(str);

    });
}