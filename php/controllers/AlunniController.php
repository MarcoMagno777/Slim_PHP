<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController
{
  public function index(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM alunni");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function show(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $id = (int) $args['id'];
    $result = $mysqli_connection->query("SELECT * FROM alunni WHERE id = $id");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function create(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $dati = $request->getParsedBody();
    $nome = $dati['nome'];
    $cognome = $dati['cognome'];
    $result = $mysqli_connection->query("INSERT INTO alunni(nome, cognome) VALUES ('$nome', '$cognome')");

    if ($result) {
        $response_data = [
            'status' => 'success',
            'id' => $id,
            'nome' => $nome,
            'cognome' => $cognome
        ];
    } else {
        $response_data = [
            'status' => 'error',
            'message' => 'Failed to insert record'
        ];
    }

    $response->getBody()->write(json_encode($response_data));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function update(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $dati = $request->getParsedBody();
    $id = (int) $args['id'];
    $nome = $dati['nome'];
    $cognome = $dati['cognome'];
    $result = $mysqli_connection->query("UPDATE alunni SET nome = '$nome', cognome = '$cognome' WHERE id = $id");

    if ($result) {
        $response_data = [
            'status' => 'success',
            'id' => $id,
            'nome' => $nome,
            'cognome' => $cognome
        ];
    } else {
        $response_data = [
            'status' => 'error',
            'message' => 'Failed to insert record'
        ];
    }

    $response->getBody()->write(json_encode($response_data));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function destroy(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $id = (int) $args['id'];
    $result = $mysqli_connection->query("DELETE FROM alunni WHERE id = $id");
      if ($result) {
        $response_data = [
            'status' => 'success',
            'id' => $id,
            'nome' => $nome,
            'cognome' => $cognome
        ];
    } else {
        $response_data = [
            'status' => 'error',
            'message' => 'Failed to insert record'
        ];
    }

    $response->getBody()->write(json_encode($response_data));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function indexCertificazioni(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $idAl = (int) $args['idAl'];
    $result = $mysqli_connection->query("SELECT * FROM certificazioni WHERE alunno_id = $idAl");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function showCertificazioni(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $idAl = (int) $args['idAl'];
    $idC = (int) $args['idC'];
    $result = $mysqli_connection->query("SELECT * FROM alunni a JOIN certificazioni c ON a.id = c.alunno_id WHERE a.id = $idAl AND c.id = $idC");

    if ($result) {
        $results = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $results = [
            'status' => 'error',
            'message' => 'not found'
        ];
    }

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function createCertificazioni(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $dati = $request->getParsedBody();
    $nome = $dati['nome'];
    $cognome = $dati['cognome'];
    $result = $mysqli_connection->query("INSERT INTO alunni(nome, cognome) VALUES ('$nome', '$cognome')");

    if ($result) {
        $response_data = [
            'status' => 'success',
            'id' => $id,
            'nome' => $nome,
            'cognome' => $cognome
        ];
    } else {
        $response_data = [
            'status' => 'error',
            'message' => 'Failed to insert record'
        ];
    }

    $response->getBody()->write(json_encode($response_data));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function updateCertificazioni(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $dati = $request->getParsedBody();
    $id = (int) $args['id'];
    $nome = $dati['nome'];
    $cognome = $dati['cognome'];
    $result = $mysqli_connection->query("UPDATE alunni SET nome = '$nome', cognome = '$cognome' WHERE id = $id");

    if ($result) {
        $response_data = [
            'status' => 'success',
            'id' => $id,
            'nome' => $nome,
            'cognome' => $cognome
        ];
    } else {
        $response_data = [
            'status' => 'error',
            'message' => 'Failed to insert record'
        ];
    }

    $response->getBody()->write(json_encode($response_data));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function destroyCertificazioni(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $id = (int) $args['id'];
    $result = $mysqli_connection->query("DELETE FROM alunni WHERE id = $id");
      if ($result) {
        $response_data = [
            'status' => 'success',
            'id' => $id,
            'nome' => $nome,
            'cognome' => $cognome
        ];
    } else {
        $response_data = [
            'status' => 'error',
            'message' => 'Failed to insert record'
        ];
    }

    $response->getBody()->write(json_encode($response_data));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

}
