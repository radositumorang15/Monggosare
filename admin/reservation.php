<?php
session_start(); 
include('../db.php');

if(!isset($_SESSION["guest"])){
    header("location: ../login.php");
}
?>
<?php
    if(isset($_POST['submit']))
    {
    $code1=$_POST['code1'];
    $code=$_POST['code'];
    if($code1!="$code"){
        $msg="Invalide code";
    }
    else{
        $email = $_POST['email'];
        $sql="SELECT * FROM roombook where email='$email'";
        $res=mysqli_query($koneksi,$sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if($email == isset($row['Email'])){
                    echo "<script type='text/javascript'> alert('User Already in Exists')</script>";
                    header("Location: reservation.php");
                }
        }
        else
        {
            $new ="Belum Konfirmasi";
            $newUser="INSERT INTO `roombook`(`Title`, `FName`, `LName`, `Email`, `National`, `Country`, `Phone`, `TRoom`, `Bed`, `NRoom`, `Meal`, `cin`, `cout`,`stat`,`nodays`) VALUES ('$_POST[title]','$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[nation]','$_POST[country]','$_POST[phone]','$_POST[troom]','$_POST[bed]','$_POST[nroom]','$_POST[meal]','$_POST[cin]','$_POST[cout]','$new',datediff('$_POST[cout]','$_POST[cin]'))";
        }

            if (mysqli_query($koneksi,$newUser))
                { 
                    echo "<script type='text/javascript'> alert('Kamar Berhasil Terpesan !')</script>";
                    header("Location: ../index.php");

                }
            else
                {
                    echo "<script type='text/javascript'> alert('Error adding user in database')</script>";

                } 
    }
}
	?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RESERVATION MONGGO SARE HOTEL</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a href="../index.php"><i class="fa fa-home"></i> Homepage</a>
                    </li>

                </ul>

            </div>

        </nav>

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            RESERVATION <small></small>
                        </h1>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-5 col-sm-5">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                PERSONAL INFORMATION
                            </div>
                            <div class="panel-body">
                                <form name="form" method="post">
                                    <div class="form-group">
                                        <label>Title*</label>
                                        <select name="title" class="form-control" required>
                                            <option value selected></option>
                                            <option value="Dr.">Pak.</option>
                                            <option value="Miss.">Bu.</option>
                                            <option value="Mr.">Kak.</option>
                                            <option value="Mrs.">Tn.</option>
                                            <option value="Prof.">Ny.</option>
                                            <option value="Rev .">Deck .</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Depan</label>
                                        <input name="fname" class="form-control" required>

                                    </div>
                                    <div class="form-group">
                                        <label>Nama Belakang</label>
                                        <input name="lname" class="form-control" required>

                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" type="email" class="form-control" required>

                                    </div>
                                    <div class="form-group">
                                        <label>Kenegaraan</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="nation" value="NPLE" checked="">WNI
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="nation" value="Non NPLE ">WNA
                                        </label>

                                    </div>
                                    <?php

								$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

								?>
                                    <div class="form-group">
                                        <label>Passport</label>
                                        <select name="country" class="form-control" required>
                                            <option value selected></option>
                                            <?php
												foreach($countries as $key => $value):
												echo '<option value="'.$value.'">'.$value.'</option>'; //close your tags!!
												endforeach;
												?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor HP</label>
                                        <input name="phone" type="text" class="form-control" required>

                                    </div>

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    RESERVATION INFORMATION
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Tipe Kamar</label>
                                        <select name="troom" class="form-control" required>
                                            <option value selected></option>
                                            <option value="Superior Room">SUPERIOR ROOM</option>
                                            <option value="Deluxe Room">DELUXE ROOM</option>
                                            <option value="Guest House">GUEST HOUSE</option>
                                            <option value="Single Room">SINGLE ROOM</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tipe Kasur</label>
                                        <select name="bed" class="form-control" required>
                                            <option value selected></option>
                                            <option value="Single">Single</option>
                                            <option value="Double">Double</option>
                                            <option value="Triple">Triple</option>
                                            <option value="Quad">Quad</option>
                                            <option value="None">None</option>


                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Kamar</label>
                                        <select name="nroom" class="form-control" required>
                                            <option value selected></option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label>Rencana Makan</label>
                                        <select name="meal" class="form-control" required>
                                            <option value selected></option>
                                            <option value="Room only">Room only</option>
                                            <option value="Breakfast">Breakfast</option>
                                            <option value="Half Board">Half Board</option>
                                            <option value="Full Board">Full Board</option>



                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Check-In</label>
                                        <input name="cin" type="date" class="form-control">

                                    </div>
                                    <div class="form-group">
                                        <label>Check-Out</label>
                                        <input name="cout" type="date" class="form-control">

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 col-sm-12">
                            <div class="well">
                                <h4>HUMAN VERIFICATION</h4>
                                <p>Type Below this code <?php $Random_code=rand();?><br> 
                                <h1><?php echo$Random_code; ?> <h1> </p><br>
                                <p>Enter the random code<br /></p>
                                <input type="text" name="code1" title="random code" />
                                <input type="hidden" name="code" value="<?php echo $Random_code; ?>" />
                                <input type="submit" name="submit" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /. PAGE INNER  -->
                </div>
                <!-- /. PAGE WRAPPER  -->
            </div>
            <!-- /. WRAPPER  -->
            <!-- JS Scripts-->
            <!-- Latest minified bootstrap css -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

            <!-- Latest minified bootstrap js -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <!-- jQuery Js -->
            <script src="assets/js/jquery-1.10.2.js"></script>
            <!-- Bootstrap Js -->
            <script src="assets/js/bootstrap.min.js"></script>
            <!-- Metis Menu Js -->
            <script src="assets/js/jquery.metisMenu.js"></script>
            <!-- Custom Js -->
            <script src="assets/js/custom-scripts.js"></script>


</body>

</html>