<?php
    use \Firebase\JWT\JWT;
   /* use Slim\Psr7\Response;*/
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    include_once 'Itens_carrinho.php';
    include_once 'Itens_carrinho.php';



// cleinte precisa cadastra(inserir), precisa buscar o seus dados(buscarPorid ou login) e atualizar as informaçoes.
// criar controller carrinho, itens de carrinho.



    class Itens_carrinhoController{
        private $secretKey = "PPI2";

        public function inserir(Request $request, Response $response, $args)
        {
            $data = $request->getParsedBody();
            $dao_produto = new ProdutoDAO();
            $produto = $dao_produto->buscarPorid($data['produto']);
            $item = new Itens_carrinho($produto,$data['quantidade']);
            $dao = new Itens_carrinhoDAO();
            $carrinho_id = $args['id'];
            $dao->inserir($item, $carrinho_id);
            $payload = json_encode($item);   
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);

        }


        public function deletar(Request $request, Response $response, $args)
        {
            $carrinho_id = $args['carrinho_id'];
            $produto_id = $args['produto_id'];
            $dao = new Itens_carrinhoDAO;
            $item = $dao->deletar($carrinho_id, $produto_id);
            $payload = json_encode($item);    
            $response->getBody()->write($payload);
            return $response ->withHeader('Content-Type', 'application/json');
        }

        public function atualizar(Request $request, Response $response, $args)
        {

            $carrinho_id = $args['carrinho_id'];
            $produto_id = $args['produto_id'];
            $data = $request->getParsedBody();
            $dao = new Itens_carrinhoDAO;
            $item = $dao->buscarPorid($carrinho_id, $produto_id);
            $item->setQuantidade($data['quantidade']);
            $dao->atualizar($item, $carrinho_id);
            $payload = json_encode($item);
            $response->getBody()->write($payload);
            return $response ->withHeader('Content-Type', 'application/json');

        }

    };   
        

?>