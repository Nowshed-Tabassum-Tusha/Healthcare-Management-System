<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_GET['status'])) {

	if ($_GET['status'] == 'accept') {
		mysqli_query($con, "update appointment set status = 'active' where id = '" . $_GET['id'] . "'");
		$_SESSION['msg'] = "Appointment Accepted !!";
	} else if ($_GET['status'] == 'cancel') {
		mysqli_query($con, "update appointment set status = 'cancelled' where id = '" . $_GET['id'] . "'");
		$_SESSION['msg'] = "Appointment Cancelled !!";
	}
}
?>
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Patients | Appointment History</title>

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
				<div class="wrap-content" id="container">
					<!-- start: PAGE TITLE -->
					<section id="page-title">
						<div class="row">
							<div class="col-sm-8">
								<h1 class="mainTitle">Patients | Appointment History</h1>
							</div>
							<ol class="breadcrumb">
								<li>
									<span>Patients </span>
								</li>
								<li class="active">
									<span>Appointment History</span>
								</li>
							</ol>
						</div>
					</section>
					<!-- end: PAGE TITLE -->
					<!-- start: BASIC EXAMPLE -->
					<div class=" bg-white">


						<div class="row">
							<div class="col-md-12">

								<p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
									<?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
								<table class="table table-hover" id="sample-table-1">
									<thead>
										<tr>
											<th class="center">#</th>
											<th class="hidden-xs">Doctor Name</th>
											<th>Patient Name</th>
											<th>Specialization</th>
											<th>Consultancy Fee</th>
											<th>Appointment Date / Time </th>
											<th>Current Status</th>
											<th>Action</th>

										</tr>
									</thead>
									<tbody>
										<?php
										$sql = mysqli_query($con, "select doctors.doctorName as docname,users.fullName as pname,appointment.*  from appointment join doctors on doctors.id=appointment.doctorId join users on users.id=appointment.userId ");
										$cnt = 1;
										while ($row = mysqli_fetch_array($sql)) {
										?>

											<tr>
												<td class="center"><?php echo $cnt; ?>.</td>
												<td class="hidden-xs"><?php echo $row['docname']; ?></td>
												<td class="hidden-xs"><?php echo $row['pname']; ?></td>
												<td><?php echo $row['doctorSpecialization']; ?></td>
												<td><?php echo $row['consultancyFees']; ?></td>
												<td><?php echo $row['appointmentDate']; ?> / <?php echo
																									$row['appointmentTime']; ?>
												</td>
												<td><?php echo $row['status']; ?></td>
												<td>
													<a href="appointment-history.php?id=<?php echo $row['id'] ?>&status=accept" class="btn btn-transparent btn-xs tooltips <?php if ($row['status'] == 'active' || $row['status'] == 'completed' || $row['status'] == 'delivered') {
																																												echo 'hide';
																																											} ?>" title="Accept Appointment" tooltip-placement="top" tooltip="Remove">Accept</a>

													<a href="appointment-history.php?id=<?php echo $row['id'] ?>&status=cancel" onClick="return confirm('Are you sure you want to cancel this appointment ?')" class="text-danger btn btn-transparent btn-xs tooltips  <?php if ($row['status'] == 'cancelled' || $row['status'] == 'completed' || $row['status'] == 'delivered') {
																																																																			echo 'hide';
																																																																		} ?>" title="Cancel Appointment" tooltip-placement="top" tooltip="Remove">Cancel</a>
													<a href="deliver_report.php?id=<?php echo $row['id'] ?>" class="btn btn-transparent btn-xs tooltips  <?php if ($row['status'] != 'completed' || $row['status'] == 'delivered') {
																																								echo 'hide';
																																							} ?>" title="Deliver Report"><b>Deliver Report</b></a>

												</td>
											</tr>

										<?php
											$cnt = $cnt + 1;
										} ?>


									</tbody>
								</table>
							</div>
						</div>
					</div>

					<!-- end: BASIC EXAMPLE -->
					<!-- end: SELECT BOXES -->

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