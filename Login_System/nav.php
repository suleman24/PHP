<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="welcome.php">TASK</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="welcome.php">Home</a>
        </li>
        <?php

        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
          echo '<li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        ';
        }
        if(isset($_SESSION['loggedin'])){
          echo '<li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        ';
        }
        
        ?>
        
        
        
      </ul>

    </div>
  </div>
</nav>