<?php

session_start();

$_SESSION['time'] = time();


require 'nom_extension.php';
require 'deleteFiles.php';
require 'numero.php';

?>


<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   
  <title>Logo</title>

</head>
<body>
  <div class="container-fluid">
   <div class="col-lg-8">

<?php

$dir='final/';

$files = array_diff(scandir($dir), array('..', '.'));
$html_table = '<table class="table table-striped" id="mytable">
      <tr><th class="col-lg-1">#</th>
            <th class="col-lg-1">Logo</th>
            <th class="col-lg-4">Fichier</th>
            <th class="col-lg-1"><span class="glyphicon glyphicon-menu-down"></span> / <span class="glyphicon glyphicon-menu-up"></span></th>
            <th class="col-lg-1">Supprimer</th>
            </tr>';



// if(isset($_POST['dansletableau']) && isset($_SESSION['fileupload'])){
if(($_POST['upTable']) && ($_SESSION['fileupload'])){
  $count = 0;
  foreach($files as $file) {
          $count++;
          $html_table .= 
          '<tr>
            <td>'.$count.'</td>
            <td><img src="' . $dir . $file . '" /></td>
            <td>'.extension($file).'</td>
            <td><button type="submit" class="move up">
              <span class="glyphicon glyphicon-collapse-up"></span>
            </button>
            <button type="submit" class="move down">
              <span class="glyphicon glyphicon-collapse-down"></span>
            </button></td>
            <td><a href="proj.php?delete=' . $dir . $file . '"><span class="glyphicon glyphicon-trash"</span></a></td>
          </tr>';

        }
    }

    $html_table .= '</table>';
    echo $html_table; 
?>

   </div>
  <div class="col-lg-4">

<!-- FORM INSERT -->

    <div class="form-group">
      <h4>Upload d'image</h4>
      <p class="help-block">Drop image</p>
       

      <form action="proj.php" method="POST" enctype="multipart/form-data">

        <input type="file" id="file" name="file">

       <div class="btn-group" id="buttonGrp">
        <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Charger" id="button">
        <input type="submit" name="resize" class="btn btn-primary btn-sm" value="Resize" id="button">

      </div><br></br>
      
        <input type="submit" name="upTable" value="Entrer" class="btn btn-primary btn-sm" id="button"><br>

       <?php require 'resizing.php'; ?>

        <?php require 'file_upload.php'; ?>
      </form>
  </div>

<!-- FORM INSERT -->

</div>
</div>
<script type="text/javascript" src="fonc.js"></script>
</body>
</html>