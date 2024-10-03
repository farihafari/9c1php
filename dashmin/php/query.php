<?php
include("connection.php");
// addresses
$categoryImageAddress = 'img/categories/';
$proImageAddress = "img/products/";
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
// addProduct
if(isset($_POST['addProduct'])){
    $pName = $_POST['proName'];
    $pPrice = $_POST['proPrice'];
    $pQuantity = $_POST['proQuantity'];
    $pDescription = $_POST['proDescription'];
    $pCatId = $_POST['proCatId'];
$pImageName = $_FILES['proImage']['name'];
$pTmpImageName = $_FILES['proImage']['tmp_name'];
$extension = pathinfo($pImageName,PATHINFO_EXTENSION);
$filePath = 'img/products/'.$pImageName;
if($extension=="jpg" || $extension =="jpeg" || $extension ="png" || $extension =="webp"){
    if(move_uploaded_file($pTmpImageName,$filePath)){
        $query = $pdo ->prepare("INSERT INTO `products`( `productName`, `productPrice`, `productQuantity`, `productCatId`, `productDescription`, `productImage`) VALUES(:pn,:pp,:pq,:pcid,:pd,:pi)");
        $query->bindParam("pn",$pName);
        $query->bindParam("pp",$pPrice);
        $query->bindParam("pq",$pQuantity);
        $query->bindParam("pcid",$pCatId);
        $query->bindParam("pd",$pDescription);
        $query->bindParam("pi",$pImageName);
$query->execute();
echo "<script>alert('product added into table')</script>";

    }
}

}
// updateProduct
if(isset($_POST['updateProduct'])){
    $pId = $_POST['proId'];
    $pName = $_POST['proName'];
    $pPrice = $_POST['proPrice'];
    $pQuantity = $_POST['proQuantity'];
    $pDescription = $_POST['proDescription'];
    $pCatId = $_POST['proCatId'];
    if(!empty($_FILES['proImage']['name'])){
        $pImageName = $_FILES['proImage']['name'];
$pTmpImageName = $_FILES['proImage']['tmp_name'];
$extension = pathinfo($pImageName,PATHINFO_EXTENSION);
$filePath = 'img/products/'.$pImageName;
if($extension=="jpg" || $extension =="jpeg" || $extension ="png" || $extension =="webp"){
    if(move_uploaded_file($pTmpImageName,$filePath)){
        $query = $pdo ->prepare("update products set productName = :pn,productPrice = :pp , productQuantity = :pq , productDescription = :pd , productCatId = :pcid , productImage = :pi where productId = :pid");
        $query->bindParam("pid",$pId);
        $query->bindParam("pn",$pName);
        $query->bindParam("pp",$pPrice);
        $query->bindParam("pq",$pQuantity);
        $query->bindParam("pcid",$pCatId);
        $query->bindParam("pd",$pDescription);
        $query->bindParam("pi",$pImageName);
$query->execute();
echo "<script>alert('product Updated into table')</script>";

    }
}

    }else{
        $query = $pdo ->prepare("update products set productName = :pn,productPrice = :pp , productQuantity = :pq , productDescription = :pd , productCatId = :pcid  where productId = :pid");
        $query->bindParam("pid",$pId);
        $query->bindParam("pn",$pName);
        $query->bindParam("pp",$pPrice);
        $query->bindParam("pq",$pQuantity);
        $query->bindParam("pcid",$pCatId);
        $query->bindParam("pd",$pDescription);
       
$query->execute();
echo "<script>alert('product Updated into table')</script>";
    }
}
// DeleteProduct
if(isset($_POST['DeleteProduct'])){
    $pId = $_POST['proId'];
    $query= $pdo ->prepare("delete from products where productId = :pid");
    $query->bindParam("pid",$pId);
    $query->execute();
    echo "<script>alert('product deleted')</script>";
}
?>