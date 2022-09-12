<?php
require_once("../classes/login.php");
require_once("Conexao.php");

class EventoDAO{
    private $tabela = "login";

    // Estamos passando como parâmetro uma variável do tipo Evento, ou seja, o método irá esperar receber um valor que seja um objeto da classe Evento.
    public function inserir(Evento $login){
        $sql = "INSERT INTO {$this->tabela} VALUES(NULL,:nome,:senhaLogin)";
        $preparacao = Conexao::getConexao()->prepare($sql);

        $preparacao->bindValue(":nome",$login->nomeLogin);
        $preparacao->bindValue(":senhaLogin",$login->senhaLogin);
        

       
        $preparacao->execute();
        

        if($preparacao->rowCount() > 0){
            return true;
        }   
        else{
            return false;
        }   
         
    }
    public function consultar($dataBr = false){
        $sql = "SELECT * FROM {$this->tabela}";
        $preparacao = Conexao::getConexao()->prepare($sql);

        $preparacao->execute();

        if($preparacao->rowCount() > 0){
            $resultado =  $preparacao->fetchALL(PDO::FETCH_ASSOC);// o método fecthALL() retorna todos os registros do banco de dados e o valor PDO::FETCH_ASSOC, faz a associação do nome dos campos da tabela com os indices do vetor.
            if($dataBr){            
                foreach($resultado as $indice => $itens){
                    $data = new DateTime($itens["senha_login"]);
                    $resultado[$indice]["senha_login"] = $data->format("d/m/Y");
                }            
            }
           return $resultado;
        }
        else{
            return false;
        }
    }
    public function consultarUnico($id){
        $sql = "SELECT * FROM {$this->tabela} WHERE id_evento = :id";
        $preparacao = Conexao::getConexao()->prepare($sql);

        $preparacao->bindValue(":id", $id);

        $preparacao->execute();

        if($preparacao->rowCount() > 0){
            return  $preparacao->fetchALL(PDO::FETCH_ASSOC);// o método fecthALL() retorna todos os registros do banco de dados e o valor PDO::FETCH_ASSOC, faz a associação do nome dos campos da tabela com os indices do vetor.
        }
        else{
            return false;
        }
    }
    public function atualizar(Evento $login, $id){
        $sql = "UPDATE {$this->tabela} SET 
        nome_login = :nome, 
        senha_login = :senhaLogin, 
        foto_evento = :foto WHERE id_evento = :id";

        $preparacao = Conexao::getConexao()->prepare($sql);

        $preparacao->bindValue(":nome", $login->nomeLogin);
        $preparacao->bindValue(":senhaLogin", $login->senhaLogin);
        $preparacao->bindValue(":id", $id);

        $preparacao->execute();
  
        if($preparacao->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }

    }
    public function deletar($id){
        $sql = "DELETE FROM {$this->tabela} WHERE id_login = :id";

        $preparacao = Conexao::getConexao()->prepare($sql);
        $preparacao->bindValue(":id", $id);

        $preparacao->execute();
        if($preparacao->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}
