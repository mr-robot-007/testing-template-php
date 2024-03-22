<!-- Navbar -->
<?php 
        include 'config/constants.php';
        include ROOT_PATH.'header.php';
        include ROOT_PATH.'sidebar.php';
        if(isset($_SESSION['user'])) {
            include'dashboard.php';
        }
        else {
            header("Location:login.php");
        }


        ?>





<!-- Content Wrapper. Contains page content -->


<?php include 'footer.php'; ?> 