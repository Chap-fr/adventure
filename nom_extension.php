<?php 

function extension($f) {

$dir='final/'.$f;
          $info = pathinfo($dir);
          $fichier = basename($dir);

          return $fichier;
}


