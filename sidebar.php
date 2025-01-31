<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <span class="brand-text font-weight-light">USERS & TODOS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo $_SESSION['user']['profile_pic'] ?>" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href='<?php echo "register.php?id=".$_SESSION['user']['uid'];?> '
                    class="d-block"><?php echo $_SESSION['user']['username'] ?></a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="users/user_table.php" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Users List
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="articles/user_table.php" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Users List via articles
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="todos.php" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Todo List
                        </p>
                    </a>
                </li>

            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>