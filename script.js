$(document).ready( () => {

        $.ajax({
            type: 'GET',
            url: 'app.php',
           // dataType: 'json', 

            success: dados => {
                console.log(dados);

                $('#preco').html(dados.preco_da_caixa)
                $('#produto').html(dados.nome_produto)

            },
            error: erro => {console.log(erro)}
        })
        //metodo, url, dados, sucesso ou erro
    

})