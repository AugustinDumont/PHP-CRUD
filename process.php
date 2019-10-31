<?php

// Pour connaïtre les informations de connexion (hostname, username, password, dbname) de mysqli; se rendre dans le document "docker.env". 

// Try or catch

//die, permet de faire de crasher le demande de connexion s'il y a une erreure dans les données de connexion. 

// catch avec le paramètre (e) = error

// isset() Détermine si une variable est considérée définie, ceci signifie qu'elle est déclarée et est différente de NULL.


// session_start() crée une session ou restaure celle trouvée sur le serveur, via l'identifiant de session passé dans une requête GET, POST ou par un cookie.
// Cette fonction doit être appellée en premier, AVANT LE HEADER !




// CHARGER DATA BASE 

try {
    $mysqli = new mysqli('database', 'root', 'root', 'crud') or die(mysqli_error($mysqli));
} catch (PDOException $e) {
    die($e->getMessage());
    exit();
}

// default value of variables
$update = false;
$id = 0;
$name ="";
$location ="";




// IF SAVE BUTTON HAS BEEN CLICKED

if (isset($_POST['save'])){   // POST renvoi à la méthode POST du forme et le save, le name du button. Une fois qu'il y est pressé, on reprend alors les value des fields.

    $name = $_POST['name'];
    $location = $_POST['location'];

    try{
       $mysqli->query("INSERT INTO data (name, location) VALUES('$name','$location')");  // permet d'envoyer les variables vers la database. "Data" = table de DB crud (columns names = name, location)
       $_SESSION['message'] = 'Record has been saved !';   // commentaire ajouté à la session grâce à la fonction session_start()
       $_SESSION['msg_type'] = 'success';// class "alert-success" en Bootstrap
       header("Location:index.php"); // Pour rediriger le visiteur vers la page index après avoir SAVE
       exit(); // TOUJOURS FAIRE SUIVREs header() par un exit !
    }catch (PDOException $e) {
            
        $_SESSION['message'] = 'Warning, record has not been saved';
        $_SESSION['msg_type'] = 'danger';
        die($e->getMessage());
        
    }

    
}




// IF DELETE BUTTON HAS BEEN CLICKED

if (isset($_GET['delete'])){  // GET, car fait référence à un URL
    $id = $_GET['delete'];

    try{
        $mysqli->query("DELETE FROM data WHERE id=$id");
        $_SESSION['message'] = 'Record has been deleted';
        $_SESSION['msg_type'] = 'danger';// "danger" sera ajouté à la classe Bootstrap : class "alert-danger"
        header("Location:index.php"); // Pour rediriger le visiteur vers la page index après avoir DELETE
        exit();
    }catch (PDOException $e) {
        
        $_SESSION['message'] = 'Impossible to delete the record';
        $_SESSION['msg_type'] = 'danger';
        die($e->getMessage());
        
    }

}    


// IF EDIT BUTTON HAS BEEN CLICKED

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;

    try{
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id");
        if (count([$result])==1){
            $row = $result->fetch_array();
            $name = $row['name'];
            $location = $row['location'];
        }
    }catch (PDOException $e) {
        die($e->getMessage());
    }
}


// IF UPDATE HAS BEEN CLICKED

if(isset($_POST['update'])){
    $id =$_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    try{
    $mysqli->query("UPDATE data SET name ='$name', location = '$location' WHERE id=$id");
    $_SESSION['message'] = 'Record has been updated';
    $_SESSION['msg_type'] = 'warning';
    header("Location:index.php"); 
    exit();
    }catch(PDOException $e) {
        die($e->getMessage());
    }
}


?>