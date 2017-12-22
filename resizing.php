<?php


if(isset($_POST['resize']) && isset($_SESSION['fileupload'])){

	convertImage('original/'.$_SESSION['fileupload'], 'final/120x70_'.$_SESSION['fileupload'], '120' , '70' , 1000);

	 echo "L'image a été redimmensionné !";


}

 
function convertImage($source, $destination, $width, $height, $quality){

    
    $imageSize = getimagesize($source);

    $imageRessource = imagecreatefromjpeg($source);

    $imageFinal = imagecreatetruecolor($width, $height);

    $final = imagecopyresampled($imageFinal, $imageRessource, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);

    imagejpeg($imageFinal, $destination, $quality);



}


?>