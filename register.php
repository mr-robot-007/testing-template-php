<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <link rel="stylesheet" href="index.css" />
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php 
        include 'config/constants.php';
        
        const conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB);
        include 'header.php';
        // <!-- Main Sidebar Container -->
        include 'sidebar.php';
        function test_input_create($input)
        {
            $sql_query = "SELECT * from demo_table WHERE email='$input' OR username='$input'";
            $result = conn->query($sql_query)->fetch_assoc();
            if ($result) {
                return false;
            } else {
                return true;
            }
        }
        function test_input_edit($input, $id)
        {
            $sql_query = "SELECT * from demo_table WHERE username='$input' AND id!='$id'";
            $result = conn->query($sql_query)->fetch_assoc();
            print_r($result);
            if ($result === null) {
                return false;
            } else {
                return true;
            }

        }
        $emailErr = $_GET['emailErr'] ?? "";
        $usernameErr = $_GET['usernameErr'] ?? "";
        $passwordErr = $_GET['passwordErr'] ?? "";



        if (isset($_POST["createuser"]) && $_POST["id"] != "") {
            $id = $_POST["id"];
        
            if (empty($_POST["username"])) {
                $usernameErr = "Username is required";
            } else if (test_input_edit($_POST["username"], $id)) {
                $usernameErr = "username already exists";
            }
            if (empty($_POST["password"])) {
                $passwordErr = "Password can't be empty";
            }
            echo strlen($usernameErr) . strlen($passwordErr);
            if (strlen($usernameErr) > 0 || strlen($passwordErr) > 0) {
                header("Location:register.php?id={$id}&usernameErr={$usernameErr}&passwordErr={$passwordErr}");
            } else {
        
                $email = $_POST["hidden_email"];
                $password = $_POST["password"];
                $username = $_POST["username"];
                $image_data = $_FILES["image"];
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                if ($target_file === $target_dir)
                    $target_file = "Not available";
        
                $sql_query = "UPDATE demo_table SET username = '$username' , password = '$password',profile_pic= '$target_file' WHERE email='$email'";
                conn->query($sql_query);
        
        
        
        
                header('Location:user_table.php');
            }
        
        } else if (isset($_POST["createuser"])) {


            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } else if (!test_input_create($_POST["email"])) {
                $emailErr = "Email already exists";
            }
            if (empty($_POST["username"])) {
                $usernameErr = "Username is required";
            } else if (!test_input_create($_POST["username"])) {
                $usernameErr = "username already exists";
            }
            if (empty($_POST["password"])) {
                $passwordErr = "Password can't be empty";
            }
            if (!strlen($usernameErr) && !strlen($emailErr)) {
        
                $email = $_POST["email"];
                $password = $_POST["password"];
                $username = $_POST["username"];
                $image_data = $_FILES["image"];
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        
        
        
                // header('Location:dashboard.php');
        
                $sql_query = "SELECT * from demo_table WHERE email='$email' OR username='$username'";
                $result = conn->query($sql_query)->fetch_assoc();
                // print_r($result);
                if ($result) {
                    header("Location:register.php");
                } else {
        
                    $sql_query = "INSERT into demo_table (username,email,profile_pic,password) VALUES ('$username','$email','$target_file','$password')";
                    if (conn->query($sql_query)) {
                        echo "New user created successfully. <br>";
                        header("Location:index.php");
        
                    }
                }
            }
        }
        $_id = '';
        if (isset($_GET['id'])) {
            $_id = $_GET['id'];
        }
        $sql_query = "SELECT * from demo_table WHERE id='$_id' ";
        $result = conn->query($sql_query)->fetch_assoc();
        ?>




        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo $_id ? "Edit User" : "Add user"; ?> </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="register.php" enctype="multipart/form-data" method="POST">
                                    <input type='hidden' name='createuser' value='true' />
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" name="email" <?php if ($result)
                                                echo "disabled"; ?> class="form-control" value="<?php if ($result)
                                                echo $result["email"]; ?>" id="exampleInputEmail1"
                                                placeholder="Enter email">

                                            <input type="email" name="hidden_email" hidden
                                                class="px-1 rounded-md outline outline-2" value="<?php if ($result)
                                                echo $result["email"]; ?>" />
                                            <input type="hidden" name="id" class=" rounded-md outline outline-2" value="<?php if ($result)
                                                echo $result["id"]; ?>" />
                                            <span class="error text-red-800 text-xs"><?php if ($emailErr)
                                                echo $emailErr; ?></span>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Username</label>
                                            <input type="text" name="username" class="form-control"
                                                id="exampleInputEmail1" placeholder="Enter username" value="<?php if ($result)
                                                    echo $result["username"]; ?>">
                                            <span class="error text-red-800 text-xs"><?php if ($usernameErr)
                                                    echo $usernameErr; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="text" name="password" class="form-control"
                                                id="exampleInputPassword1" placeholder="Password" value="<?php if ($result)
                                                echo $result["password"]; ?>">
                                            <span class="error text-red-800 text-xs"><?php if ($usernameErr)
                                                echo $passwordErr; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="image" class="custom-file-input"
                                                        id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary"><?php echo $_id ? "Save changes" : "Create new user"; ?></button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->

                            <!-- general form elements -->


                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php include 'footer.php'; ?>
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

</body>

</html>