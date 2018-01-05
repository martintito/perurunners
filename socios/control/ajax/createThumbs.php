<?php

    //$file = $target_file;   /*Your Original Source Image */
    //$pathToSave = "../../tumb/$id_producto/"; /*Your Destination Folder */
   /* if (!file_exists($pathToSave)) {
		mkdir($pathToSave, 0777, true);
	}
    $what = getimagesize($file);
	$sourceWidth =$what[0] / 3;
    $sourceHeight = $what[1] / 3;
	$sourceWidth=round($sourceWidth);
	$sourceHeight=round($sourceHeight);
    $file_name = basename($file);/* Name of the Image File*/
    /*$ext   = pathinfo($file_name, PATHINFO_EXTENSION);

    /* Adding image name _thumb for thumbnail image */
   /* $file_name = basename($file_name, ".$ext") . '_thumb.' . $ext;

    switch(strtolower($what['mime']))
    {
        case 'image/png':
            $img = imagecreatefrompng($file);
            $new = imagecreatetruecolor($sourceWidth, $sourceHeight);
            imagecopyresized($new,$img,0,0,0,0,$sourceWidth, $sourceHeight,$what[0],$what[1]);
            header('Content-Type: image/png');           
        break;
        case 'image/jpeg':
            $img = imagecreatefromjpeg($file);
            $new = imagecreatetruecolor($sourceWidth, $sourceHeight);
            imagecopyresized($new,$img,0,0,0,0,$sourceWidth, $sourceHeight,$what[0],$what[1]);
            header('Content-Type: image/jpeg');
        break;
        case 'image/gif':
            $img = imagecreatefromgif($file);
            $new = imagecreatetruecolor($sourceWidth, $sourceHeight);
            imagecopyresized($new,$img,0,0,0,0,$sourceWidth, $sourceHeight,$what[0],$what[1]);
            header('Content-Type: image/gif');
        break;
        default: die();
    }

        imagejpeg($new,$pathToSave.$file_name);
        imagedestroy($new);
		*/

?>
<?php
//La funcion siguiente tambien es valida
//Parametros:
// $updir= Your Original Source Image
// $img = nombre de la imagen
// $id = identificador unico para la imagen
//$MaxWe=100 es ancho maximo
//$MaxHe=150 alto maximo
function makeThumbnails($updir, $img, $id,$MaxWe=100,$MaxHe=150){
    $arr_image_details = getimagesize($img); 
    $width = $arr_image_details[0];
    $height = $arr_image_details[1];

    $percent = 100;
    if($width > $MaxWe) $percent = floor(($MaxWe * 100) / $width);

    if(floor(($height * $percent)/100)>$MaxHe)  
    $percent = (($MaxHe * 100) / $height);

    if($width > $height) {
        $newWidth=$MaxWe;
        $newHeight=round(($height*$percent)/100);
    }else{
        $newWidth=round(($width*$percent)/100);
        $newHeight=$MaxHe;
    }

    if ($arr_image_details[2] == 1) {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
    }
    if ($arr_image_details[2] == 2) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    }
    if ($arr_image_details[2] == 3) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    }


    if ($imgt) {
        $old_image = $imgcreatefrom($img);
        $new_image = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresized($new_image, $old_image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

       $imgt($new_image, $updir."".$id."_t.jpg");
        return;    
    }
}
?>