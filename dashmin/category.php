<?php
include("components/header.php");
?>




            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row  bg-light rounded  mx-0">
                    <div class="col-lg-12 d-flex ms-auto mt-3">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-primary "><i class="fa fa-plus me-2"></i>Add Category</button>
                    </div>
                    <div class="col-md-12">
                        <h3 class="py-3 px-3">All categories</h3>
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Category Id</th>
                                        <th scope="col">Category Name</th>
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
                                        <td><img src="<?php echo $catImageAddress.$catRows['catImage']?>" width="80" alt=""></td>
                                        <td><a href="#mod<?php echo $catRows['catId']?>" data-bs-toggle="modal"><i class="fas fa-edit" style="color: #74C0FC;"></i></a></td>
                                        <td><a href="#delete<?php echo $catRows['catId']?>" data-bs-toggle="modal"><i class="fas fa-trash" style="color: red;"></i></a></td>
                                    </tr>
                                        

<!--update Modal -->
<div class="modal fade" id="mod<?php echo $catRows['catId']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Update Categories</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="cId" id="" value="<?php echo $catRows['catId']?>">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="cName" value="<?php echo $catRows['catName']?>">
                                  
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Category Image</label>
                                    <input type="file" class="form-control" id="exampleInputPassword1" name="cImage">
                                    <img src="<?php echo $catImageAddress.$catRows['catImage']?>" width="80" alt="">
                                </div>
                               
                                <button type="submit" name="updateCategory" class="btn btn-primary">Update Category</button>
                            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>


<!-- delete Modal -->
<div class="modal fade" id="delete<?php echo $catRows['catId']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Categories</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post">
      <input type="hidden" name="cId" id="" value="<?php echo $catRows['catId']?>">
                              
                               
                                <button type="submit" name="deleteCategory" class="btn btn-primary">Delete Category</button>
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
        <h5 class="modal-title" id="staticBackdropLabel">Add Categories</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="cName">
                                  
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Category Image</label>
                                    <input type="file" class="form-control" id="exampleInputPassword1" name="cImage">
                                </div>
                               
                                <button type="submit" name="addCategory" class="btn btn-primary">Add Category</button>
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