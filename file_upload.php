<?php

$max_size = 10000000; //100KB
$location = 'original/'; //where the file is going
if (isset($_POST['submit'])) { //checking for anythiing will break the code
    $name = $_FILES['file']['name']; //file name
    $size = $_FILES['file']['size']; //file size
    $type = $_FILES['file']['type']; //file type
    $tmp_name = $_FILES['file']['tmp_name']; //temp location on server
    if(checkType($name, $type) && checkSize($size, $max_size)){
      if (isset($name)) {
                save_file($tmp_name, $name, $location); //call my function
              }
      }
}
  function checkType($name, $type){
    //$extension = strtolower(substr($name, strpos($name, '.') + 1)); //get the extension
    $extension = pathinfo($name, PATHINFO_EXTENSION); //better way to get extension
    if (!empty($name)) {
      if (($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg' || $extension == 'gif') && ($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/jpg') || $type == 'image/gif') {
        return true;
      } else{
        echo 'Ce n\'est pas une image';
        return false;
      }
    }
  }
  function checkSize($size, $max_size){
    if($size <= $max_size){
      return true;
    } else{
      echo 'Fichier trop lourd.';
      return false;
    }
  }
  function fileExists($name){
    $filename = rand(1000,9999).md5($name).rand(1000, 9999);
    echo $filename;
    return false;
  }
  function save_file($tmp_name, $name, $location){
    $og_name = $name;
    //Boucle pour voir si le nom existe deja 
    while (file_exists('original/' .$name)) {
      echo 'Image déjà existante. Génération du nom.<br/>';
      $rand = rand(10000, 99999);
        $name = $rand . '.' . pathinfo($name, PATHINFO_EXTENSION); //cree nouveau nom
      }
      if (move_uploaded_file($tmp_name, $location . $name)) {
        echo 'Succès ! ' . $og_name . ' a été téléchargé ';
        if(!($og_name==$name)){ //if original name != name
          echo ' et renommé '.$name.'.<br/>';

          $_SESSION['fileupload'] = $name;
          
        } else{

          echo '.';
          $_SESSION['fileupload'] = $og_name;
        }
        
      } else {
        echo 'ERREUR!';
      }
    }
?>




