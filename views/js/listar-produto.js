function listarProduto() {

    $(document).on('click', '.deletar', function(event) {

        var id = $(this).parent().parent().attr('id');
        console.log(id);

        var element = $(this).parent().parent();

        event.preventDefault();
        $.ajax({

            url: 'http://localhost/ecommerce/produto/deletar/' + id,
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
        $('#form-produto').show();
        $('#listar-produto').hide();
        $('#form-cliente').hide();
        // teste da linha 34

        var id = $(this).parent().parent().attr('id');
        console.log(id);

        event.preventDefault();


        $.ajax({

            url: 'http://localhost/ecommerce/produto/buscar/id/' + id,
            type: 'GET',
            headers: {

                "Authorization": localStorage.getItem('token')

            }

        }).done(function(data) {

            $('#form-produto input[name=nome]').val(data.nome);
            $('#form-produto input[name=valor]').val(data.valor);
            console.log(data);

        });


        $('#form-produto form').submit(function(event) {
            event.preventDefault();
            $.ajax({

                url: 'http://localhost/ecommerce/produto/atualizar/' + id,
                type: 'PUT',
                data: $(this).serialize(),
                dataType: 'json',
                headers: {

                    "Authorization": localStorage.getItem('token')

                }


            }).done(function(data) {

                $('#menssagem-produto').html('Produto Atualizado!!');
                $('#listar-produto').show();
                $('#form-produto').hide();
                $('#listar-cliente').hide();
                $('#form-produto form')[0].reset();
                listarProduto();
            });
            $(this).off(event);

        });
        $(this).off(event);

    });


    $.ajax({

        url: 'http://localhost/ecommerce/produto/listar',
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
            <th style='text-align: left;'>Preço</th>
            <th style='text-align: left;'>Editar</th>
            <th style='text-align: left;'>Deletar</th>
        </tr>
        `;

        data.forEach(element => {

            str += `
            <tr id=${element.id}>
                <td>${element.id}</td>
                <td>${element.nome}</td>
                <td>${element.valor}</td>
                <td><a class= "editar" href="">Editar</a></td>
                <td><a class= "deletar" href="">Deletar</a></td>
             </tr>
            
            `;

            console.log(element.id)

        });

        str += ` 

        </table>

        `;

        $('#tabela-produto').html(str);

    });




}