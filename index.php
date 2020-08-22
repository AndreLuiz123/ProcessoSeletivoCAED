<?php
    include("conexao.php");

    function preparaPalavra($string){
        $vowels = array("<b>","</b>","<u>","</u>");
        $palavra = str_replace($vowels, "", $string);
        echo $palavra;
    }

    function verificaCanonicidade($string){
        $palavraAnalisada = $string.".";
        while(strlen($palavraAnalisada)>0)
        {
            echo $palavraAnalisada."<br>";
            $silaba = strstr($palavraAnalisada, '.',true); 
            echo $silaba."<br>";
            if(strlen($silaba)!=2)
            {
                echo "Não é canônica pois a sílaba é composta de um número de caracteres diferente de 2";
                return false;
            }else if(!(!verificaVogal($silaba[0]) && verificaVogal($silaba[1])))
            {
                echo "Não é canônica pois não é consoante seguida de vogal";
                return false;
            }
            echo "prox passo <br><br>";
            $palavraAnalisada = strstr($palavraAnalisada,'.');
            $palavraAnalisada = substr($palavraAnalisada, 1);
        }
        echo "É canônica";
        return true;
    }

    function verificaTipo($string){
        
            $silabaTonica = 1;
            $palavraAnalisada = strrev($string);
            echo $palavraAnalisada."<br>";


            while($silabaTonica<4)
            {
                $silaba = strstr($palavraAnalisada, '.', true); 
                
                echo $silaba."<br>";  
                if($silaba[0]===',')
                {
                    if($silabaTonica===1)
                    echo "Oxítona <br>";
                    if($silabaTonica===2)
                    echo "Paroxítona <br>";
                    if($silabaTonica===3)
                    echo "Proparoxítona <br>"; 
                    return $silabaTonica;
                }
                $silabaTonica++;
                echo "prox passo <br><br>";
                $palavraAnalisada = strstr($palavraAnalisada,'.');
                $palavraAnalisada = substr($palavraAnalisada, 1);
            }

            return 3;
    }

    function verificaVogal($caractere){

        echo "<br>".$caractere."<br>";
        switch ($caractere){
            case 'a':
                echo "vogal <br>";
                return true;
            break;
            case 'e':
                echo "vogal <br>";
                return true;
            break;
            case 'i':
                echo "vogal <br>";
                return true;
            break;
            case 'o':
                echo "vogal <br>";
                return true;
            break;
            case 'u':
                echo "vogal <br>";
                return true;
            break;
            case 'A':
                echo "vogal <br>";
                return true;
            break;
            case 'E':
                echo "vogal <br>";
                return true;
            break;
            case 'I':
                echo "vogal <br>";
                return true;
            break;
            case 'O':
                echo "vogal <br>";
                return true;
            break;
            case 'U':
                echo "vogal <br>";
                return true;
            break;
            default:
                echo "consoante <br>";
                return false;
            break;
        }
    }

    $filename = "dicionario.txt";
    $content = file_get_contents($filename);

    

    $pattern = '/<td title=\"Palavra\"><a href=".*">(.*)<\/a>/';
    $pattern2 = '/<a href=".*">(.*)<\/a>/';


    $resultado = preg_match_all($pattern, $content, $match);


    $size = count($match[1]);
    $novaPalavra = $match[1][20];


    //$sql = "INSERT INTO palavra (caracteres, canonicidade, tipo) VALUES ('$novaPalavra', 'false',2)";
    //$conexao->query($sql);

    
    //for($i = 0; $i<$size; $i++){
        //echo ($i+1)." - ".$match[1][20]."<br>";
        //preparaPalavra($match[1][20]);
        verificaTipo("ca.ca.ca.ca.sa.,rao,");
        //echo verificaVogal('p');
        //echo "<br>";

    //}
?>

<?php
    class Palavra
    {
        public $codigo;
        public $caracteres;
        public $canonicidade;
        public $tipo;

        function Palavra($string){

        }
        
        function preparaPalavra($string){
            $vowels = array("<b>","</b>","<u>","</u>");
            $palavra = str_replace($vowels, "", $string);
            return $palavra;
        }

        function verificaCanonicidade($string){

            $palavraAnalisada = $string.".";
            while(strlen($palavraAnalisada)>0)
            {
                $silaba = strstr($palavraAnalisada, '.',true); 
                if(!$silaba)
                $silaba = strstr($palavraAnalisada, '',true);
                if(strlen($silaba)>2)
                {
                    return false;
                }else if(!(!verificaVogal($silaba[0]) && verificaVogal($silaba[1])))
                {
                    return false;
                }
                $palavraAnalisada = strstr($palavraAnalisada,'.');
                $palavraAnalisada = substr($palavraAnalisada, 1);
            }
            return true;
        }

        function verificaTipo($string){
                    
            $silabaTonica = 1;
            $palavraAnalisada = strrev($string);

            while($silabaTonica<4)
            {
                $silaba = strstr($palavraAnalisada, '.', true); 
                
                if($silaba[0]===',')
                {
                    return $silabaTonica;
                }
                $silabaTonica++;
                $palavraAnalisada = strstr($palavraAnalisada,'.');
                $palavraAnalisada = substr($palavraAnalisada, 1);
            }

            return 3;
        }

    }
?>