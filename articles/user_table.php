<?php 
        include '../config/constants.php';
        
        const conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB);
        if (isset($_SESSION['user']['username'])) {
            $sql_query = "SELECT * from demo_table";
            $result = conn->query($sql_query);

            if ($result->num_rows > 0) {
                $_SESSION["result"] = $result;
            } else {
                echo "0 results";
            }

            
        }

?>

<!-- Navbar -->
<?php 
        include '../header.php';
        // <!-- Main Sidebar Container -->
        include '../sidebar.php';
        ?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Users List</h3>

                            <div class="card-tools">
                                <?php if($_SESSION['user']['type'] === 'admin') {
                                            echo '<a href="register.php">
                                            <button type=:button" class="btn btn-block btn-secondary btn-sm">Add
                                                user</button>
                                        </a>';
                                        }?>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Profile_Pic</th>
                                        <?php 
                                                  if ($_SESSION['user']['type'] === 'admin') {
                                                    echo '
                                                        <th>Action</th>
                                                        <th>Action</th>';
                                                }
                                                ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $rows = $_SESSION['result'];

                                        foreach ($rows as $row) {
                                            echo "<tr>";
                                            echo "<td class='border px-4 py-2'>" . $row["id"] . "</td>";
                                            echo "<td class='border px-4 py-2'>" . $row["email"] . "</td>";
                                            echo "<td class='border px-4 py-2'>" . $row["username"] . "</td>";
                                            echo "<td class='border px-4 py-2'>" . $row["profile_pic"] . "</td>";
                                            if ($_SESSION['user']['type'] === 'admin') {
                                                echo "<td class='border px-4 py-2'>" . "<a href ='register.php?id={$row["id"]}'><button type='button' class='btn btn-block btn-primary btn-sm'>Edit</button></a>" . "</td>";
                                                // echo "<td class='border px-4 py-2'>" . "<a id='delete_button' '><button id = 'delete_button' class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'>Delete</button></a>" . "</td>";
                                                echo "<td class='border px-4 py-2'>" . "<a href ='services/delete.php?id={$row["id"]}'><button type='button' class='btn btn-block btn-danger btn-sm'>Delete</button></a>" . "</td>";
                                            }
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>


<?php include '../footer.php'; ?>