<?php include("ConexaoBD/conexao.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script
      src="https://code.jquery.com/jquery-3.5.1.js"
      integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
      crossorigin="anonymous">
    </script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de palavras</title>
</head>
<body>
    <h1>GERADOR DE PALAVRAS</h1>


    <form name="instrucao"  method="POST">
            Canonicidade:<br>
            <input type="radio" name="canonicidade" id="canonico" value=1> Canônica<br>
            <input type="radio" name="canonicidade" id="naoCanonico" value=0> Não canônica<br>
        
            Tipo da palavra:<br>
            <input type="radio" name="tipo" value=1 id="oxitona" > Oxítona<br>
            <input type="radio" name="tipo" value=2 id="paroxitona" > Paroxítona<br>
            <input type="radio" name="tipo" value=3 id="proparoxitona" > Proparoxítona<br>
        
    </form> 
    
    <div>
        <h2>Palavras encontradas</h2>
        <form name="instrucao"  method="POST">
            <ul id="palavra">

            </ul>
         </form>
    <button onclick="checarCaracteristicas()"> Procurar palavras no Banco de dados </button>
        <h2>Palavras encontradas</h2>
         <ul id="resultado">

         </ul>
    <button onclick="coletaPalavra()"> Armazenar palavras selecionadas </button>
    </div>

    <div>
        <h2>Criar novas palavras</h2>
        <ul>

        </ul>
        <button>Criar</button>

    </div>


    <script>
    
        var canonicidade1 = document.getElementById("canonico");
        var canonicidade2 = document.getElementById("naoCanonico");

        var tipo1 = document.getElementById("oxitona");
        var tipo2 = document.getElementById("paroxitona");
        var tipo3 = document.getElementById("proparoxitona");

        var palavrasSemente = [];

        function checarCaracteristicas(){
            var canonicidade = canonicidade1.value;
            if(canonicidade1.checked)
                canonicidade = canonicidade1.value;
            else if(canonicidade2.checked)
                canonicidade = canonicidade2.value;

            var tipo = tipo1.value;
            if(tipo1.checked)
                tipo = tipo1.value;
            else if(tipo2.checked)
                tipo = tipo2.value;
            else if(tipo3.checked)
                tipo = tipo3.value;

                encontraPalavraBD(canonicidade, tipo);
        }

        function encontraPalavraBD(canonicidade, tipo){
            $.ajax({url:"procuraPalavrasBD.php",data: 'canonicidade='+canonicidade+ '&tipo=' + tipo, success:function(result){
                
                var data =JSON.parse(result);
               
               console.log(data.length);
                var html = "";
               for(var a = 0; a<data.length; a++)
               {
                    var palavra = data[a].caracteres;

                    html += "<li> <input type='checkbox' value="+palavra+"> "+palavra+"</li>";
                    
               }
               document.getElementById("palavra").innerHTML = html;
               
            }})
        }

        function coletaPalavra(){
            
            var ul = document.getElementById("palavra");
            var items = ul.getElementsByTagName("input");
            var listaNova = document.getElementById("resultado");
            for (var i = 0; i < items.length; ++i) {
              // do something with items[i], which is a <li> element
             
              if(items[i].checked){
                var novoLi = document.createElement("li");
                novoLi.textContent = items[i].value;
                listaNova.appendChild(novoLi);
                palavrasSemente.push(novoLi.textContent);
              }
            }
        }

        function gerarPalavraNova(canonicidade, tipo){
                



        }


    </script>

</body>
</html>

