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
        $titleErr = $_GET['titleErr'] ?? "";
        $descErr = $_GET['descErr'] ?? "";
        $assignErr = $_GET['assignErr'] ?? "";
        $statusErr = $_GET['statusErr'] ?? "";



        if (isset($_POST["addtodo"]) && $_POST["id"] != "") {
            $id = $_POST["id"];
        
            
        
            if (empty($_POST["title"])) {
                $titleErr = "Title is required";
            }
            if (empty($_POST["description"])) {
                $descErr = "Description can't be empty";
            }
            if (empty($_POST["assigned_to"])) {
                $assignErr = "Assigned_to can't be empty";
            }
            if (empty($_POST["status"])) {
                $statusErr = "Status can't be empty";
            }
            if (strlen($titleErr) > 0 || strlen($descErr) > 0 || strlen($assignErr) > 0 || strlen($statusErr) > 0) {
                header("Location:addtodo.php?id={$id}&titleErr={$titleErr}&descErr={$descErr}&assignErr={$assignErr}&statusErr={$statusErr}");
            } else {
        
               $id = $_POST["id"];
               $title = $_POST["title"];
               $description = $_POST["description"];
               $assigned_to = $_POST["assigned_to"];
               $status = $_POST["status"];

                $sql_query = "UPDATE todos SET title = '$title' , description = '$description',assigned_to = '$assigned_to',status = '$status' WHERE id='$id'";
                conn->query($sql_query);
        
        
        
        
                header('Location:todos.php');
            }
        
        } else if (isset($_POST["addtodo"])) {


            if (empty($_POST["title"])) {
                $titleErr = "Title is required";
            }
            if (empty($_POST["description"])) {
                $descErr = "Description can't be empty";
            }
            if (empty($_POST["assigned_to"])) {
                $assignErr = "Assigned_to can't be empty";
            }
            if (empty($_POST["status"])) {
                $statusErr = "Status can't be empty";
            }
            if (strlen($titleErr) > 0 || strlen($descErr) > 0 || strlen($assignErr) > 0 || strlen($statusErr) > 0) {
                header("Location:addtodo.php?titleErr={$titleErr}&descErr={$descErr}&assignErr={$assignErr}&statusErr={$statusErr}");
            } else {
        
               $id = $_POST["id"];
               $title = $_POST["title"];
               $description = $_POST["description"];
               $assigned_to = $_POST["assigned_to"];
               $status = $_POST["status"];

                $sql_query =  "INSERT into todos (title,description,assigned_to,status) VALUES ('$title','$description','$assigned_to','$status')";
                if (conn->query($sql_query)) {
                    echo "New todo created successfully. <br>";
                    
                }
                
                header("Location:todos.php");
            }
        
        
        }
        $_id = '';
        if (isset($_GET['id'])) {
            $_id = $_GET['id'];
        }
        $sql_query = "SELECT * from todos WHERE id='$_id' ";
        $result = conn->query($sql_query)->fetch_assoc();
        $sql_query2 =  "SELECT * from demo_table";
        $users = conn->query($sql_query2);
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
                                    <h3 class="card-title"><?php echo $_id ? "Edit Todo" : "Add Todo"; ?> </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="addtodo.php" method="POST">
                                    <input type='hidden' name='addtodo' value='true' />
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" class="form-control" value="<?php if ($result)
                                                echo $result["title"]; ?>" id="exampleInputEmail1"
                                                placeholder="Enter title">

                                            <input type="hidden" name="id" class=" rounded-md outline outline-2" value="<?php if ($result)
                                                echo $result["id"]; ?>" />
                                            <span class="error text-red-800 text-xs"><?php if ($titleErr)
                                                echo $titleErr; ?></span>

                                        </div>
                                        <div class="form-group">
                                            <label for="decription">Description</label>
                                            <input type="text" name="description" class="form-control" id="description"
                                                placeholder="Enter desc..." value="<?php if ($result)
                                                    echo $result["description"]; ?>">
                                            <span class="error text-red-800 text-xs"><?php if ($descErr)
                                                    echo $descErr; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="assigned_to">Assigned To</label>
                                            <select id="assigned_to" name="assigned_to" class="form-control">
                                                <?php 
                                                    foreach($users as $user) {
                                                        echo "<option value='{$user["email"]}'>".$user['email']."</option>";
                                                    }
                                                ?>
                                            </select>

                                            <span class="error text-red-800 text-xs"><?php if ($assignErr)
                                                echo $assignErr; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>

                                            <select id="status" name="status" class="form-control">
                                                <option <?php if ($result && $result['status']=='assigned')
                                                echo "selected"; ?> value="assigned">assigned</option>
                                                <option <?php if ($result && $result['status']=='pending')
                                                echo "selected"; ?> value="pending">pending</option>
                                                <option <?php if ($result && $result['status']=='completed')
                                                echo "selected";
                                             ?> value="completed">completed</option>
                                            </select>

                                            <span class="error text-red-800 text-xs"><?php if ($statusErr)
                                                echo $statusErr; ?></span>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary"><?php echo $_id ? "Save changes" : "Create new Todo"; ?></button>
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



        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->



    <?php include 'footer.php'; ?>
</body>

</html>