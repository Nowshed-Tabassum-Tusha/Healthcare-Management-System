<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (!isset($_GET['id'])) {
    header('location:appointment-history.php');
}
if (isset($_POST['submit'])) {

    $Apointment_Id = $_POST['appointment_id'];
    $Blood = isset($_POST['Blood']) ? $_POST['Blood'] : NULL;
    $Urine = isset($_POST['Urine']) ? $_POST['Urine'] : NULL;
    $Pressure = isset($_POST['Pressure']) ? $_POST['Pressure'] : NULL;
    $Weight = isset($_POST['Weight']) ? $_POST['Weight'] : NULL;
    $Ultrasonography = isset($_POST['Ultrasonography']) ? $_POST['Ultrasonography'] : NULL;
    $MRI = isset($_POST['MRI']) ? $_POST['MRI'] : NULL;
    $Temperature = isset($_POST['Temperature']) ? $_POST['Temperature'] : NULL;
    $Cost = isset($_POST['Cost']) ? $_POST['Cost'] : NULL;

    $query = mysqli_query($con, "INSERT into report(prescription_id,Blood,Urine,Pressure,Weight,Ultrasonography,MRI,Temperature,Cost) values('$Apointment_Id','$Blood','$Urine','$Pressure','$Weight','$Ultrasonography','$MRI','$Temperature','$Cost')");
    if ($query) {
        mysqli_query($con, "UPDATE appointment set status = 'delivered' where id = '$Apointment_Id'");
        $appointment = mysqli_query($con, "SELECT * from  appointment  where id = '$Apointment_Id'");
        $data = mysqli_fetch_assoc($appointment);
        $user_id = $data['userId'];
        echo $user_id;
        mysqli_query($con, "UPDATE users set total_due = total_due + '$Cost' where id = '$user_id'");
        header('location:appointment-history.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Deliver Reports</title>

    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
</head>

<body>
    <div id="app">
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">


            <?php include('include/header.php'); ?>
            <!-- end: TOP NAVBAR -->
            <div class="main-content">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Deliver Report</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li>
                                <span>Admin </span>
                            </li>
                            <li class="active">
                                <span>Deliver Report</span>
                            </li>
                        </ol>
                    </div>
                </section>
                <section class="container">
                    <p style="color:red;"><?php echo htmlentities($_SESSION['msg1']); ?>
                        <?php echo htmlentities($_SESSION['msg1'] = ""); ?></p>
                    <form method="post">
                        <?php
                        $uid = $GET['id'];
                        $sql = mysqli_query($con, "SELECT *  from prescription where appointment_id = '" . $_GET['id'] . "'");
                        $cnt = 1;
                        $row = mysqli_fetch_assoc($sql);
                        $tests = explode(",", $row['tests']);
                        for ($x = 0; $x < sizeof($tests); $x++) {
                            $test = $tests[$x];
                        ?>
                            <fieldset>
                                <legend><?php echo $test; ?></legend>
                                <input type="text" name="<?php echo $test; ?>" placeholder="Enter Value.." required>
                            </fieldset>

                        <?php }
                        ?>
                        <input name="appointment_id" value="<?php echo $_GET['id'] ?>" hidden>
                        <fieldset>
                            <legend>Cost (in BDT)</legend>
                            <input type="number" name="Cost" placeholder="Enter cost.." required>
                        </fieldset>
                        <button name="submit" class="btn btn-primary float-right" type="submit"> Sumbit Report</button>
                    </form>




                </section>


            </div>
        </div>
        <!-- start: FOOTER -->
        <?php include('include/footer.php'); ?>
        <!-- end: FOOTER -->

        <!-- start: SETTINGS -->
        <?php include('include/setting.php'); ?>

        <!-- end: SETTINGS -->
    </div>
    <!-- start: MAIN JAVASCRIPTS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <!-- end: MAIN JAVASCRIPTS -->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
    <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="vendor/autosize/autosize.min.js"></script>
    <script src="vendor/selectFx/classie.js"></script>
    <script src="vendor/selectFx/selectFx.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <!-- start: CLIP-TWO JAVASCRIPTS -->
    <script src="assets/js/main.js"></script>
    <!-- start: JavaScript Event Handlers for this page -->
    <script src="assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });
    </script>
    <!-- end: JavaScript Event Handlers for this page -->
    <!-- end: CLIP-TWO JAVASCRIPTS -->
</body>

</html>