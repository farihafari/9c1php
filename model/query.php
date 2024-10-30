<?php
// session_start();
include( "connection.php");
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

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
        $_SESSION['userid']=$result['userId'];
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
        $cartCount = false;
foreach($_SESSION['cart'] as $keys => $values){
    if($values['proId']== $pId){
$_SESSION['cart'][$keys]['proQuantity']+=$pQuantity;
$cartCount= true;
echo "<script>alert('cart updated')</script>";
    }
}
if(!$cartCount){
    $cartLength = count($_SESSION['cart']);
    $_SESSION['cart'][$cartLength]=array("proId"=>$pId,"proName"=>$pName,"proPrice"=>$pPrice,"proQuantity"=>$pQuantity,
    "proImage"=>$pImage);
    echo "<script>alert('product add into cart')</script>";
}
    }else{
        $_SESSION['cart'][0]=array("proId"=>$pId,"proName"=>$pName,"proPrice"=>$pPrice,"proQuantity"=>$pQuantity,
        "proImage"=>$pImage);
        echo "<script>alert('product add into cart')</script>";
    }


}
// delete product session cart
if(isset($_POST['removeItem'])){
    $pId = $_POST['proId'];
    foreach($_SESSION['cart'] as $key => $values){
        if($values['proId']==$pId){
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart']=array_values($_SESSION['cart']);
            echo "<script>
            alert('item deleted from cart');
            location.assign('shoping-cart.php')
            </script>";

        }
    }
}
// order place
if(isset($_POST['placeOrder'])){
    $userId = $_SESSION['userid'];
    $username = $_POST['name'];
    $useremail = $_POST['email'];
    $userphone = $_POST['phone'];
    $useraddress = $_POST['address'];
    date_default_timezone_set("Asia/Karachi");
    $current = time();
    $date = date("Y-m-d H:i:s",$current);
    $time = date("H:i:s",strtotime($date));
    function Confirmation(){
        $randCode = rand(1,999999);
        return "#OD".$randCode;
    }
    $confirmationCode = Confirmation();
    $itemCount =1;
    $productNames =[];
    $allQuantities = 0;
    $subTotal=0;
    foreach($_SESSION['cart'] as $keys =>$values){
        $itemCount +=$keys;
$productNames[]=$values['proName'];
$allQuantities+=$values['proQuantity'];
$subTotal +=$values['proQuantity']*$values['proPrice'];
        // order query
$orderQuery= $pdo ->prepare("INSERT INTO `orders`(`productId`,`productName`, `productPrice`, `productQuantity`, `userId`, `userName`, `userEmail`, `userPhone`, `userAddress`, `date`, `time`, `confirmationCode`, `productImage`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
$orderQuery->execute([$values['proId'],$values['proName'],$values['proPrice'],$values['proQuantity'],$userId,$username,$useremail,$userphone,$useraddress,$date,$time,$confirmationCode,$values['proImage']]);

    }
    $nameString = implode(",",$productNames);

    // invoice query 
$invoiceQuery = $pdo ->prepare("INSERT INTO `invoices`(`userId`, `userEmail`, `productsName`, `itemCount`, `productQuantities`, `totalAmount`, `date`, `time`, `confirmationCode`) VALUES(?,?,?,?,?,?,?,?,?)");
$invoiceQuery->execute([$userId,$useremail,$nameString,$itemCount,$allQuantities,$subTotal,$date,$time,$confirmationCode]);
unset($_SESSION['cart']);
echo "<script>
alert('order place');
location.assign('index.php');
</script>";

// mailing
try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'fareehajabeen62@gmail.com';                     //SMTP username
    $mail->Password   = 'kzsuekvhophocawi';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('fareehajabeen62@gmail.com', 'cozaStore');
    $mail->addAddress($_SESSION['useremail'], $_SESSION['username']);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Order Confirmation';
    $mail->Body    = 'Dear '.$_SESSION['username'].' thank you for shopping your order confirmation code is '.$confirmationCode.'!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}
if(isset($_POST['searchproduct'])){
    $searchproduct = $_POST['searchproduct'];
    $query = $pdo ->prepare(query: "select * from products where productName like '%$searchproduct%'");
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach($row as $searchData){
        ?>
        
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php echo $searchData['productCatId']?>">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="<?php echo $proImageAddress.$searchData['productImage']?>" alt="IMG-PRODUCT">

							
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.php?proId=<?php  echo $searchData['productId']?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								<?php echo $searchData['productName']?>
								</a>

								<span class="stext-105 cl3">
									$<?php echo $searchData['productPrice']?>
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
								</a>
							</div>
						</div>
					</div>
				</div>
        
        <?php
    }
}
?>
