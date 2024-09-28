<?php
include("components/header.php");
?>
         <!-- Blank Start -->
         <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded mx-0">
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
<?php
include("components/footer.php");
?>