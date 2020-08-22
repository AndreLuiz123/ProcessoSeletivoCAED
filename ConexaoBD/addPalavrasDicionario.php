<?php
    include("conexao.php");

    function preparaPalavraTestes($string){
        $vowels = array("<b>·</b>","·");
        $palavra = str_replace($vowels, ".", $string);
        $vowels = array("<b>","</b>");
        $palavra = str_replace($vowels, ",", $palavra);
        $vowels = array("<u>","</u>","<span>","</span>");
        $palavra = str_replace($vowels, "", $palavra);
        $vowels = array("á","â","ã","à");
        $palavra = str_replace($vowels, "a", $palavra);
        $vowels = array("é","ê");
        $palavra = str_replace($vowels, "e", $palavra);
        $vowels = array("ó","ô","õ");
        $palavra = str_replace($vowels, "o", $palavra);
        $vowels = array("í");
        $palavra = str_replace($vowels, "i", $palavra);
        $vowels = array("ú");
        $palavra = str_replace($vowels, "u", $palavra);
        $vowels = array("ç");
        $palavra = str_replace($vowels, "c", $palavra);
        
        return $palavra;
    }

    function preparaPalavraTestes2($string){
        $vowels = array(",");
        $palavra = str_replace($vowels, "", $string);
        return $palavra;
    }

    function preparaPalavraBD($string){
        $vowels = array(",",".");
        $palavra = str_replace($vowels, "", $string);
        return $palavra;
    }

    function verificaCanonicidade($string){
        $palavraAnalisada = $string.".";
        while(strlen($palavraAnalisada)>0)
        {
           
            $silaba = strstr($palavraAnalisada, '.',true); 

            if(strlen($silaba)!=2)
            {
                return 0;
            }else if(!(!verificaVogal($silaba[0]) && verificaVogal($silaba[1])))
            {
                return 0;
            }
            $palavraAnalisada = strstr($palavraAnalisada,'.');
            $palavraAnalisada = substr($palavraAnalisada, 1);
        }
        return 1;
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

            return 1;
    }

    function verificaVogal($caractere){


        switch ($caractere){
            case 'a':
              
                return true;
            break;
            case 'e':
              
                return true;
            break;
            case 'i':
              
                return true;
            break;
            case 'o':
              
                return true;
            break;
            case 'u':
              
                return true;
            break;
            case 'A':
              
                return true;
            break;
            case 'E':
              
                return true;
            break;
            case 'I':
              
                return true;
            break;
            case 'O':
              
                return true;
            break;
            case 'U':
              
                return true;
            break;
            default:

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


    
    
    for($i = 0; $i<$size; $i++){
        $novaPalavra = $match[1][$i];
        echo $novaPalavra."<br>";
        $novaPalavra = preparaPalavraTestes($novaPalavra);
        echo $novaPalavra."<br>";
        $tipo = verificaTipo($novaPalavra);
        echo $tipo."<br>";
        $novaPalavra = preparaPalavraTestes2($novaPalavra);
        $canonicidade = verificaCanonicidade($novaPalavra);
        echo $canonicidade."<br>";
        $novaPalavra = preparaPalavraBD($novaPalavra);
        echo $novaPalavra."<br>";
        $sql = "INSERT INTO palavra (caracteres, canonicidade, tipo) VALUES ('$novaPalavra', $canonicidade,$tipo)";
        $conexao->query($sql);
    }

    mysqli_close($conexao);
?>

