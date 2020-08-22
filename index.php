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
            Tipo da palavra:<br>
            <input type="radio" name="tipo" value="O"> Oxítona<br>
            <input type="radio" name="tipo" value="P"> Paroxítona<br>
            <input type="radio" name="tipo" value="PP"> Proparoxítona<br>

            Canonicidade:<br>
            <input type="radio" name="canonicidade" value="S"> Canônica<br>
            <input type="radio" name="canonicidade" value="N"> Não canônica<br>
            
        
            <input type="submit" value="Procurar palavras"></input>
    </form> 

    <div>
        <h2>Palavras</h2>
        <ul>
        <?php
            $sql = "SELECT * FROM palavra WHERE canonicidade LIKE 1 AND tipo LIKE 3";
            $dados = $conexao->query($sql);

            while($registro = mysqli_fetch_array($dados))
            {
                $palavra = $registro['caracteres'];
                echo "<li>".$palavra."</li>";
            }
        ?>
        </ul>
    </div>

    <!--<script>
        var form = document.forms.instrucao;
        var lista = document.getElementsByTagName("ul")[0];
    
        form.addEventListener("submit", insereElementoNovoLista);

        function insereElementoNovoLista(e){
            e.preventDefault();
            console.log("teste");
            let novoLi = document.createElement("li");
            novoLi.textContent = "teste";
            lista.appendChild(novoLi);
        }

    </script>-->
    
</body>
</html>