<?php
include("connection.php");
// addresses
$categoryImageAddress = 'img/categories/';
if(isset($_POST['addCategory'])){
    $catName = $_POST['catName'];
    $catImageName= $_FILES['catImage']['name'];
    $catTmpName = $_FILES['catImage']['tmp_name'];
    $extension = pathinfo($catImageName,PATHINFO_EXTENSION);
    $imagPath = 'img/categories/'.$catImageName;
    if($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "webp"){
        if(move_uploaded_file($catTmpName,$imagPath)){
            $query = $pdo -> prepare("insert into categories(catName,catImage) values(:pn , :pi)");
            $query->bindParam("pn",$catName);
            $query->bindParam("pi",$catImageName);
            $query->execute();
            echo "<script>
            alert('category add successfully')
            </script>";
        }
    }else{
        echo "<script>
            alert('inavlid extension type')
            </script>";
    }
}
?>