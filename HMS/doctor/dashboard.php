<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: ../index.php");
	exit;
} else {
	$username =  $_SESSION['username'];
}



if (isset($_POST["accept"])) {

	$id = $_GET["id"];
	$sql = "UPDATE appointments SET status=? WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("si", 'accepted', $id);
	$result = $stmt->execute();
	$stmt->close();

	if ($result) {
		header("Location: dashboard.php?msg=Accepted");
		exit;
	} else {
		echo "Failed to update: " . $conn->error;
	}
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

	<link rel="stylesheet" href="assets/css/styles.css">

	<title>Doctor | Dashboard</title>


</head>

<body>


	<?php

	include 'include/sidebar.php';

	?>


	<main>
		<section>

			<table style="width: 100%;">
				<tr>
					<th style="width: 25%;"></th>
					<th style="width: 50%;">
						<center>
							<h2>Appointments</h2>
						</center>
					</th>
					<th style="width: 25%; align-items: end;"></th>
				</tr>


			</table>
			<hr>

			<?php
			if (isset($POST["msg"])) {
				$msg = $POST["msg"];
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
			}
			if (isset($_GET["msg"])) {
				$msg = $_GET["msg"];
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
			}
			?>

			<form action="dashboard.php" method="POST">

				<div class="header__search">
					<input name="date" type="date" placeholder="Date" class="header__input">
					<button class='btn btn-primary'>
						Search
					</button>
				</div>
				<button name='delete' style='background-color: white; margin-top:1%; margin-bottom:2%' type='submit' class='btn btn-primary'>
					<a style='color:white' href='dashboard.php' class='link-dark'>Reset
						<i class='fa-solid fa-pen-to-square fs-5 me-3'></i>
					</a>
				</button>

				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Patient</th>
							<th scope="col">Date</th>
							<th scope="col">Time</th>
							<th scope="col">Status</th>
							<th scope="col">Fee</th>
							<th scope="col">Request</th>
							<th scope="col"></th>

							<th scope="col"></th>


						</tr>
					</thead>

					<?php
					include '../db.php';

					$username = $_SESSION['username'];
					$user_id = 0;
					$sql = "Select * from doctor where username='$username'";
					$result = mysqli_query($conn, $sql);
					$num = mysqli_num_rows($result);
					if ($num == 1) {
						while ($row = mysqli_fetch_assoc($result)) {
							$user_id = $row['id'];
						}
					}

					if (isset($_GET['date']) && $_GET['date'] != '') {
						$d = $_GET['date'];
						$sql = "SELECT appointments.appointment_id, 
               appointments.appointment_date, 
               appointments.appointment_time,
			   appointments.status,
			   appointments.fee,
			   appointments.fee_status,
               appointments.patient_id AS patient_id,
               patient.fname AS patient_fname,
               patient.lname AS patient_lname
				FROM appointments
				INNER JOIN patient ON appointments.patient_id = patient.id 
				INNER JOIN doctor ON appointments.doctor_id = doctor.id
				WHERE doctor.id = $user_id AND appointments.appointment_date ='$d'";
					} else {
						$sql = "SELECT appointments.appointment_id, 
					appointments.appointment_date, 
					appointments.appointment_time,
					appointments.status,
					appointments.fee,
					appointments.fee_status,
					appointments.patient_id AS patient_id,
					patient.fname AS patient_fname,
					patient.lname AS patient_lname
					 FROM appointments
					 INNER JOIN patient ON appointments.patient_id = patient.id 
					 INNER JOIN doctor ON appointments.doctor_id = doctor.id
					 WHERE doctor.id = $user_id";
					}




					$result = $conn->query($sql);
					$i = 0;
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							if ($row["status"] != 'deleted') {
								if($row["status"] != 'checked'){
									{
										$i = $i + 1;
										$name = ucfirst($row["patient_fname"]) . " " . ucfirst($row["patient_lname"]);
										echo "<tr>
					<td>" . $i . "</td>
					<td>" .  ucfirst($row["patient_fname"]) . " " . ucfirst($row["patient_lname"]) . "</td>
					<td>" . $row["appointment_date"] . "</td>
					<td>" . $row["appointment_time"] . "</td>
					<td>" . ucfirst($row["status"]) . "</td>";

					if ($row["fee_status"] == 'paid') {
						echo "<td><button name='checkup' style='background-color: white; color: red;' type='submit' class='btn btn-primary'>
				<a style= 'color:white'href='include/fee_confirm.php?appointment_id=" . $row["appointment_id"] .
							  "' class='link-dark'>Confirm
					<i class='fa-solid fa-pen-to-square fs-5 me-3'></i>
				</a>
			</button></td>";
					}
					else if ($row["fee_status"] == 'unpaid') {
						echo "<td>Unpaid</td>";
					}
					else if ($row["fee_status"] == 'confirmed') {
						echo "<td>Confirmed</td>";
					}
		
										if ($row['status'] == 'request') {
											echo "<td><button name='accept' style='background-color: white; color: red;' type='submit' class='btn btn-primary'>
										<a style= 'color:white'href='request/accept.php?id=" . $row["appointment_id"] . "' class='link-dark'>Accept
											<i class='fa-solid fa-pen-to-square fs-5 me-3'></i>
										</a>
									</button></td>";
										} else {
											echo "<td></td>";
										}
										echo "<td><button name='delete' style='background-color: white; color: red;' type='submit' class='btn btn-primary'>
									<a style= 'color:white'href='request/delete.php?id=" . $row["appointment_id"] . "' class='link-dark'>Delete
										<i class='fa-solid fa-pen-to-square fs-5 me-3'></i>
									</a>
								</button></td>";
		
										if ($row["status"] == 'accepted') {
											echo "<td><button name='checkup' style='background-color: white; color: red;' type='submit' class='btn btn-primary'>
									<a style= 'color:white'href='add_medical_record.php?appointment_id=" . $row["appointment_id"] .
												"&patient_id=" . $row["patient_id"] .
												"&patient_name=" . $name . "&doctor_id=" . $user_id . 
												"&fee=" . $row["fee"] .
												"' class='link-dark'>Check up
										<i class='fa-solid fa-pen-to-square fs-5 me-3'></i>
									</a>
								</button></td>";
										}
		
		
		
										echo "</tr>";
									}
								}
							}
						}

						echo "</table>";
					} else {
						echo "0 results";
					}

					$conn->close();

					?>



					</tbody>
				</table>

			</form>




		</section>
	</main>



</body>

</html>