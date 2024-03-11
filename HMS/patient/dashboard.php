<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: ../index.php");
	exit;
} else {
	$username =  $_SESSION['username'];
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

	<title>Patient | Dashboard</title>


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
					<th style="width: 25%; align-items: end;"><button type="submit" class="btn btn-primary" style="margin-top: 30px; width: 40%">
							<a style="color: white;" href="bookappointment.php">Book Appointment</a></button></th>
				</tr>


			</table>
			<hr>

			<?php
			if (isset($_GET["msg"])) {
				$msg = $_GET["msg"];
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
			}
			?>

			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Doctor</th>
						<th scope="col">Date</th>
						<th scope="col">Time</th>
						<th scope="col">Status</th>
						<th scope="col">Fee Status</th>


					</tr>
				</thead>

				<?php
				include '../db.php';

				$username = $_SESSION['username'];
				$user_id = 0;
				$sql = "Select * from patient where username='$username'";
				$result = mysqli_query($conn, $sql);
				$num = mysqli_num_rows($result);
				if ($num == 1) {
					while ($row = mysqli_fetch_assoc($result)) {
						$user_id = $row['id'];
					}
				}



				$sql = "SELECT appointments.appointment_id, 
               appointments.appointment_date, 
               appointments.appointment_time,
			   appointments.status,
			   appointments.fee_status,
               appointments.doctor_id AS doctor_id,
               doctor.fname AS doctor_fname,
               doctor.lname AS doctor_lname
        FROM appointments
        INNER JOIN doctor ON appointments.doctor_id = doctor.id 
        INNER JOIN patient ON appointments.patient_id = patient.id
        WHERE patient.id = $user_id";


				$result = $conn->query($sql);
				$i = 0;
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$i = $i + 1;
						echo "<tr>
    <td>" . $i . "</td>
    <td>Dr. " . ucfirst($row["doctor_fname"]) . " " . ucfirst($row["doctor_lname"]) . "</td>
    <td>" . $row["appointment_date"] . "</td>
    <td>" . $row["appointment_time"] . "</td>
    <td>" . ucfirst($row["status"]) . "</td>";

	if($row["status"]!='deleted')
	{

		if ($row['fee_status'] == 'paid') {
			echo "<td><button name='fee' style='background-color: white; color: red;' type='submit' class='btn btn-primary'>
			Notified
</button></td>";
		}
		else if ($row['fee_status'] == 'confirmed') {
			echo "<td><button name='fee' style='background-color: white; color: red;' type='submit' class='btn btn-primary'>
			Confirmed
</button></td>";
	}

		else if ($row['fee_status'] != 'paid' || $row['fee_status'] != 'confirmed') {
			echo "<td><button name='fee' style='background-color: white; color: red;' type='submit' class='btn btn-primary'>
<a style= 'color:white'href='include/fee_pay.php?id=" . $row["appointment_id"] . "' class='link-dark'>Notify Fee Paid
<i class='fa-solid fa-pen-to-square fs-5 me-3'></i>
</a>
</button></td>";
		}
		
						
						}

						echo "</tr>";
					}

					echo "</table>";
				} else {
					echo "0 results";
				}

				$conn->close();

				?>



				</tbody>
			</table>





		</section>
	</main>



</body>

</html>