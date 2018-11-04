<?php
// chamamos o ficheiro que faz ligação á base de dados "include('../ligar_bd.php');"
include('../ligar_bd.php');

session_start();
// session_start Verifica se existe uma sessão de admin. Senão tiver entao é redirecionado para o login.php. Isto serve para bloquear o acesso atraves da url do browser

if(isset($_SESSION['admin'])==null){
  header('location:login.php');
}

 $id = $_GET['id'];
 var_dump($id);
  // quero para mostrar toda a informação da atividade para depois estar predefenida no formulario
  //para puder mudar
  $sql = $db->prepare(" DELETE FROM `activity` where idActivity = :id ");

  $sql->bindParam(':id', $id);

  $sql->execute();

  $count = $sql->rowCount();
    
//se ouver uma alteraçao na tabela quer dizer que foi feito com sucesso assim redireciona para as atividades
        if ($count > 0){
            header('location:activities.php');
        }else {
            echo"error deleting activity";
        }

    

?>