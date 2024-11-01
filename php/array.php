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
        <ul>
        <?php
        $course=[
            "cpism",
            "dism",
            "hdse1",
            "hdse2",
            "adse1",
            "adse2"
        ];
        // echo $course[2];
        // print_r($course);
// var_dump($course);
for($i=0;$i<count($course);$i++){
    ?>
    <li><?php echo $course[$i]?></li>
    
    <?php
}
        ?>
        </ul>
    </body>
</html>
