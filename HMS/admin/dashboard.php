<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: ../index.php");
    exit;
}
else
{
	$username =  $_SESSION['username'];
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

<link rel="stylesheet" href="assets/css/styles.css">
<link rel="stylesheet" href="assets/css/main.css">

	<title>Admin  | Dashboard</title>
		

	</head>
	<body>


    <?php

include 'include/sidebar.php';

?>
 <main>
        <section>
		<div class="container">
		<div class="card" >
            <div class="circle" onclick="window.location.href='doctors.php'">
                <h2>Doctors</h2>
            </div>
            <div class="content" style="color: #ffaf00;">
				<?php
				include '../db.php';
				$sql = "SELECT status from doctor";
				$result = $conn->query($sql);

                if ($result->num_rows > 0){
					$available = 0;
					$pending = 0;
					while ($row = $result->fetch_assoc()) {
						if($row['status']==0)
						{
							$pending = $pending+1;
						}
						else{
							$available = $available+1;
						}
					}
					echo "Available Doctors: " . $available;
					echo "<br>";
					echo "Pending Requests: " . $pending;

				}
				?>
             </div>
        </div>
		<div class="card" >
            <div class="circle" onclick="window.location.href='patients.php'">
                <h2>Patients</h2>
            </div>
			<div class="content" style="color: #da2268;">
				<?php
				include '../db.php';
				$sql = "SELECT id from patient";
				$result = $conn->query($sql);
				$num_rows = $result->num_rows;

				echo "Total Patients: " . $num_rows;
				?>
             </div>
 
        </div>
        <div class="card">
		<div class="circle" onclick="window.location.href='medical_records.php'">
                <h2>Medical Records</h2>
            </div>
			<div class="content" style="color: #bb02ff;">
				<?php
				include '../db.php';
				$sql = "SELECT id from medical_record";
				$result = $conn->query($sql);
				$num_rows = $result->num_rows;

				echo "Total Records: " . $num_rows;
				?>
             </div>
        </div>
		<div class="card">
		<div class="circle" onclick="window.location.href='earnings.php'">
                <h2>Earnings</h2>
            </div>
			<div class="content" style="color: #1ecc98;">
				<?php
				include '../db.php';
				$sql = "SELECT fee from medical_record";
				$result = $conn->query($sql);
				if ($result->num_rows > 0){
					$earning = 0;
					while ($row = $result->fetch_assoc()) {
						$earning = $row['fee'] + $earning;
					}
					$earning = $earning - $earning * 0.1;

					echo "Total Earning: Rs " . $earning;
					

				}

				?>
             </div>
        </div>
		<div class="card">
		<div class="circle" onclick="window.location.href='employee.php'">
                <h2>Employees</h2>
            </div>
			<div class="content" style="color: #3c2f75;">
			<?php
				include '../db.php';
				$sql = "SELECT id from employee";
				$result = $conn->query($sql);
				$num_rows = $result->num_rows;

				echo "Total Employees: " . $num_rows;
				?>
			</div>
        </div>

		<div class="card">
		<div class="circle" onclick="window.location.href='inventory.php'">
                <h2>Inventory</h2>
            </div>
			<div class="content" style="color: #ff72a8;">
				<?php
				include '../db.php';
				$sql = "SELECT quantity FROM inventory WHERE quantity = 0";
				$result = $conn->query($sql);
				if ($result->num_rows > 0){
					$out = 0;
					while ($row = $result->fetch_assoc()) {
						if($row['quantity']==0)
						{
							$out = $out +1;
						}
					}
					echo "Items out of stock: " . $out;
				}
				?>
             </div>
        </div>

	
    </div> 
		</section>
 </main>
		
	</body>
</html>
