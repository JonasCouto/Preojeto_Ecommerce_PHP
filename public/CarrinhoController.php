<?php
    use \Firebase\JWT\JWT;
   /* use Slim\Psr7\Response;*/
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    include_once 'Carrinho.php';
    include_once 'CarrinhoDAO.php';



    class CarrinhoController{
        private $secretKey = "PPI2";

        public function inserir(Request $request, Response $response, $args)
        {
            
            $data = $request->getParsedBody();
            $carrinho = new Carrinho(0,$data['cliente'],date('Y-m-d H:i:s'), $data['compra_finalizada']);
            $dao = new CarrinhoDAO();
            $dao->inserir($carrinho);
            $payload = json_encode($carrinho);   
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);

        }

        public function buscarPorid(Request $request, Response $response, $args)
        {
            $id = $args['id'];
            $dao = new CarrinhoDAO;
            $itens_dao = new Itens_carrinhoDAO;      
            $carrinho = $dao->buscarPorid($id);
            $itens = $itens_dao->buscarPorcarrinho($id);
            $carrinho->setlista_itens($itens);
            $payload = json_encode($carrinho);   
            $response->getBody()->write($payload);
            return $response ->withHeader('Content-Type', 'application/json');

        }

        public function buscarPorNome(Request $request, Response $response, $args)
        {

            $id = $args['id'];
            $dao= new CarrinhoDAO; 
            $itens_dao = new Itens_carrinhoDAO;
            $carrinhos = $dao->buscarPoridcliente($id);
            foreach ($carrinhos as $carrinho)
            {
                $itens = $itens_dao->buscarPorcarrinho($carrinho->getId());
                $carrinho->setlista_itens($itens);
            }
            $payload = json_encode($carrinhos);
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');

        }


        public function deletar(Request $request, Response $response, $args)
        {

            $id = $args['id'];
            $dao = new CarrinhoDAO;
            $carrinho = $dao->deletar($id);
            $payload = json_encode($carrinho);
            $response->getBody()->write($payload);
            return $response ->withHeader('Content-Type', 'application/json');

        }

    };   
        

?>