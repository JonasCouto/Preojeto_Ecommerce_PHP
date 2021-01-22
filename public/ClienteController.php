<?php
    use \Firebase\JWT\JWT;
   /* use Slim\Psr7\Response;*/
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    include_once 'Cliente.php';
    include_once 'ClienteDAO.php';



// cleinte precisa cadastra(inserir), precisa buscar o seus dados(buscarPorid ou login) e atualizar as informaçoes.
// criar controller carrinho, itens de carrinho.



    class ClienteController{
        private $secretKey = "PPI2";

        public function inserir(Request $request, Response $response, $args)
        {

            $var = $request->getParsedBody();
            $cliente = new Cliente(0, $var['nome'],$var['idade'],$var['email'],$var['telefone'],$var['cep'],$var['endereco'], $var['login'], $var['senha']); 
            $dao = new ClienteDAO;    // estanciei o dao que permite conectar com o banco
            $dao->inserir($cliente); // inserir o objeto no banco atraves do DAO
            $payload = json_encode($cliente); // converter o objeto em formato Json
            $response->getBody()->write($payload); // escrevendo a resposta ´para o usuario
            return $response-> withHeader ( 'Content-Type' , 'application/json' ); //resposta do cabeçalho


        }

        public function listar(Request $request, Response $response, $args)
        {

            $dao_cliente = new ClienteDAO();
            $data = $dao_cliente->listar();
            $payload = json_encode($data);
            $response->getBody()->write($payload);
            return $response-> withHeader ( 'Content-Type' , 'application/json' );

        }

        public function buscarPorNome(Request $request, Response $response, $args)
        {

            $nome = $args['nome']; 
            $dao= new ClienteDAO;    
            $cliente = $dao->buscarPornome($nome); 
            $payload = json_encode($cliente);
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');

        }


        public function buscarPorId(Request $request, Response $response, array $args)
        {

            $id = $args['id'];
            $dao= new ClienteDAO;    
            $cliente = $dao->buscarPorid($id);
            $payload = json_encode($cliente);    
            $response->getBody()->write($payload);
            return $response ->withHeader('Content-Type', 'application/json');

        }

        public function deletar(Request $request, Response $response, array $args)
        {

            $id = $args['id'];
            $dao = new ClienteDAO;
            $cliente = $dao->deletar($id);
            $payload = json_encode($cliente);    
            $response->getBody()->write($payload);
            return $response ->withHeader('Content-Type', 'application/json');

        }


        public function atualizar(Request $request, Response $response, array $args)
        {
            $id = $args['id'];
            $data = $request->getParsedBody();
            // var_dump($data);
            $cliente = new Cliente($id, $data['nome'],$data['idade'], $data['email'], $data['telefone'], $data['cep'], $data['endereco'], $data['login'], $data['senha']);
            // var_dump($cliente); 
            $dao = new ClienteDAO;
            $dao->atualizar($cliente);
            $payload = json_encode($cliente);                
            $response->getBody()->write($payload);
            return $response ->withHeader('Content-Type', 'application/json');

        }

        
        public function autenticar(Request $request, Response $response, $args)
        {
            $user = $request->getParsedBody();
            
            $dao= new ClienteDAO;    
            $cliente = $dao->buscarPorLogin($user['login']);
            if($cliente->senha == $user['senha'])
            {
                $token = array(
                    'user' => strval($cliente->id),
                    'nome' => $cliente->nome
                );
                $jwt = JWT::encode($token, $this->secretKey);
                /*return $response->withJson(["token" => $jwt], 201)->withHeader('Content-type', 'application/json');*/   
                $payload = json_encode(["token" => $jwt]);
                $response->getBody()->write($payload);
                return $response-> withHeader ( 'Content-Type' , 'application/json' );
            }
            else
                return $response->withStatus(401);
        }

        public function validarToken($request, $handler)
        {
            $response = new Slim\Psr7\Response();
            $token = $request->getHeader('Authorization');
            
            if($token && $token[0])
            {
                try {
                    $decoded = JWT::decode($token[0], $this->secretKey, array('HS256'));

                    if($decoded){
                        $response = $handler->handle($request);
                        return($response);
                    }
                } catch(Exception $error) {

                    return $response->withStatus(401);
                }
            }
            
            return $response->withStatus(401);
        }
    }

?>