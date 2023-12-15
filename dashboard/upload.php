<?php 
include("connexion.php");

$rep="";
$folder="uploads/";
if(isset($_POST["submit"])){
    if(!empty($_FILES["file"]["name"])){
        $image = $_FILES["file"]["name"];
        $filename=uniqid().$image;
        $filepath=$folder.$image;
        $filetype=pathinfo($filepath,PATHINFO_EXTENSION);
        if(move_uploaded_file($image,$filename)){
        $sql="INSERT INTO images (name) VALUES ('$filename')";
        $result=mysqli_query($conn,$sql);
        header("location: job.php");
    }
}
}


?>
 