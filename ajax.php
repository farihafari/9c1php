<?php
include "model/connection.php";
$proImageAddress = "dashmin/img/products/";
$proQuery = $pdo ->query("select * from products");
$rowProducts = $proQuery->fetchAll(PDO::FETCH_ASSOC);
foreach($rowProducts as $allProducts){
    ?>
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php echo $allProducts['productCatId']?>">
<!-- Block2 -->
<div class="block2">
    <div class="block2-pic hov-img0">
        <img src="<?php echo $proImageAddress.$allProducts['productImage']?>" alt="IMG-PRODUCT">

        
    </div>

    <div class="block2-txt flex-w flex-t p-t-14">
        <div class="block2-txt-child1 flex-col-l ">
            <a href="product-detail.php?proId=<?php  echo $allProducts['productId']?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
            <?php echo $allProducts['productName']?>
            </a>

            <span class="stext-105 cl3">
                $<?php echo $allProducts['productPrice']?>
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
?>