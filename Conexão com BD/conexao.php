<?php
$conexao = new mysqli("localhost","root","root","dicionario","3306");
    mysqli_set_charset($conexao,"utf8");
    
    
    if (mysqli_connect_errno())
      {
      echo
      '<div class="alert alert-danger text-center" role="alert">
          ERRO AO CONECTAR COM O BANCO DE DADOS: '. mysqli_connect_error() .'
      </div>';
      }

?>