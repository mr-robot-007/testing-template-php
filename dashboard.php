<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php 
        
        const conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB);
        if (isset($_SESSION['user']['username'])) {
            $sql_query = "SELECT * from demo_table";
            $result = conn->query($sql_query);

            if ($result->num_rows > 0) {
                $_SESSION["result"] = $result;
            } else {
                echo "0 results";
            }

            $_SESSION["active"] = "user_table";
            
            
            $email = $_SESSION["user"]["email"];
            $sql_query = "SELECT * from todos where assigned_to='$email'";
            $result = conn->query($sql_query);
            
        }

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <p>Total Users</p>
                            <h3><?php echo $_SESSION['result']->num_rows ?></h3>

                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="users/user_table.php" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $result->num_rows ?></h3>

                            <p>Tasks Assigned</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="todos.php" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div style="width: 700px;">
                    hii
                    <canvas id='chart'>hii</canvas>
                </div>
            </div>

            <!-- /.row -->
            <!-- Main row -->

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>



<script src="chartsforusers.js">

</script>