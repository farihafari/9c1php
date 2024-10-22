<?php
// session_start();
include("dashmin/php/connection.php");
$categoryImageAddress = 'dashmin/img/categories/';
$proImageAddress = "dashmin/img/products/";
// session_unset();
// resgiteration
if(isset($_POST['registration'])){
    $uname = $_POST['uname'];
    $uemail = $_POST['uemail'];
    $upassword = $_POST['upassword'];
    $passwordHash = sha1(string: $upassword);
    $unumber = $_POST['unumber'];
    // check email 
    $checkEmail = $pdo ->prepare("select * from users where userEmail = :pemail");
    $checkEmail ->bindParam("pemail",$uemail);
    $checkEmail ->execute();
    $chk = $checkEmail->fetch(PDO::FETCH_ASSOC);
    if(!empty($chk['userEmail'])){
echo "<script>
alert('already Exist');
</script>";
    }else{

    
$query = $pdo->prepare("INSERT INTO `users`(`userName`, `userEmail`, `userPassword`, `userNumber`) VALUES(:pn,:pe,:pp,:pnum)");
$query->bindParam("pn",$uname);
$query->bindParam("pe",$uemail);
$query->bindParam("pp",$passwordHash);
$query->bindParam("pnum",$unumber);
$query->execute();
echo "<script>
alert('account register successfully');
location.assign('signin.php')
</script>";
    }
}
// login
if(isset($_POST['logIn'])){
    $uemail = $_POST['uemail'];
    $upassword = $_POST['upassword'];
    $passwordHash = sha1($upassword);
    $query = $pdo ->prepare("select * from users where userEmail = :pe && userPassword = :pp");
    $query->bindParam("pe",$uemail);
    $query->bindParam("pp",$passwordHash);
    $query->execute();
    $result = $query->fetch(mode: PDO::FETCH_ASSOC);
    // var_dump($result);
    // echo   $passwordHash;
    // die();
    if($result){
        echo "<script>alert('login')</script>";
        $_SESSION['username']=$result['userName'];
        $_SESSION['useremail']=$result['userEmail'];
        $_SESSION['userpassword']=$result['userPassword'];
        $_SESSION['usernumber']=$result['userNumber'];
        $_SESSION['userrole']=$result['userRole'];

        if($_SESSION['userrole']=="admin"){
            echo "<script>
            location.assign('dashmin/index.php')
            </script>";
        }else{
            echo "<script>
            location.assign('index.php')
            </script>";
        }

    }else{
        echo "<script>alert('data does not match')</script>";

    }
}
// addToCart
if(isset($_POST['addToCart'])){
    $pId = $_POST['pId'];
    $pName = $_POST['pName'];
    $pQuantity = $_POST['pQuantity'];
    $pPrice = $_POST['pPrice'];
    $pImage = $_POST['pImage'];
    if(isset($_SESSION['cart'])){

    }else{
        $_SESSION['cart'][0]=array("proId"=>$pId,"proName"=>$pName,"proPrice"=>$pPrice,"proQuantity"=>$pQuantity,"proImage"=>$pImage);
        echo "<script>alert('product add into cart')</script>";
    }


}
?>