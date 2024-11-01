<?php
include("connection.php");
$catImageAddress = 'img/categories/';
$proImageAddress = 'img/products/';

if(isset($_POST['addCategory'])){
    $categoryName = $_POST['cName'];
    $categoryImageName = $_FILES['cImage']['name'];
    $categoryTmpImage =  $_FILES['cImage']['tmp_name'];
    $extension  = pathinfo($categoryImageName,PATHINFO_EXTENSION);
    $filePath = 'img/categories/'.$categoryImageName;
    if($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "webp"){
if(move_uploaded_file($categoryTmpImage,$filePath)){
    $query = $pdo->prepare("insert into categories(catName,catImage) values(:pn,:pi)");
    $query->bindParam('pn',$categoryName);
    $query->bindParam("pi",$categoryImageName);
    $query->execute();
    echo "<script>alert('category added into table')</script>";
}
    }else{
        echo "<script>alert('you may use only jpg,png,webp or jpeg format ')</script>";
    }
}
// update category
if(isset($_POST['updateCategory'])){
    $categoryName = $_POST['cName'];
    $categoryId = $_POST['cId'];
    if(!empty($categoryImageName = $_FILES['cImage']['name'])){
        $categoryImageName = $_FILES['cImage']['name'];
        $categoryTmpImage =  $_FILES['cImage']['tmp_name'];
        $extension  = pathinfo($categoryImageName,PATHINFO_EXTENSION);
        $filePath = 'img/categories/'.$categoryImageName;
        if($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "webp"){
    if(move_uploaded_file($categoryTmpImage,$filePath)){
        $query = $pdo->prepare("update categories set catName= :pn , catImage = :pi where catId =:pid");
        $query->bindParam("pid",$categoryId);
        $query->bindParam('pn',$categoryName);
        $query->bindParam("pi",$categoryImageName);
        $query->execute();
        echo "<script>alert('category update into table')</script>";
    }
        }else{
            echo "<script>alert('you may use only jpg,png,webp or jpeg format ')</script>";
        }
    }else{
        $query = $pdo->prepare("update categories set catName= :pn  where catId =:pid");
        $query->bindParam("pid",$categoryId);
        $query->bindParam('pn',$categoryName);
        $query->execute();
        echo "<script>alert('category update into table')</script>";
    }
}
// ddeleteCategory
if(isset($_POST['deleteCategory'])){
    $categoryId = $_POST['cId'];
    $query = $pdo ->prepare("delete from categories where catId = :cid");
    $query->bindParam("cid",$categoryId);
    $query->execute();
    echo "<script>alert('category dalete from table')</script>";
}
// addProduct
if(isset($_POST['addProduct'])){
    $productName = $_POST['pName'];
    $productPrice = $_POST['pPrice'];
    $productQuantity = $_POST['pQuantity'];
    $productDescription = $_POST['pDescription'];
    $productCatId = $_POST['pCatId'];
    $productImage = $_FILES['pImage']['name'];
    $productTmpImage = $_FILES['pImage']['tmp_name'];
$filePath = "img/products/".$productImage;
$extension = pathinfo($productImage,PATHINFO_EXTENSION);
if($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "webp"){
if(move_uploaded_file($productTmpImage,$filePath)){
    $query = $pdo->prepare("INSERT INTO `products`(`productName`, `productPrice`, `productQuantity`, `productDescription`, `productCatId`, `productImage`) VALUES(:pn,:pp,:pq,:pd,:pcid,:pi)");
    $query->bindParam("pn",$productName);
    $query->bindParam("pp",$productPrice);
    $query->bindParam("pq",$productQuantity);
    $query->bindParam("pd",$productDescription);
    $query->bindParam("pcid",$productCatId);
    $query->bindParam("pi",$productImage);
    $query->execute();

    echo "<script>alert('product added ')</script>";
}
}

}
// UpdateProduct
if(isset($_POST['UpdateProduct'])){
    $productId = $_POST['pId'];
    $productName=$_POST['pName'];
    $productPrice = $_POST['pPrice'];
    $productQuantity = $_POST['pQuantity'];
    $productDescription = $_POST['pDescription'];
    $productCatId = $_POST['pCatId'];
    if(!empty($_FILES['pImage']['name'])){
        $productImage = $_FILES['pImage']['name'];
        $productTmpImage = $_FILES['pImage']['tmp_name'];
    $filePath = "img/products/".$productImage;
    $extension = pathinfo($productImage,PATHINFO_EXTENSION);
    if($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "webp"){
    if(move_uploaded_file($productTmpImage,$filePath)){
        $query = $pdo->prepare("update products set productName=:pn,productPrice=:pp,productQuantity=:pq,productDescription=:pd,productCatId = :pcid,productImage=:pi where productId = :pid");
        $query->bindParam("pid",$productId);
        $query->bindParam("pn",$productName);
        $query->bindParam("pp",$productPrice);
        $query->bindParam("pq",$productQuantity);
        $query->bindParam("pd",$productDescription);
        $query->bindParam("pcid",$productCatId);
        $query->bindParam("pi",$productImage);
        $query->execute();
    
        echo "<script>alert('product updated')</script>";
    }
    }   
    }else{
        $query = $pdo->prepare("update products set productName=:pn,productPrice=:pp,productQuantity=:pq,productDescription=:pd,productCatId = :pcid where productId = :pid");
        $query->bindParam("pid",$productId);
        $query->bindParam("pn",$productName);
        $query->bindParam("pp",$productPrice);
        $query->bindParam("pq",$productQuantity);
        $query->bindParam("pd",$productDescription);
        $query->bindParam("pcid",$productCatId);
        $query->execute();
    
        echo "<script>alert('product updated')</script>";
 
    }
}
// delete pro 
if(isset($_POST['deleteProduct'])){
    $productId = $_POST['pId'];
    $query = $pdo -> prepare("delete from products where productId = :pid");
    $query->bindParam("pid",$productId);
    $query->execute();
    echo "<script>alert('product deleted')</script>";
}
?>                                                                         