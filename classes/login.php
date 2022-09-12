<?php
class Login{
    // Atributos
    private $nomeLogin;
    private $senhaLogin;
    private $banner;
    private $mensagem = [];// Esse atributo irá armazenar as mensagens de erro e sucesso

    // Métodos: comportamentos
    /**
     * @param $campos: este parâmetro espera receber uma constante $_POST
     * @param $arquivo: este parâmetro espera receber um valor como por exemplo $_FILES['banner']
     * 
     */
    public function inicio($campos, $arquivo){
        // Verificar se os campos estão em branco
        if($this->recebeDados($campos)){
           if($this->senhaLogin($campos["senhaLogin"])){
                if($this->recebeArquivo($arquivo)){
                    $this->mensagem = [
                        "status"=>true,
                        "msg" => "Senha válida"
                    ];
                }
                else{
                    $this->mensagem = [
                        "status" => false,
                        "msg" => "Senha inválida ou campo vazio"
                    ];
                }
           }
           else{
                $this->mensagem = [
                    "status" => false,
                    "msg" => "Sei lá"
                ];
           }  
        }
        else {
            $this->mensagem = [
                "status" => false,
                "msg" => "Os campos não podem ficar em branco"
            ];
            
        }
        return $this->mensagem; 
    }

    public function validaData($data){

        $senhaLogin = new DateTime($data);// Esta classe precisa de uma data no padrão americano para funcionar
        $dataAtual = new DateTime("now");// estamos pegando a data atual
       // echo $senhaLogin->format("d/m/Y");// mostrando a data no padrão brasileiro
        //echo "<br> A data de hoje é: ";
       // print_r($dataAtual);
    
        if($senhaLogin > $dataAtual){
           // echo "<p>Data do evento cadastrado com sucesso!</p>";
           return true;
        }
        else{
           // echo "<p>A data do evento não pode ser igual ou anterior à data atual</p>";
           return false;
        }
    }

    public function recebeDados($campos){
        $this->nomeLogin = $campos["nomeLogin"];
        $this->senhaLogin = $campos["senhaLogin"];
        if(empty($this->nomeLogin) || empty($this->senhaLogin)){
            return false;
        }
        else{
            return true;
        }
        //echo "O {$this->nomeLogin} vai acontecer na data {$this->senhaLogin}";
    }

    // Essa função irá receber o comando no padrão $_FILES['nome_arquivo']
    public function recebeArquivo($banner){
        
        //$nomeArquivo = $_FILES["banner"]["name"];
        //$nomeTemporario = $_FILES["banner"]["tmp_name"];
        $this->banner = $banner;// estou atribuindo $_FILES['banner'] para $this->banner


        if(empty($this->banner["name"])){
            //echo"<br> Arquivo vazio";
            return false;
        }
        else{
            //echo "<br> Arquivo aceito";

            $infoArquivo = pathinfo($this->banner["name"]);// retorna um array com informações mais detalhadas do arquivo
           /*
            echo"<br>";
            echo "<pre>";
                print_r($infoArquivo);
            echo "</pre>";
            */

            if($infoArquivo["extension"] == "jpg" || $infoArquivo["extension"] == "png"){
                //echo"<br> formato de arquivo aceito";
                
                
                // Copiando imagem para o servidor
                $pasta = "../imagens/";
                // Iremos verificar se a pasta existe ou não
                if(!file_exists($pasta)){
                    mkdir($pasta,0777,true);// a função mkdir precisa de 3 parâmetros: 1. nome da pasta; 2. permisão para ler e escrever na pasta; 3. se irá criar subpastas ou não
                }

                // RENOMEANDO O ARQUIVO
                $novoNome = new DateTime();
                //echo "<hr>".$novoNome->getTimestamp();
                $nomeFinal = $novoNome->getTimestamp().".".$infoArquivo["extension"];
                //echo "<hr>".$nomeFinal;

                $caminhoFinal = $pasta.$nomeFinal;
                move_uploaded_file($this->banner["tmp_name"], $caminhoFinal);
                //echo "<img src='{$caminhoFinal}' width='200px' height='200px'>";

                $this->banner = $caminhoFinal;
                return true;

            }
            else{
                //echo "<br> Formato de arquivo inválido";
                return false;
            }
        }
    }

    public function __get($atributo){
        return $this->$atributo;
    }
}

// Instanciando um objeto
/*
$meuEvento = new Evento();
print_r($meuEvento);
echo "<hr>";
$meuEvento->recebeArquivo($_FILES["banner"]);
*/