<?php

include("dashmin/php/connection.php");
// resgiteration
if(isset($_POST['registration'])){
    $uname = $_POST['uname'];
    $uemail = $_POST['uemail'];
    $upassword = $_POST['upassword'];
    $passwordHash = sha1($upassword);
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

</script>";
    }
}
?>