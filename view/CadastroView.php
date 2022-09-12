<?php
    include_once("../includes/Cabecalho.php");

        // isset() verifica se alguma variável existe
        if(isset($_SESSION["mensagem"])){
            if($_SESSION["mensagem"]["status"]){ 
                echo"
                    <div class='alert alert-success alert-dismissible fade show'> 
                        <h4 class='text-center'>{$_SESSION['mensagem']['msg']}</h4>
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    </div>
                ";
            }
            else{
                echo"
                <div class='alert alert-danger alert-dismissible fade show'> 
                    <h4 class='text-center'>{$_SESSION['mensagem']['msg']}</h4>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                </div>
            ";
            }
        }
        unset($_SESSION["mensagem"]);// Destruindo a variável de sessão
    ?>
    <main class="container-fluid mt-5">

        <h1 class="text-center fw-bold">Cadastre um novo login</h1>
        <hr>
        <form action="../controller/LoginController.php" method="post" class="mt-5" enctype="multipart/form-data">        
            <section class="container col-md-6">
                <div class="row mb-3">
                    <label for="nomeLogin" class="form-label">
                        Nome <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="nomeLogin" id="nomeLogin" class="form-control">
                </div>

                <div class="row mb-3">
                    <label for="senhaLogin" class="form-label">
                        Senha do usuário <span class="text-danger">*</span>
                    </label>
                    <input type="date" name="senhaLogin" id="senhaLogin" class="form-control">
                </div>

                <input type="hidden" name="cadastrar">
                <button type="submit" class="btn btn-primary my-3 col-12">Cadastrar</button>
            </section>
        </form>
    </main>

<?php
    include_once("../includes/Rodape.php");
?>