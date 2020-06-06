<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if (isset($_POST['submit'])) {

  $vid = $_GET['viewid'];
  $bp = $_POST['bp'];
  $bs = $_POST['bs'];
  $weight = $_POST['weight'];
  $temp = $_POST['temp'];
  $pres = $_POST['pres'];


  $query .= mysqli_query($con, "insert   tblmedicalhistory(PatientID,BloodPressure,BloodSugar,Weight,Temperature,MedicalPres)value('$vid','$bp','$bs','$weight','$temp','$pres')");
  if ($query) {
    echo '<script>alert("Medicle history has been added.")</script>';
    echo "<script>window.location.href ='manage-patient.php'</script>";
  } else {
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Users | Medical History</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

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
      <div class="main-content">
        <hr>
        <h1 class="text-center text-primary mr-5"><b>Tusha's Personal Hospital</b> </h1>
        <br>
        <div class="container ">


          <div class="row justify-content-between">
            <div class="col-4">
              <span>
                <h3 class="inline">Dr Enam </h3>
              </span class="text-muted"><b> M.B.B.S</b>
              <p></p>
              <div class="address">
                751 Victoria 0053 street, South Statue 204
                Hometown, US 1234
              </div>
            </div>
            <div></div>
            <div class="col-3">

              <div class="address"> <span>Phone: </span> <span>+88 01551604161</span></div>
              <p></p>
              <div class="address ">FAX: (207) 808 2015 2202</div>
            </div>

          </div>
          <p class="blank-space"></p>
          <p class="divider"></p>
          <p class="blank-space"></p>

          <p class="blank-space"></p>
          <div class="row justify-content-between">
            <div class="col-4">
              <p class="ms"><b>Name :</b> <span style="border-bottom: 1px dashed #000;"> Lorem ipsum dolor, sit amet </span></p>
              <p class="ms"><b>Address :</b> <span style="border-bottom: 1px dashed #000;"> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Adipisci, voluptates.</span></p>

            </div>
            <div></div>
            <div class="col-3">
              <p class="ms"><b>Age :</b> <span style="border-bottom: 1px dashed #000;"> 25 Sharp </span></p>
              <p class="ms"><b>Date :</b> <span style="border-bottom: 1px dashed #000;">09/05/2020</span></p>

            </div>


          </div>
          <p class="blank-space"></p>

          <div class="prescription_body">
          <div class="rx">
            <span class="h1">R</span><span class="h2">x.</span>

          </div>



          </div>

          <div class="prescription_footer">
          <p class="blank-space"></p>
          <p class="divider"></p>
          <p class="blank-space"></p>
          <p class="blank-space"></p>
          <h2 class="ms text-center "><b>Doctor Signature :</b> <span style="border-bottom: 1px dashed #000;">beh</span></h2>

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
    jQuery(document).ready(function() {
      Main.init();
      FormElements.init();
    });
  </script>
  <!-- end: JavaScript Event Handlers for this page -->
  <!-- end: CLIP-TWO JAVASCRIPTS -->
</body>

</html>