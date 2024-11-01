<?php
include('components/header.php');
if($_SESSION['userRole']!="user"){
    echo "<script>
    location.assign('index.php');
    </script>";
}
?>
profile
<?php
include('components/footer.php');
?>