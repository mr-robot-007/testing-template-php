<?php 
        include 'config/constants.php';
        
        const conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB);
        if (isset($_SESSION['user']['email'])) {
            $sql_query ;
            $email = $_SESSION["user"]["email"];
            if($_SESSION['user']['type'] == 'admin') {
                $sql_query = "SELECT * from todos";
            }
            else {
                $sql_query = "SELECT * from todos where assigned_to='$email'";
            }
            
            $result = conn->query($sql_query);

            if ($result->num_rows > 0) {
                $_SESSION["result"] = $result;
            } else {
                echo "0 results";
            }

            $_SESSION["active"] = "user_table";
            
            
            
        }

?>
<!-- Navbar -->
<?php 
        include 'header.php';
        // <!-- Main Sidebar Container -->
        include 'sidebar.php';
        ?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Todos</h3>


                            <div class="card-tools">
                                <?php if($_SESSION['user']['type'] === 'admin') {
                                            echo '<a href="addtodo.php">
                                            <button type=:button" class="btn btn-block btn-secondary btn-sm">Add
                                                todo</button>
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
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Assigned_to</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <?php 
                                                  if ($_SESSION['user']['type'] === 'admin') {
                                                    echo '<th>Action</th>';
                                                    echo '<th>Action</th>';
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
                                            echo "<td class='border px-4 py-2'>" . $row["title"] . "</td>";
                                            echo "<td class='border px-4 py-2'>" . $row["description"] . "</td>";
                                            echo "<td class='border px-4 py-2'>" . $row["assigned_to"] . "</td>";
                                            echo "<td class='border px-4 py-2'>" . $row["status"] . "</td>";
                                            echo "<td class='border px-4 py-2'>" . "<a href ='services/toggletodo.php?id={$row["id"]}'><button type='button' class='btn btn-block btn-sm
                                            ";
                                            if($row['status']==='completed') {
                                                echo 'btn-success';
                                            }
                                            else {
                                                echo 'btn-info';
                                            }
                                            echo "'>";
                                            if($row["status"]=="completed") {
                                                echo "Mark as pending";
                                            }
                                            else {
                                                echo "Mark as complete";
                                            }
                                            echo"</button></a>" . "</td>";
                                            if ($_SESSION['user']['type'] === 'admin') {
                                                // echo "<td class='border px-4 py-2'>" . "<a id='delete_button' '><button id = 'delete_button' class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'>Delete</button></a>" . "</td>";
                                                echo "<td class='border px-4 py-2'>" . "<a href ='addtodo.php?id={$row["id"]}'><button type='button' class='btn btn-block btn-primary btn-sm'>Edit</button></a>" . "</td>";
                                                echo "<td class='border px-4 py-2'>" . "<a href ='services/deletetodo.php?id={$row["id"]}'><button type='button' class='btn btn-block btn-danger btn-sm'>Delete</button></a>" . "</td>";
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


<?php include 'footer.php'; ?>