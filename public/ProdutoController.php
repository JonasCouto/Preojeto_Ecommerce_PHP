<?php

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    include_once 'Produto.php';
    include_once 'ProdutoDAO.php';


    class ProdutoController{ 

        public function inserir(Request $request, Response $response, array $args)
        {

            $data = $request->getParsedBody();
            $produto = new Produto(0,$data['nome'],$data['valor']);
            $dao = new ProdutoDAO();
            $dao->inserir($produto);
            $payload = json_encode($produto);    
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
            
        }

        public function listar(Request $request, Response $response, array $args)
        {
            $dao_produto = new ProdutoDAO();
            $data = $dao_produto->listar();
            $payload = json_encode($data);
            $response->getBody()->write($payload);
            return $response-> withHeader ( 'Content-Type' , 'application/json' );
        }

        public function buscarPorNome(Request $request, Response $response, array $args)
        {
            $nome = $args['nome'];    
            $dao= new ProdutoDAO;    
            $produto = $dao->buscarPornome($nome);
            $payload = json_encode($produto);   
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');

        }

        public function buscarPorId(Request $request, Response $response, array $args){
            $id = $args['id'];
            $dao= new ProdutoDAO;    
            $produto = $dao->buscarPorid($id);
            $payload = json_encode($produto);
            $response->getBody()->write($payload);
            return $response ->withHeader('Content-Type', 'application/json');
        }


        public function atualizar(Request $request, Response $response, array $args)
        {

            $id = $args['id'];
            $data = $request->getParsedBody();
            $produto = new Produto($id, $data['nome'], $data['valor']);
            $dao = new ProdutoDAO;
            $dao->atualizar($produto);
            $payload = json_encode($produto);
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');

        }

        public function deletar(Request $request, Response $response, array $args)
        {

        $id = $args['id'];
        $dao = new ProdutoDAO;
        $produto = $dao->deletar($id);
        $payload = json_encode($produto);
        $response->getBody()->write($payload);
        return $response ->withHeader('Content-Type', 'application/json');

        }



    }



// cleinte precisa cadastra(inserir), precisa buscar o seus dados(buscarPorid ou login) e atualizar as informaçoes.
// criar controller para produtos, carrinho, itens de carrinho.




?>