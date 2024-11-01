<?php
include("components/header.php");
?>




            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row  bg-light rounded  mx-0">
                    <div class="col-lg-12 d-flex ms-auto mt-3">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-primary "><i class="fa fa-plus me-2"></i>Add Product</button>
                    </div>
                    <div class="col-md-12">
                        <h3 class="py-3 px-3">All Products</h3>
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">product Id</th>
                                        <th scope="col">product Name</th>
                                        <th scope="col">product Quantity</th> 
                                         <th scope="col">product Price</th>
                                         <th scope="col">product Description</th>
                                         <th scope="col">product Category</th>
                                         <th scope="col">product Image</th>
                                        <th scope="col" colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $querypro = $pdo ->query("SELECT `products`.*, `categories`.`catName`
FROM `products` 
	inner JOIN `categories` ON `products`.`productCatId` = `categories`.`catId`");
                                    $rowPro = $querypro->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($rowPro as $proRows){
                                        ?>
                                          <tr>
                                        <th scope="row"><?php echo $proRows['productId']?></th>
                                        <td><?php echo $proRows['productName']?></td>
                                        <td><?php echo $proRows['productQuantity']?></td>
                                        <td><?php echo $proRows['productPrice']?></td>
                                        <td><?php echo $proRows['productDescription']?></td>
                                        <td><?php echo $proRows['catName']?></td>
                                        <td><img src="<?php echo $proImageAddress.$proRows['productImage']?>" width="80" alt=""></td>
                                        <td><a href="#mod<?php echo $proRows['productId']?>" data-bs-toggle="modal"><i class="fas fa-edit" style="color: #74C0FC;"></i></a></td>
                                        <td><a href="#delete<?php echo $proRows['productId']?>" data-bs-toggle="modal"><i class="fas fa-trash" style="color: red;"></i></a></td>
                                    </tr>
                                        

<!--update Modal -->
<div class="modal fade" id="mod<?php echo $proRows['productId']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Update Products</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="pId" value="<?php echo $proRows['productId']?>" id="">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" name="pName" value="<?php echo $proRows['productName']?>" >
                                  
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product Quantity</label>
                                    <input type="text" class="form-control" name="pQuantity" value="<?php echo $proRows['productQuantity']?>">
                                  
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product Price</label>
                                    <input type="text" class="form-control" name="pPrice" value="<?php echo $proRows['productPrice']?>">
                                  
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product Description</label>
                                    <input type="text" class="form-control" name="pDescription" value="<?php echo $proRows['productDescription']?>">
                                  
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product Category </label>
                                    <select class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example" name="pCatId">
                                    <option selected>Open this select menu</option>
                                  <?php
                                  $query = $pdo ->query("select * from categories");
                                  $row  = $query->fetchAll(PDO::FETCH_ASSOC);
                                  foreach($row as $cat){
                                    ?>
                                     <option value="<?php echo $cat['catId']?>" <?=$proRows['productCatId']==$cat['catId'] ? "selected": ""?>><?php echo $cat['catName']?></option>
                                    <?php
                                  }
                                  ?>  
                                   
                                   
                                </select>
                                  
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Product Image</label>
                                    <input type="file" class="form-control" id="exampleInputPassword1" name="pImage">
                                    <img src="<?php echo $proImageAddress.$proRows['productImage']?>" width="80" alt="">
                                </div>
                               
                                <button type="submit" name="UpdateProduct" class="btn btn-primary">Update Product</button>
                            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>


<!-- delete Modal -->
<div class="modal fade" id="delete<?php echo $proRows['productId']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Categories</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post">
      <input type="hidden" name="pId" id="" value="<?php echo $proRows['productId']?>">
                              
                               
                                <button type="submit" name="deleteProduct" class="btn btn-primary">Delete Product</button>
                            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
      
      </div>
    </div>
  </div>
</div>

                                        <?php
                                    }
                                    ?>
                                  
                               
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            <!-- Blank End -->
<!-- add Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" name="pName">
                                  
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product Quantity</label>
                                    <input type="text" class="form-control" name="pQuantity">
                                  
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product Price</label>
                                    <input type="text" class="form-control" name="pPrice">
                                  
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product Description</label>
                                    <input type="text" class="form-control" name="pDescription">
                                  
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product Category </label>
                                    <select class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example" name="pCatId">
                                    <option selected>Open this select menu</option>
                                  <?php
                                  $query = $pdo ->query("select * from categories");
                                  $row  = $query->fetchAll(PDO::FETCH_ASSOC);
                                  foreach($row as $cat){
                                    ?>
                                     <option value="<?php echo $cat['catId']?>"><?php echo $cat['catName']?></option>
                                    <?php
                                  }
                                  ?>  
                                   
                                   
                                </select>
                                  
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Product Image</label>
                                    <input type="file" class="form-control" id="exampleInputPassword1" name="pImage">
                                </div>
                               
                                <button type="submit" name="addProduct" class="btn btn-primary">Add Product</button>
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