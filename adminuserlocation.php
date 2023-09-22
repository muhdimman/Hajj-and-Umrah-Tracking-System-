<!DOCTYPE html>
<?php 
	include('functions.php') ;
	if(isset($_GET['logout'])){
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

    <title>USER PROFILE- Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include("./navbar/navbar-admin.php");?>
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
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                    include 'dbconnect.php';
                                    $id=$_SESSION['user']['id'];
                                    $query=mysqli_query($conn,"SELECT * FROM users where id='$id'");
                                    $row=mysqli_fetch_array($query);
                                ?>     
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" value=""><?php echo $row['username']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="editprofile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400" ></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
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



                    

                    <div class="row">

                        <!-- Begin Page Content -->
                <div class="container-fluid">

<!-- Area Chart -->
<div class="col-lg">
    <div class="card shadow">
            <!-- Card Body -->
            <div class="card-body">
                <!-- Begin Page Content -->
                    <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Number Pilgrims</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <?php
                                include("dbconnect.php");
                                
                                $query = "SELECT * FROM mutawif WHERE user_type = 'mutawif' ";
                                $result = $db->query($query);
                        
                            ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>UserName</th>
                                            <th>Name</th>
                                            <th>location</th>
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>UserName</th>
                                            <th>Name</th>
                                            <th>location</th>
                                            
                                        </tr>
                                    </tfoot>
                                        <tbody>
                                            <?php
                                                include('dbconnect.php');
                                                $query = "SELECT * FROM users  WHERE user_type= 'user' or user_type= 'user1' or user_type= 'user2'  ";
                                                // $query = "SELECT username FROM users t1 INNER JOIN mutawif t2 on t1.id=t2.id";
                                                $result = mysqli_query($conn, $query);
                                            ?>
                                            <?php
                                                if (mysqli_num_rows($result) > 0) {
                                                    $sn=1;
                                                    while($data = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                <td><?php echo $data['username']; ?> </td>
                                                <td><?php echo $data['fullname']; ?> </td>
                                                <td><form method="post">
                                                    <?php 
                                                        if($data['user_type']=='user1')
                                                        {
                                                            echo "<button type='submit'><a href='./map/index.php'>View location</a></button>";
                                                        }
                                                        else if($data['user_type']=='user')
                                                        {
                                                            echo "<button name='viewlocation' type='submit'><a href='action2.php'>View location</a></button>";                    
                                                        }
                                                        else if($data['user_type']=='user2')
                                                        {
                                                             echo "<button type='submit'><a href='./map/map1.php'>View location</a></button>";
                                                        }
                                                                                ?>
                                                                                </form></td>
                                                                        <tr>
                                                    
                                                <?php
                                                    $sn++;}} else { ?>
                                                        <tr>
                                                        <td colspan="8">No data found</td>
                                                        </tr>
                                                    <?php } ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                    <?php  if (isset($_SESSION['user'])) : ?>
								<!-- <?php echo $_SESSION['user']['username'];?> -->
								<small>
								<a href="index.php?logout='1'" style="white"><button class="btn btn-primary">logout</button></a>
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