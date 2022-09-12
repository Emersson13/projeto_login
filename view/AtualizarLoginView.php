<?php
    include_once("../includes/Cabecalho.php");
    require_once("../model/LoginDAO.php");

    if(!isset($_SESSION["id_login"])){
        $_SESSION["id_login"] = $_POST["id_login"];
    }
    $meuLoginDAO = new LoginDAO();

    $resultado = $meuLoginDAO->consultarUnico($_SESSION["id_login"]);
    $elemento = $resultado[0];
    //print_r($resultado);
    //echo "O id do evento selecionado é {$id_login}";

    if(isset($_SESSION["atualizar"])){
        if($_SESSION["atualizar"]["status"]){ 
            echo"
                <div class='alert alert-success alert-dismissible fade show'> 
                    <h4 class='text-center'>{$_SESSION['atualizar']['msg']}</h4>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                </div>
            ";
        }
        else{
            echo"
            <div class='alert alert-danger alert-dismissible fade show'> 
                <h4 class='text-center'>{$_SESSION['atualizar']['msg']}</h4>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            </div>
        ";
        }
    }
    unset($_SESSION["atualizar"]);// Destruindo a variável de sessão
    ?>
    <main class="container-fluid mt-5">

        <h1 class="text-center fw-bold">Atualizar Evento</h1>
        <hr>
        <form action="../controller/LoginController.php" method="post" class="mt-5" enctype="multipart/form-data">        
            <section class="container col-md-6">
                <div class="row mb-3">
                    <label for="nomeLogin" class="form-label">
                        Nome <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="nomeLogin" id="nomeLogin" class="form-control" value="<?=$elemento['nome_login']?>">
                </div>

                <div class="row mb-3">
                    <label for="senhaLogin" class="form-label">
                        Data do evento <span class="text-danger">*</span>
                    </label>
                    <input type="date" name="senhaLogin" id="senhaLogin" class="form-control" value="<?=$elemento['senha_login']?>">
                </div>
            </section>
        </form>
    </main>

<?php
    include_once("../includes/Rodape.php");
?>