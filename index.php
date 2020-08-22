<?php include("ConexaoBD/conexao.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de palavras</title>
</head>
<body>
    <h1>GERADOR DE PALAVRAS</h1>


    <form name="instrucao"  method="GET">
            Canonicidade:<br>
            <input type="radio" name="canonicidade" value=1> Canônica<br>
            <input type="radio" name="canonicidade" value=0> Não canônica<br>
        
            Tipo da palavra:<br>
            <input type="radio" name="tipo" value=1> Oxítona<br>
            <input type="radio" name="tipo" value=2> Paroxítona<br>
            <input type="radio" name="tipo" value=3> Proparoxítona<br>
        
            <input type="submit" value="Procurar palavras"></input>
    </form> 

    <div>
        <h2>Palavras</h2>
        <ul>
            <?php
                $canonicidade = $_GET['canonicidade'];
                $tipo = $_GET['tipo'];

                $sql = "SELECT * FROM palavra WHERE canonicidade LIKE $canonicidade AND tipo LIKE $tipo";
                $dados = $conexao->query($sql);

                while($registro = mysqli_fetch_array($dados))
                {
                    $palavra = $registro['caracteres'];
                    echo "<li>".$palavra."</li>";
                }
            ?>
        </ul>
    </div>
    
</body>
</html>