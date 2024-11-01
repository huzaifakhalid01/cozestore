<?php
include("connection.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>
<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = $pdo->prepare("select * from userdetails where id = :pid");
    $query->bindParam('pid', $id);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);

}
?>
    <body>
        <div class="container">
            <h1>user detail</h1>
            <form action="" method="post">
<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input
                    type="text"
                    name="uname"
                    id=""
                    class="form-control"
                    placeholder=""
                    aria-describedby="helpId"
                    value="<?php echo $row['name']?>"
                />
           
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    id=""
                    class="form-control"
                    placeholder=""
                    aria-describedby="helpId"
                          value="<?php echo $row['email']?>"
                />
    
            </div>
         
       
            <button
                type="submit"
                class="btn btn-primary"
                name="update"
            >
                submit
            </button>
            
            </form>
        </div>
        <?php
        if(isset($_POST['update'])){
            $id = $_POST['id'];
      $name= $_POST['uname'];
      $email = $_POST['email'];
     

      $query = $pdo->prepare("update userdetails set name = :pn , email = :pe where id = :pid");
      $query->bindParam('pid', $id);
      $query->bindParam('pn',$name);
      $query->bindParam('pe',$email);
  
      $query->execute();
      echo "<script>alert('data update');
      location.assign('view.php')
      </script>";
        }
        ?>
    </body>
</html>

