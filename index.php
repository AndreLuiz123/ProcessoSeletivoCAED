<?php include("ConexaoBD/conexao.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script
      src="https://code.jquery.com/jquery-3.5.1.js"
      integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
      crossorigin="anonymous">
    </script>
    <script src="funcoesUteis.js"></script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Gerador de palavras</title>
</head>
<body>
    
    
    <form id="header" name="instrucao"  method="POST">
        <h1>GERADOR DE PALAVRAS</h1>
            Canonicidade:<br>
            <input type="radio" name="canonicidade" id="canonico" value=1> Canônica<br>
            <input type="radio" name="canonicidade" id="naoCanonico" value=0> Não canônica<br>
        
            Tipo da palavra:<br>
            <input type="radio" name="tipo" value=1 id="oxitona" > Oxítona<br>
            <input type="radio" name="tipo" value=2 id="paroxitona" > Paroxítona<br>
            <input type="radio" name="tipo" value=3 id="proparoxitona" > Proparoxítona<br>
        
    </form> 
    

    <div id="conteudo">
    <div id="palavras-BD">
        <h2>Palavras encontradas no BD</h2>
        <form name="instrucao"  method="POST">
            <ul id="palavra">

            </ul>
         </form>
    <button onclick="checarCaracteristicas()"> Procurar palavras no Banco de dados </button>
    </div>

    <div id="palavras-selecionadas">
    <h2>Palavras coletadas da lista de palavras</h2>
         <ul id="resultado">

         </ul>
    <button onclick="coletaPalavra()"> Armazenar palavras selecionadas </button>
    </div>

    
    <div id="palavras-geradas">
        <h2>Palavras novas</h2>
        <ul id="palavrasNovas">
            
            </ul>
        <button onclick ="gerarPalavrasNovas()">Criar</button>
        <button>Exportar para Excel</button>
    </div>
    </div>

    <script>
    
        var canonicidade1 = document.getElementById("canonico");
        var canonicidade2 = document.getElementById("naoCanonico");

        var tipo1 = document.getElementById("oxitona");
        var tipo2 = document.getElementById("paroxitona");
        var tipo3 = document.getElementById("proparoxitona");

        var palavrasSemente = [];
        var palavrasNovas = [];

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

        function gerarPalavrasNovas(){
            for(let i=0; i<5 ; i++)
            {
                gerarPalavraNova();
            }

                var html = "";
            for(var a = 0; a<palavrasNovas.length; a++)
               {
                    var palavra = palavrasNovas[a];

                    html += "<li>"+palavra+"</li>";
                    
               }
               document.getElementById("palavrasNovas").innerHTML = html;


        }

        function gerarPalavraNova(){
                
            embaralha(palavrasSemente);

            var numeroMaxSilabas = Math.floor(Math.random()*(4) + 1);

            var novaPalavra = "";

            for(let i=0; i<numeroMaxSilabas; i++)
            {
                var palavraAleatoria =  Math.floor(Math.random()*(palavrasSemente.length-1));
                if(palavraAleatoria<0)
                    palavraAleatoria = 0;
                console.log(palavraAleatoria);
                //console.log(palavrasSemente[palavraAleatoria]);
                novaPalavra += coletarSilabaAleatoria('.'+palavrasSemente[palavraAleatoria]+'.');
            }

            palavrasNovas.push(novaPalavra);
            console.log(palavrasNovas);
        }

        
        function coletarSilabaAleatoria(string){
            
            var silabaAleatoria =  Math.floor(Math.random()*string.length-1);
            if(silabaAleatoria<0)
            silabaAleatoria = 0;
            else if(silabaAleatoria>string.length-1)
            silabaAleatoria = string.length-1; 
            
            console.log("string: "+string);
            
            while(string[silabaAleatoria]!=".")
            {
                console.log(string[silabaAleatoria]+", "+silabaAleatoria);
                silabaAleatoria--;
                if(silabaAleatoria<0)
                silabaAleatoria = 0;
            }
            
            var silabaRetorno = "";
            silabaAleatoria++;
            while(string[silabaAleatoria]!="." && string[silabaAleatoria]!="")
            {
                silabaRetorno+=string[silabaAleatoria];
                silabaAleatoria++;
                if(silabaAleatoria>string.length-1)
                silabaAleatoria = string.length-1;
            }
            
            return silabaRetorno; 
        }

        function embaralha(lista) {
            //console.log(lista);
        
            for (let indice = lista.length; indice; indice--) {
            
                const indiceAleatorio = Math.floor(Math.random() * indice);
            
                // atribuição via destructuring
                [lista[indice - 1], lista[indiceAleatorio]] = 
                    [lista[indiceAleatorio], lista[indice - 1]];
            }
        
            //console.log(lista);
        }
        
        </script>

</body>
</html>

