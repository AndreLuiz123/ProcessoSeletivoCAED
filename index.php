<?php
    $filename = "dicionario.txt";
    $content = file_get_contents($filename);

    

    $pattern = '/<td title=\"Palavra\"><a href=".*">(.*)<\/a>/';
    $pattern2 = '/<a href=".*">(.*)<\/a>/';


    $resultado = preg_match_all($pattern, $content, $match);
    
    
    for($i = 0; $i<500; $i++){
        echo $match[1][$i];
        echo "<br>";
    }

?>