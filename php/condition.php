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
       <?php
       $email = "fari@gmail.com";
       $pass = "fari123";
       if($email && $pass){
        if($email=="fari@gmail.com" && $pass == "fari123"){

     
        ?>
        
        <div
            class="alert alert-primary"
            role="alert"
        >
            <strong>data valid</strong> 
        </div>
        
        <?php
           }else{
            ?>
            
            <div
            class="alert alert-primary"
            role="alert"
        >
            <strong>data not valid</strong> 
        </div>
            <?php
           }
       }else{
        ?>
         <div
            class="alert alert-primary"
            role="alert"
        >
            <strong>data not exist</strong> 
        </div>
        <?php
       }
       ?>
    </body>
</html>
