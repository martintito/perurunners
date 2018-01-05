<?php 
    function create_slug($url){     
       // Tranformamos todo a minusculas
       $url = strtolower($url);
       //Rememplazamos caracteres especiales latinos
       $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
       $repl = array('a', 'e', 'i', 'o', 'u', 'n');
       $url = str_replace ($find, $repl, $url);
       // Añadimos los guiones
       $find = array(' ', '&', '\r\n', '\n', '+');
      $url = str_replace ($find, '-', $url);
       // Eliminamos y Reemplazamos otros carácteres especiales
       $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
       $repl = array('', '-', '');
       $url = preg_replace ($find, $repl, $url);
       return $url;
    }     
 
    //INPUT 
    //$string = "what is your name ?"; 
    //$slug = create_slug($string); 
 
    //OUTPUT::
    //what-is-your-name.html
?>
 