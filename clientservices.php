<?php  
session_start();  
if(!isset($_SESSION["guest"]))
{
 header("location:index.php");
}

include ('db.php');
$sql = "select * from roombook";
$re = mysqli_query($koneksi,$sql);
$c =0;
while($row=mysqli_fetch_array($re) )
{
        $new = $row['stat'];
        $cin = $row['cin'];
        $id = $row['id'];
        if($new=="Belum Konfirmasi")
        {
            $c = $c + 1;
            
        }
}	

								
$rsql = "SELECT * FROM `roombook`";
$rre = mysqli_query($koneksi,$rsql);
$r =0;
while($row=mysqli_fetch_array($rre) )
{		
        $br = $row['stat'];
        if($br=="Conform")
        {
            $r = $r + 1;
            
            
            
        }						
}

$msql = "SELECT * FROM `roombook`";
$mre = mysqli_query($koneksi,$msql);

while($mrow=mysqli_fetch_array($mre) )
{		
    $br = $mrow['stat'];
    if($br=="Conform")
    {
        $fid = $mrow['id'];
            
    echo"<div class='col-md-3 col-sm-12 col-xs-12'>
            <div class='panel panel-primary text-center no-boder bg-color-blue'>
                <div class='panel-body'>
                    <i class='fa fa-users fa-5x'></i>
                    <h3>".$mrow['FName']."</h3>
                </div>
                <div class='panel-footer back-footer-blue'>
                <a href=show.php?sid=".$fid ."><button  class='btn btn-primary btn' data-toggle='modal' data-target='#myModal'>
            Show
            </button></a>
                    ".$mrow['TRoom']."
                </div>
            </div>	
    </div>";		
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MONGGO SARE HOTEL</title>
	<link rel="shortcut icon" href="admin/assets/img/monggo.png">
    <!-- Bootstrap Styles-->
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->

    <!-- Custom Styles-->
    <link href="admin/assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- TABLE STYLES-->
    <link href="admin/assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>

<body>
    <div id="wrapper" width="10%">
        <nav class="navbar navbar-default top-navbar" role="navigation" height="50%">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"> <?php echo $_SESSION["guest"]; ?> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="usersetting.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a href="index.php"><i class="fa fa-dashboard"></i> Status</a>
                    </li>




            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Payment Details<small> </small>
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->


                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Country</th>
                                                <th>Room</th>
                                                <th>Bedding</th>
                                                <th>Meal</th>
                                                <th>Check In</th>
                                                <th>Check Out</th>
                                                <th>Status</th>
                                                <th>More</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $guest = $_SESSION['guest'];
                                            echo $guest;
                                            echo $_SESSION['guest'];
                                        $tsql = "SELECT * FROM roombook WHERE FName = '$guest'";
                                        $tre = mysqli_query($koneksi,$tsql);
                                        while($trow=mysqli_fetch_array($tre) )
                                        {	
                                            $co =$trow['stat']; 
                                            if($co=="Belum Konfirmasi")
                                            {
                                                echo"<tr>
                                                    <th>".$trow['FName']." ".$trow['LName']."</th>
                                                    <th>".$trow['Email']."</th>
                                                    <th>".$trow['Country']."</th>
                                                    <th>".$trow['TRoom']."</th>
                                                    <th>".$trow['Bed']."</th>
                                                    <th>".$trow['Meal']."</th>
                                                    <th>".$trow['cin']."</th>
                                                    <th>".$trow['cout']."</th>
                                                    <th>".$trow['stat']."</th>
                                                    
                                                    <th><a href='checkin.php?rid=".$trow['id']." ' class='btn btn-success'>Check In Online</a></th>
                                                    </tr>";
                                            }	
                                        
                                        }
                                        ?>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                    <form action="" method="POST">
                        <input type="submit" name="delete" value="Batalkan Pesanan" class="btn btn-danger">
                    </form>
                    <?php
                    if(isset($_POST['delete']))
                    {
                        include_once 'db.php';
                        $guest = $_SESSION['guest'];
                        $hsql = "DELETE FROM roombook WHERE FName = '$guest'";
                        if (mysqli_query($koneksi, $hsql)) {
                            echo "<script type='text/javascript'> alert('Data telah berhasil dihapus !')</script>";
                            header("Location: clientservices.php");
                        } else {
                            echo "<script type='text/javascript'> alert('Data gagal dihapus ')</script>" . mysqli_error($koneksi);
                        }
                        mysqli_close($koneksi);
                    }
                    ?>
                </div>
            </div>
            <!-- /. ROW  -->

        </div>

    </div>


    </div>
    <!-- /. PAGE INNER  -->
    </div>
    <div class="container mt-3">


        <!-- /. PAGE WRAPPER  -->
        <!-- /. WRAPPER  -->
        <!-- JS Scripts-->
        <!-- jQuery Js -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- Bootstrap Js -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- Metis Menu Js -->
        <script src="assets/js/jquery.metisMenu.js"></script>
        <!-- DATA TABLE SCRIPTS -->
        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
        </script>
        <!-- Custom Js -->
        <script src="assets/js/custom-scripts.js"></script>



</body>

</html>