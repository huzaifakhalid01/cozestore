<?php
include("connection.php");

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$catImageAddress = 'dashmin/img/categories/';
$proImageAddress = 'dashmin/img/products/';

if(isset($_POST['registration'])){
    $name = $_POST['uname'];
    $email = $_POST['uemail'];
    $password = $_POST['upassword'];
    $hshPassword = sha1($password);
    $number = $_POST['unumber'];
    // checkEmail 
    $checkEmail= $pdo->prepare("select * from users where userEmail = :pe");
    $checkEmail ->bindParam("pe",$email);
    $checkEmail->execute();
    $mailTest = $checkEmail->fetch(PDO::FETCH_ASSOC);
    if(!empty($mailTest['userEmail'])){
echo "<script>alert('email already exist')</script>";
    }else{

    
    $query = $pdo->prepare("INSERT INTO `users`(`userName`, `userEmail`, `userPassword`, `userNumber`) VALUES(:un,:ue,:up,:unum)");
    $query->bindParam("un",$name);
    $query->bindParam("ue",$email);
    $query->bindParam("up",$hshPassword);
    $query->bindParam("unum",$number);
$query->execute();
echo "<script>alert('submitted');
location.assign('login.php');
</script>";
    }
}
// logIn
if(isset($_POST['logIn'])){
    $email = $_POST['uemail'];
    $password = $_POST['upassword'];
    $hshPassword = sha1($password);
    $query= $pdo->prepare("select * from users where userEmail =:pe && userPassword =:pp");
    $query->bindParam("pe",$email);
    $query->bindParam("pp",$hshPassword);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if($result){
        
        $_SESSION['userId']=$result['userId'];
        $_SESSION['userName']=$result['userName'];
        $_SESSION['userEmail']=$result['userEmail'];
        $_SESSION['userPassword']=$result['userPassword'];
        $_SESSION['userRole']=$result['userRole'];
echo "<script>
alert('logged in successfully');
</script>";
if($_SESSION['userRole']=="admin"){
    echo "<script>
location.assign('dashmin/index.php');
</script>";
}else{
    echo "<script>
    location.assign('profile.php');
    </script>";
}
        // print_r($result);
    }else{
        echo "<script>alert('data not exist')</script>";

    }
}
// session_unset();
if(isset($_POST['addToCart'])){
    $pId = $_POST['pId'];
    $pName = $_POST['pName'];
    $pPrice = $_POST['pPrice'];
    $pQuantity = $_POST['pQuantity'];
    $pImage = $_POST['pImage'];

    if(isset($_SESSION['cart'])){
        $cartQuantity = false;
        foreach($_SESSION['cart'] as $key => $values){
            if($values['proId']==$pId){
            $_SESSION['cart'][$key]['proQuantity']+=$pQuantity;
            $cartQuantity=true;
            echo "<script>location.assign('shoping-cart.php')</script>";
               
            }

        }
        if(!$cartQuantity){
           $cartCount = count($_SESSION['cart']);
           $_SESSION['cart'][$cartCount]=array("proId"=>$pId,"proName"=>$pName,"proPrice"=>$pPrice,"proQuantity"=>$pQuantity,"proImage"=>$pImage);
           echo "<script>alert('product add into cart')</script>";
        }
    }else{
        $_SESSION['cart'][0]=array("proId"=>$pId,"proName"=>$pName,"proPrice"=>$pPrice,"proQuantity"=>$pQuantity,"proImage"=>$pImage);
        echo "<script>alert('product add into cart')</script>";
    }
}
// remove cart
if(isset($_POST['cartRemove'])){
    $cartId = $_POST['cartId'];
    foreach($_SESSION['cart'] as $keys => $values){
        if($values['proId']==$cartId){
            unset($_SESSION['cart'][$keys]);
            $_SESSION['cart']=array_values($_SESSION['cart']);
            echo "<script>alert('cart remove');
            
            </script>";
        }
    }
}
// orderPlace
if(isset($_POST['orderPlace'])){
    $id = $_SESSION['userId'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $itemCount=0;
    $productQuantities =0;
    $subTotal = 0;
    function confirmation(){
        $randomCode = rand(1,999999);
        return "#od".$randomCode;
    }
    date_default_timezone_set("Asia/Karachi");
    $currentTime = time();
    $date = date("Y-m-d H:i:s",$currentTime);
    $time = date("H:i:s",strtotime($date));
    $confirmationCode =confirmation();
    $proNames = [];

    foreach($_SESSION['cart'] as $keys =>$values){
        $itemCount +=$values['proId'];
        $proNames[]=$values['proName'];
        $productQuantities += $values['proQuantity'];
        $subTotal += $values['proQuantity']*$values['proPrice'];
        $orderQuery = $pdo ->prepare("INSERT INTO `orders`(`productId`, `productName`, `productPrice`, `productQuantity`, `userId`, `userEmail`, `oDate`, `oTime`, `address`, `productImage`, `userPhone`, `userName`, `confirmation`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
$orderQuery->execute([$values['proId'],$values["proName"],$values['proPrice'],$values['proQuantity'],$id,$email,$date,$time,$address,$values['proImage'],$phone,$name,$confirmationCode]);
    }
    $allname = implode(",",$proNames);

    $invoiceQuery = $pdo ->prepare("INSERT INTO `invoice`(`totalItems`, `productNames`, `userId`, `totalProductsQuanity`, `totalAmount`, `date`, `time`, `confirmationId`) VALUES(?,?,?,?,?,?,?,?)");
    $invoiceQuery->execute([$itemCount,$allname,$id,$productQuantities,$subTotal,$date,$time,$confirmationCode]);
    unset($_SESSION['cart']);
    echo "<script>alert('order placed');
   location.assign('index.php')
    </script>";


    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'fareehajabeen62@gmail.com';                     //SMTP username
        $mail->Password   = 'pmqaqgubxqiixipk';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('fareehajabeen62@gmail.com', 'cozaStore');
        $mail->addAddress($_SESSION['userEmail'], $_SESSION['userName']);     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Order Confirmation Code';
        $mail->Body    = 'Dear '.$_SESSION['userName'].' <b>in bold!</b>';
        $mail->AltBody = 'this is text email for order confirmation';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// searchProduct
if(isset($_POST['searchProduct'])){


    $searchProduct = $_POST['searchProduct'];
    $query= $pdo ->prepare("select * from products where productName like '%$searchProduct%'");
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach($row as $values){
        ?>
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php echo $values['productCatId']?>">
    <!-- Block2 -->
    <div class="block2">
        <div class="block2-pic hov-img0">
            <img src="<?php
            echo $proImageAddress.$values['productImage']
            ?>" alt="IMG-PRODUCT">

        
        </div>

        <div class="block2-txt flex-w flex-t p-t-14">
            <div class="block2-txt-child1 flex-col-l ">
                <a href="product-detail.php?proId=<?php echo $values['productId']?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                    <?php
                    echo $values['productName']
                    ?>
                </a>

                <span class="stext-105 cl3">
                    $
                <?php
                    echo $values['productPrice']
                    ?>
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