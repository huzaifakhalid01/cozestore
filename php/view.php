<?php
include('connection.php');
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

    <body>
        <div class="container">
            <div
                class="table-responsive"
            >
                <table
                    class="table table-primary"
                >
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = $pdo->query("select * from userdetails");
                    
                        $row = $query->fetchAll(PDO::FETCH_ASSOC);
                       
foreach($row as $values){
    ?>

<tr class="">
                            <td scope="row"><?php echo $values['id']?></td>
                            <td><?php echo $values['name']?></td>
                            <td><?php echo $values['email']?></td>
                            <td><a href="update.php?id=<?php echo $values['id']?>" class="btn btn-outline-success">Edit</a></td>
                            <td><a href="?did=<?php echo $values['id']?>" class="btn btn-outline-danger">Delete</a></td>

                        </tr>
    <?php
}
if(isset($_GET['did'])){
    $id = $_GET['did'];
    $query = $pdo->prepare("delete from userdetails where id=:pid");
    $query->bindParam(':pid',$id);
    $query->execute();
    echo "<script>alert('data delete');
    location.assign('view.php')</script>";
}
 ?>
                       
                      
                    </tbody>
                </table>
            </div>
            
        </div>
    </body>
</html>
