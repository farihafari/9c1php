<?php
include("components/header.php");
?>
         <!-- Blank Start -->
         <div class="container-fluid pt-4 px-4">
            <!-- Button trigger modal -->

                <div class="row  bg-light rounded mx-0">
                    <div class="col-lg-12">
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
Add Product
</button>
                    </div>
                    <div class="col-md-12">
                        <h3 class="my-3 mx-3">All Categories</h3>
                        <table class="table my-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Category Id</th>
                                        <th scope="col">Categor Name</th>
                                        <th scope="col">Category Image</th>
                                        <th scope="col" colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $query = $pdo ->query("select * from categories");
                                  $row = $query->fetchAll(PDO::FETCH_ASSOC);
                                
                                  foreach($row as $catRows){
                                    ?>
                                  
                                  <tr>
                                        <th scope="row"><?php echo $catRows['catId']?></th>
                                        <td><?php echo $catRows['catName']?></td>
                                        <td><img src="<?php echo $categoryImageAddress.$catRows['catImage']?>" width="80"></td>
                                        <td><a href="updatecategory.php?cid=<?php echo $catRows['catId']?>" class="btn btn-success">Edit</a></td>
                                        <td><a href="?delete=<?php echo $catRows['catId']?>" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                  <?php  
                                  }
                                  ?>  
                                   
                                    
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            <!-- Blank End -->
            <!--add  Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">ADD PRODUCTS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="mx-3" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="proName">
                                   
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product Price</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="proPrice">
                                   
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product Quantity</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="proQuantity">
                                   
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product Description</label>
                                    <textarea class="form-control" 
                                    id="floatingTextarea" style="height: 100px;" name="proDescription"></textarea>
                                   
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product Category</label>
                                    <select class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example" name="proCatId">

                                    <option selected>Open this select menu</option>
                                    <?php
                                    $querycat = $pdo ->query("select * from categories");
                                    $rowcat  = $querycat->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($row as $cat){
                                        ?>
                                        
                                        <option value="<?php echo $cat['catId']?>"><?php echo $cat['catName']?></option>
                                        <?php
                                    }
                                    ?>
                                  
                                    
                                </select>
                                   
                                </div>
                                <div class="mb-3">
                                       <label for="exampleInputPassword1" class="form-label">Product image</label>
                                    <input type="file" class="form-control" id="exampleInputPassword1" name="proImage">
                                </div>
                               
                                <button type="submit" class="btn btn-primary" name="addProduct">Add Category</button>
                            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
<?php
include("components/footer.php");
?>