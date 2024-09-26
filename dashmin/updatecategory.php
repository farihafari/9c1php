<?php
include("components/header.php");
if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
    $query = $pdo->prepare("select * from categories where catId = :pid");
    $query->bindParam("pid", $cid);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
}
?>
<!-- category Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded">
        <div class="col-md-12">
            <h3 class="py-3">Update Categories</h3>
            <form class="mx-3" method="post" enctype="multipart/form-data">
                <input type="hidden" name="catId" value="<?php echo $row['catId']?>">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">category name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="catName" value="<?php echo $row['catName'] ?>">

                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">category image</label>
                    <input type="file" class="form-control" id="exampleInputPassword1" name="catImage">
                    <img src="<?php echo $categoryImageAddress . $row['catImage'] ?>" width="80" alt="">
                </div>

                <button type="submit" class="btn btn-primary" name="updateCategory">Update Category</button>
            </form>
        </div>
    </div>
</div>
<!-- Blank End -->
<?php
include("components/footer.php");
?>