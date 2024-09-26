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

// update category
if(isset($_POST['updateCategory'])){
    $catId = $_POST['catId'];
    $catName = $_POST['catName'];
    if(!empty($_FILES['catImage']['name'])){
        $catImageName= $_FILES['catImage']['name'];
        $catTmpName = $_FILES['catImage']['tmp_name'];
        $extension = pathinfo($catImageName,PATHINFO_EXTENSION);
        $imagPath = 'img/categories/'.$catImageName;
        if($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "webp"){
            if(move_uploaded_file($catTmpName,$imagPath)){
                $query = $pdo -> prepare("update categories set catName = :pn, catImage = :pi where catId = :pid");
                $query->bindParam("pid",$catId);
                $query->bindParam("pn",$catName);
                $query->bindParam("pi",$catImageName);
                $query->execute();
                echo "<script>
                alert('category updated successfully');
                location.assign('viewcategory.php')
                </script>";
            }
        }else{
            echo "<script>
                alert('inavlid extension type')
                </script>";
        }
    }else{
        $query = $pdo -> prepare("update categories set catName = :pn where catId = :pid");
        $query->bindParam("pid",$catId);
        $query->bindParam("pn",$catName);
        $query->execute();
        echo "<script>
        alert('category updated successfully');
        location.assign('viewcategory.php')
        </script>";
    }
}

// delete category
if(isset($_GET['delete'])){
    $did = $_GET['delete'];
    $query = $pdo ->prepare("delete from categories where catId = :pid");
    $query->bindParam("pid",$did);
    $query->execute();
    echo "<script>
        alert('category deleted successfully');
        location.assign('viewcategory.php')
        </script>";
}
?>