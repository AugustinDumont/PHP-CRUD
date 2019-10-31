<?php session_start(); ?>
<?php require_once 'process.php';?>  <!-- Link de notre page process.php avec notre index qui contient le form. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>PHP-CRUD</title>
<body>


<?php

// APPEL et MISE EN FORME des messages de sesssion suite SAVE et DELETE programmés dans process.php 

if(isset($_SESSION['message']) && !empty($_SESSION['message'])): 

?>
<div class ="alert alert-<?=$_SESSION['msg_type']?>">    
    <?php
        echo $_SESSION['message'];   // Faire apparaître le message de session
        $_SESSION['message'] = '';

    ?>
</div>
<?php endif?>




 <div class ="container">

 <?php
 try {
    $mysqli = new mysqli('database', 'root', 'root', 'crud');  // Link avec la DB base msqli avec même structure de try and catch. 
} catch (PDOException $e) {
    die($e->getMessage());
    exit();
}

try {
    $result= $mysqli->query("SELECT * FROM data"); //On stock le résultat dans un query
} catch (PDOException $e) {
    die($e->getMessage());
    exit();
}

//pre_r($result);  On print le result avec la fonction ci-dessous. 
//pre_r($result->fetch_assoc());  On print le résult de la fonction ci-dessous, avec les datas de la DB affichées. 


// function pre_r($array){
//     echo '<pre>';
//     print_r($array);
//     echo '<pre>';
// }

// RESULTAT DU PRINT

// mysqli_result Object
// (
//     [current_field] => 0
//     [field_count] => 3  Chaque save engendre 3 champs ( ID, name, location). Quelles sont les datas ? Normalement Augustin Hamois et Robin Conjoux devrait être affiché
//     [lengths] => 
//     [num_rows] => 2    On a pressé deux fois sur "save"
//     [type] => 0
// )

// Afin d'afficher les data de l'object, on utilise la fonction ($result->fetch_assoc();)


// RESULTAT
// Array
// (
//     [id] => 8
//     [name] => Augustin   REM : Seul Augustin Hamois est affiché, pour imprimer le prochain, il faut appeler la fonction une seconde fois. 
//     [location] => Hamois
// )

// pre_r($result->fetch_assoc());

// Nécessaire de créer une boucle !!!

// On crée un tableau eu HTML dans lequel on va stocker les informations de la DB à chaque itération de la boucle.  ==>

?>
<h1 style ="text-align:center; padding-top:50px; font-family: SFMono-Regular,Menlo,Monaco,Consolas,'Liberation Mono','Courier New',monospace;"> PHP - MYSQLI - CRUD </h1>
<h2 style ="text-align:left; padding:50px; font-size : 18px; font-family: SFMono-Regular,Menlo,Monaco,Consolas,'Liberation Mono','Courier New',monospace; padding-left:0px;">Datas (name, location) : Feel free to Edit or Delete</h2>
<div class ="row justify-content-center">
<div class ="col-6">
    <table class ="table">
        <thead>
             <tr> <!--1ère ligne du tableau -->
                <th>Name</th>
                <th>Location</th>
                <th colspan ="2">Action</th>
            </tr>
        </thead>

    <?php
        while ($row = $result->fetch_assoc()):?>  <!-- déclaration de boucle while en PHP avec $result qui = accès aux infos de la DB -->
            <tr> <!-- 2èmz ligne du tableau dans lequel on push les datas suites itération -->
                <td><?php echo $row['name'];?></td> <!-- push le paramètre name de resultat -->
                <td><?php echo $row['location'];?></td>
                <td>
                    <a href ="index.php?edit=<?php echo $row['id'];?>" class ="btn btn-info">Edit</a>  <!-- on indique l'url du lien + l'id récupérer grâce au fetch_assoc -->
                    <a href ="index.php?delete=<?php echo $row['id'];?>" class ="btn btn-danger">Delete</a>
                </td>
            </tr>
<?php endwhile;?>
    </table>
</div>
</div>




    <?php

        function pre_r($array){
            echo '<pre>';
            print_r($array);
            echo '<pre>';
        }

    pre_r($result->fetch_assoc());

    ?>

<h2 style ="text-align:left; font-size : 18px; padding-top : 50px">Add your datas ! </h2>
    <div class ="row justify-content-center">
    <div class ="col-6">
        <form action ="index.php" method ="POST">
        <input type ="hidden" name ="id" value ="<?php echo $id;?>"> <!-- on ajoute un hidden field pour pouvoir y ajouté l'id pour préciser l'id à modifier dans la DATABASE -->
        <div class ="form-group"> 
            <label style = "font-size:18px; display:flex; justify-content:center;">Name</label>
            <input type ="text" name ="name" class="form-control" value ="<?php echo $name;?>" placeholder ="Enter your name">
        </div>  
        <div class ="form-group">
            <label style = "font-size:18px; display:flex; justify-content:center;">Location</label>
            <input type ="text" name ="location" class="form-control"  value ="<?php echo $location;?>" placeholder ="Enter your location">
        </div> 
        <div class ="form-group">
            <?php
            if ($update == true): // BOUCLE IF / ELSE IF / ENDIF ! 
            ?>
                <button type ="submit" class ='btn btn-info' name ="update">Update</button>
            <?php else : ?>
                <button type ="submit" class="btn btn-primary" name ="save">Save</button>
            <?php endif;?>
        </div>
        </form>
        </div>
</div>
</div> <!-- div class container pour padding et centrer le tableau -->

    
</body>
</html>