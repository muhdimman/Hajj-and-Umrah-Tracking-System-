<!DOCTYPE html>
<?php
include('functions.php');
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location : login.php');
}
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MUTAWIF PROFILE- Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <? include('dbconnect.php'); ?>
        <?php include('./navbar/mutawifnavbar.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                $conn = mysqli_connect('localhost', 'root', 'Shahrul123!', 'my_db');
                                $id = $_SESSION['user']['id'];
                                $query = mysqli_query($conn, "SELECT * FROM mutawif where id='$id'");
                                $row = mysqli_fetch_array($query);
                                ?>
                                <!-- <a href="home.php">HELLO</a> -->
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" value=""><?php echo $row['username']; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="editprofile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Area Chart -->
                    <div class="col-lg">
                        <div class="card shadow">
                            <!-- Card Header - Dropdown -->

                            <!-- Card Body -->
                            <div class="card-body">
                                <!-- Begin Page Content -->
                                <div class="container-fluid">
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Add Pilgrims to group </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <?php
                                                $conn = mysqli_connect('localhost', 'root', 'Shahrul123!', 'my_db');
                                                $mutawwif = $_SESSION['user']['id'];

                                                $query = mysqli_query($conn, "SELECT * FROM users WHERE user_type='user'  AND mutawif_id !='$mutawwif' AND mutawif_id='0'");
                                                if (mysqli_num_rows($query) > 0) {
                                                    echo '<form action="action.php" method="POST">
                                                            <label for="cars">Choose a Users:</label>
                                                            <select name="user" id="user">';
                                                    $sn = 1;
                                                    while ($data = mysqli_fetch_assoc($query)) {

                                                        echo '<option value=' . $data["id"] . '>' . $data["username"] . '</option>';
                                                    }

                                                    echo '</select>
                                                            <br><br>
                                                            <input type="submit" value="submit">
                                                        </form>';
                                                }
                                                $mutawwif = $_SESSION['user']['id'];

                                                $sql = "SELECT * FROM users WHERE mutawif_id=$mutawwif ";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    // output data of each row
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<style>
                                                                .styled-table {
                                                                    border-collapse: collapse;
                                                                    margin: 25px 0;
                                                                    font-size: 0.9em;
                                                                    font-family: sans-serif;
                                                                    min-width: 400px;
                                                                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
                                                                }
                                                                .styled-table thead tr {
                                                                    background-color: #009879;
                                                                    color: #ffffff;
                                                                    text-align: left;
                                                                }
                                                                .styled-table th,
                                                                .styled-table td {
                                                                    padding: 12px 15px;
                                                                }
                                                                .styled-table tbody tr {
                                                                    border-bottom: 1px solid #dddddd;
                                                                }
                                                                
                                                                .styled-table tbody tr:nth-of-type(even) {
                                                                    background-color: #f3f3f3;
                                                                }
                                                                
                                                                .styled-table tbody tr:last-of-type {
                                                                    border-bottom: 2px solid #009879;
                                                                }
                                                                .styled-table tbody tr.active-row {
                                                                    font-weight: bold;
                                                                    color: #009879;
                                                                }
                                                                
                                                                </style>";
                                                        echo "<br>";
                                                        echo "
                                                                <table class='styled-table'>
                                                                    <thead>
                                                                        <tr>
                                                                            
                                                                            <th>Username</th>
                                                                            <th>Email</th>
                                                                            <th>Full Name</th>
                                                                            <th>Delete</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr class='active-row'>
                                                                        
                                                                        <td>" . $row["username"] . "</td>
                                                                        <td>" . $row["email"] . "</td>
                                                                        <td>" . $row["fullname"] . "</td>
                                                                        <td><a href=./delete.php?user_id=" . $row["id"] . ">Delete</a></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>";
                                                    }
                                                } else {
                                                    echo "0 results";
                                                }


                                                $conn->close();


                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Footer -->
                                    <footer class="sticky-footer bg-white">
                                        <div class="container my-auto">
                                            <div class="copyright text-center my-auto">
                                                <span>Copyright &copy;</span>
                                            </div>
                                        </div>
                                    </footer>
                                    <!-- End of Footer -->

                                </div>
                                <!-- End of Page Wrapper -->

                                <!-- Scroll to Top Button-->
                                <a class="scroll-to-top rounded" href="#page-top">
                                    <i class="fas fa-angle-up"></i>
                                </a>

                                <!-- Logout Modal-->
                                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <?php if (isset($_SESSION['user'])) : ?>
                                                    <!-- <?php echo $_SESSION['user']['username']; ?> -->
                                                    <small>
                                                        <a href="index.php?logout='1'"><button class="btn btn-primary">logout</button></a>
                                                        <small>
                                                        <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bootstrap core JavaScript-->
                                <script src="vendor/jquery/jquery.min.js"></script>
                                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                                <!-- Core plugin JavaScript-->
                                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                                <!-- Custom scripts for all pages-->
                                <script src="js/sb-admin-2.min.js"></script>

                                <!-- Page level plugins -->
                                <script src="vendor/chart.js/Chart.min.js"></script>

                                <!-- Page level custom scripts -->
                                <script src="js/demo/chart-area-demo.js"></script>
                                <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>