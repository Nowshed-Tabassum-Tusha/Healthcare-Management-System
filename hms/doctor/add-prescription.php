<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    $docid = $_SESSION['id'];
    $prescription_body = $_POST['prescription_body'];
    $appointment_id = $_POST['id'];
    $patient_id = $_POST['patient_id'];
    $fees = $_POST['consultancyFees'];
    $tests = join(",", $_POST['tests']);
    $bal =  $_POST['tests'];
    echo $bal;
    $sql = mysqli_query($con, "insert into prescription(prescription_body,tests,appointment_id,doctor_id,patient_id) values('$prescription_body','$tests','$appointment_id','$docid','$patient_id')");
    mysqli_query($con, "UPDATE appointment set status = 'completed' where id = '$appointment_id'");
    mysqli_query($con, "UPDATE users set total_due = total_due + '$fees' where id = '$patient_id'");


    if ($sql) {
        echo "<script>alert('Patient info added Successfully');</script>";
        header('location:add-prescription.php');
    }else {
        echo `console.log(error happended)`;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor | Add Patient</title>

    <link
        href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
        rel="stylesheet" type="text/css" />
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

    <script>
    function userAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'email=' + $("#patemail").val(),
            type: "POST",
            success: function(data) {
                $("#user-availability-status1").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {}
        });
    }
    </script>
</head>

<body>
    <div id="app">
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">
            <?php include('include/header.php'); ?>

            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Patient | Add Prescription</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Patient</span>
                                </li>
                                <li class="active">
                                    <span>Add Prescription</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-body">
                                                <form role="form" name="" method="post">
                                                    <div class="form-group">
                                                        <label for="doctorname">
                                                            Select Appoinment
                                                        </label><select id="appointment_select" class="form-control"
                                                            name="id">
                                                            <option value="" selected>--Select Appointment--</option>
                                                            <?php
                                                            $sql = mysqli_query($con, "select users.fullName as fname,appointment.*  from appointment join users on users.id=appointment.userId where appointment.doctorId='" . $_SESSION['id'] . "'");
                                                            $cnt = 1;
                                                            while ($row = mysqli_fetch_array($sql)) {
                                                                if($row['status']!='active'){
                                                                    continue;
                                                                }


                                                            ?>
                                                            <option value="<?php echo $row['id']; ?>"
                                                                data="<?php echo $row['patient_problem']; ?>"
                                                                patient-id="<?php echo $row['userId']; ?>" consultancyFees=<?php echo $row['consultancyFees']; ?>>
                                                                <?php echo $row['fname']; ?> |
                                                                <?php echo $row['appointmentDate'] . ' ' . $row['appointmentTime']; ?>

                                                            </option> <?php } ?>
                                                        </select> </div>
                                                    <div class=" form-group">
                                                        <fieldset>
                                                            <legend>Patient Problems</legend>
                                                            <p id="patient_problem"></p>
                                                        </fieldset>
                                                    </div>
                                                   

                                                    <div class="form-group">
                                                        <label for="fess">
                                                            Prescription Body
                                                        </label>
                                                        <textarea type="text" name="prescription_body"
                                                            class="form-control" placeholder="Write prescription here"
                                                            required="true" rows="7"></textarea>
                                                    </div>
                                                    <input id="fees" type="text" hidden name="consultancyFees" >
                                                    <div class="form-group">
                                                        <fieldset>
                                                            <legend>Add Tests</legend>

                                                            <input class="form-check-input" type="checkbox"
                                                                value="Blood" name="tests[]">
                                                            Blood

                                                            <input class="form-check-input" type="checkbox"
                                                                value="Urine" name="tests[]">
                                                            Urine

                                                            <input class="form-check-input" type="checkbox"
                                                                value="Pressure" name="tests[]">
                                                            Pressure

                                                            <input class="form-check-input" type="checkbox"
                                                                value="Temperature" name="tests[]">
                                                            Temperature

                                                            <input class="form-check-input" type="checkbox"
                                                                value="Weight" name="tests[]">
                                                            Weight

                                                            <input class="form-check-input" type="checkbox"
                                                                value="MRI" name="tests[]">
                                                            MRI
                                                            <input class="form-check-input" type="checkbox"
                                                                value="Ultrasonography" name="tests[]">
                                                                Ultrasonography


                                                        </fieldset>
                                                    </div>

                                                    <input id="pid" type="text" name="patient_id" value="<?php echo $row['userId']; ?>" hidden>
                                                    <button type="submit" name="submit" id="submit"
                                                        class="btn btn-o btn-primary block">
                                                        Confirm Submit
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-white">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    $('#appointment_select').change(function() {
        $('#patient_problem').text($(this).find(':selected').attr('data'))
        $('#pid').val($(this).find(':selected').attr('patient-id'))
        $('#fees').val($(this).find(':selected').attr('consultancyFees'))

    });
    jQuery(document).ready(function() {

        Main.init();
        FormElements.init();
    });
    </script>
    <!-- end: JavaScript Event Handlers for this page -->
    <!-- end: CLIP-TWO JAVASCRIPTS -->
</body>

</html>