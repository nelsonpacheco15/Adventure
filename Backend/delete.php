<?php
include('../ligar_bd.php'); // chamamos o ficheiro que faz ligação á base de dados "include('../ligar_bd.php');"

session_start(); //inicia a possibilidade de poder utilizar a ferramenta $_SESSION

// Verifica se existe uma sessão de admin. Senão tiver entao é redirecionado para o login.php. Isto serve para bloquear o acesso atraves da url do browser
if(isset($_SESSION['admin'])==null){
  header('location:login.php');
}

$id = $_GET['id']; // Guardamos o id que vem pela sessao do activities.php numa variavel $id

$sql = $db->prepare(" DELETE FROM `activity` where idActivity = :id "); // Query de SQL que vai á base de dados 
$sql->bindParam(':id', $id); // Encriptação dos dados da variavel $id
$sql->execute();// Execução da query

$count = $sql->rowCount(); // Guardamos o numero de vezes que foram feitas alteraçoes nas linhas da tabela das atividades numa variavel $count 
    if ($count > 0){ // Comparamos a variavel que guardou o numero de vezes da query 
        header('location:activities.php');
    }else {
        echo"error deleting activity";
    }
?>