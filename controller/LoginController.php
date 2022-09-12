<?php
session_start();// Iremos iniciar uma sessão no php
require_once("../classes/Login.php");
require_once("../model/LoginDAO.php");

$meuLogin = new Login();
$meuLoginoDAO = new LoginDAO();

if(isset($_POST["cadastrar"])){
    $_SESSION["mensagem"] = $meuLogin->inicio($_POST, $_FILES['banner']);
    if($_SESSION["mensagem"]["status"]){
        $meuEventoDAO->inserir($meuLogin);
    }
    header("Location:../view/CadastroView.php");// Redirecionando o usuário para a página CadastroView.php
    die();
}

if(isset($_POST["atualizar"])){
   $_SESSION["atualizar"] = $meuLogin->inicio($_POST, $_FILES["banner"]);
   if($_SESSION["atualizar"]["status"]){
        $meuEventoDAO->atualizar($meuLogin,$_POST["atualizar"]); // Estamos passando como parâmetro um objeto Evento e o id do evento que está atribuído ao $_POST['atualizar']
   }
   header("Location:../view/AtualizarEventoView.php");
   die();
}

if(isset($_POST["excluir"])){
    //echo "O id para excluir é {$_POST['excluir']}";
    $meuEventoDAO->deletar($_POST['excluir']);
    header("Location:../view/VisualizarEventoView.php");
    die();
}