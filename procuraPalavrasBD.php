<?php
    include("ConexaoBD/conexao.php");

    $canonicidade = intval($_GET['canonicidade']);
    $tipo = intval($_GET['tipo']);
    
    $sql = "SELECT * FROM palavra WHERE canonicidade LIKE $canonicidade AND tipo LIKE $tipo  ORDER BY RAND() LIMIT 30";
    $dados = $conexao->query($sql);

    $data = array();
    while($registro = mysqli_fetch_array($dados))
    {
        $data[] = $registro;
    }

    echo json_encode($data);
?>