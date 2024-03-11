


     <header class="header">
            <div class="header__container">

                <a href="dashboard.php" class="header__logo">HMS</a>
    
             
            </div>
        </header>

        <div class="nav" id="navbar">
            <nav class="nav__container">
                <div>
                    <a href="#" class="nav__link nav__logo">
                        <i class='bx bxs-disc nav__icon' ></i>

                        <?php
                        $username =  $_SESSION['username'];
                        echo $username;
            ?>

            
                    </a>
    
                    <div class="nav__list">
                    
                            <a href="doctors.php" class="nav__link">
                                <span class="nav__name">Doctors</span>
                            </a>
                            <a href="patients.php" class="nav__link">
                                <span class="nav__name">Patients</span>
                            </a>
                            <a href="medical_records.php" class="nav__link">
                                <span class="nav__name">Medical Records</span>
                            </a>
                            <a href="earning.php" class="nav__link">
                                <span class="nav__name">Earnings</span>
                            </a>
                            <a href="employee.php" class="nav__link">
                                <span class="nav__name">Employees</span>
                            </a>
                            <a href="inventory.php" class="nav__link">
                                <span class="nav__name">Inventory</span>
                            </a>
                        </div>
                    </div>

            

                <a href="logout.php" class="nav__link nav__logout">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>



       
        <script src="assets/js/main.js"></script>

