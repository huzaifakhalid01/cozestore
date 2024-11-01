<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
</head>

<body>
    <div
        class="table-responsive">
        <table
            class="table table- table-hover">
            <thead>
                <tr>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">age</th>
                    <th scope="col">course</th>
                    <th scope="col">fee</th>

                </tr>
            </thead>
            <tbody>


                <?php
                $std_detail = [
                    [
                        "name" => "ali",
                        "age" => "20",
                        "email" => "ali@gmail.com",
                        "course" => "cpism",
                        "fee" => 8500
                    ],

                    [
                        "name" => "alishar",
                        "age" => "20",
                        "email" => "alishar@gmail.com",
                        "course" => "cpism",
                        "fee" => 8500
                    ],
                    [
                        "name" => "aliyan",
                        "age" => "20",
                        "email" => "alishar@gmail.com",
                        "course" => "cpism",
                        "fee" => 8500
                    ],
                    [
                        "name" => "alishba",
                        "age" => "20",
                        "email" => "alishar@gmail.com",
                        "course" => "cpism",
                        "fee" => 8500
                    ]
                ];
                $i = 1;
                foreach ($std_detail as $value) {
                    if ($i % 2 == 0) {

                ?>
                        <tr  class="table-danger">

                            <!-- <td scope="row"><?php echo $i ?></td> -->
                            <td scope="row"><?php echo $value['name'] ?></td>
                            <td scope="row"><?php echo $value['email'] ?></td>
                            <td scope="row"><?php echo $value['age'] ?></td>
                            <td scope="row"><?php echo $value['course'] ?></td>
                            <td scope="row"><?php echo $value['fee'] ?></td>

                        </tr>

                    <?php
                    } else {
                    ?>
                        <tr  class="table-success">
                            <td scope="row"><?php echo $value['name'] ?></td>
                            <td scope="row"><?php echo $value['email'] ?></td>
                            <td scope="row"><?php echo $value['age'] ?></td>
                            <td scope="row"><?php echo $value['course'] ?></td>
                            <td scope="row"><?php echo $value['fee'] ?></td>

                        </tr>
                <?php


                    }
                    $i++;
                }

                ?>

            </tbody>
        </table>
    </div>
</body>

</html>