<?php
    include('conexao.php');
    $filename = "dicionario.txt";
    $content = file_get_contents($filename);

    

    $pattern = '/<td title=\"Palavra\"><a href=".*">(.*)<\/a>/';
    $pattern2 = '/<a href=".*">(.*)<\/a>/';


    $resultado = preg_match_all($pattern, $content, $match);


    //$size = count($match[1]);

    //for($i = 0; $i<$size; $i++){
    //    echo ($i+1)." - ".$match[1][$i] ;
    //    echo "<br>";
    //}

?>