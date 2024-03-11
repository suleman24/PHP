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

	<title>Medical Records</title>


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
							<h2>Medical Records</h2>
						</center>
					</th>
					<th style="width: 25%; align-items: end;"></th>
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

			<form action="dashboard.php">
<!-- 
			<div class="header__search">
                    <input name="date" type="date" placeholder="Date" class="header__input">
					<button class='btn btn-primary'>
					Search
				</button>
                </div>
				<button name='delete' style='background-color: white; margin-top:1%; margin-bottom:2%' type='submit' class='btn btn-primary'>
							<a style= 'color:white'href='dashboard.php' class='link-dark'>Reset
								<i class='fa-solid fa-pen-to-square fs-5 me-3'></i>
							</a>
						</button> -->

			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Patient</th>
						<th scope="col">Date</th>
						<th scope="col">Diagnosis</th>
						<th scope="col">Treatment</th>
						<th scope="col">Notes</th>



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

				
					$sql = "SELECT medical_record.id AS id, 
					medical_record.date AS date,
					medical_record.diagnosis AS diagnosis,
					medical_record.treatment AS treatment,
					medical_record.notes AS notes,
					medical_record.doctor_id AS doctor_id,
					doctor.fname AS doctor_fname,
					doctor.lname AS doctor_lname
					 FROM medical_record
					 INNER JOIN doctor ON medical_record.doctor_id = doctor.id 
					 INNER JOIN patient ON medical_record.patient_id = patient.id
					 WHERE patient.id = $user_id";

				


				$result = $conn->query($sql);
				$i = 0;
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
							$i = $i + 1;
							echo "<tr>
			<td>" . $i . "</td>
			<td>" . "Dr. ". ucfirst($row["doctor_fname"]) . " " . ucfirst($row["doctor_lname"]) . "</td>
			<td>" . $row["date"] . "</td>
			<td style='width: 25%;'>" . $row["diagnosis"] . "</td>
			<td style='width: 25%;'>" . $row["treatment"] . "</td>
			<td style='width: 15%;'> " . $row["notes"] . "</td>

			";

					


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

			</form>




		</section>
	</main>



</body>

</html>