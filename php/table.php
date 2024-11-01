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
      <div
        class="table-responsive"
      >
      <h1>table concept</h1>
        <table
            class="table table-primary"
        >
        
            <tbody>
              <?php
              for($i=1;$i<=10;$i++){
                if($i%2==0){
                    ?>
                     <tr class="table-primary">
                    <td scope="row">2</td>
                    <td>X</td>
                    <td><?php echo $i?></td>
                    <td>=</td>
                    <td><?php echo $i*2;?></td>
                </tr>
                    
                    <?php

                }else{
                    ?>
                    
                    <tr class="table-warning">
                    <td scope="row">2</td>
                    <td>X</td>
                    <td><?php echo $i?></td>
                    <td>=</td>
                    <td><?php echo $i*2;?></td>
                </tr>
                    
                    <?php
                }
                ?>
                
               
                <?php
              }
              ?>
                
                
            </tbody>
        </table>
      </div>
      
    </body>
</html>
