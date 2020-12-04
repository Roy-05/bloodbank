<!-- Navbar Component -->
<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="index.php">
    <img src="./assets/blood-donation.svg" width="35px" height="35px">
    &nbsp;Saket's BloodBank
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"> </span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link " href="viewSamples.php">View Samples</a>
      </li>
      <?php
      session_start();
      if($_SESSION['logged_in'] && $_SESSION['user_type'] == "H"){
        echo '
        <li class="nav-item">
          <a
            class="nav-link "
            href = "dashboard.php">
            Dashboard
          </a>
        </li>';
      }

      if (!$_SESSION['logged_in']) {
        echo '
          <li class="nav-item">
            <a
              class="nav-link "
              href = "login.php">
              Login
            </a>
          </li>
          <li class="nav-item dropdown">
            <a 
              class="nav-link  dropdown-toggle" 
              href="#" 
              id="dropdownMenuLink" 
              data-toggle="dropdown">
              Register
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a 
                class="nav-link  dropdown-item" 
                href="registerHospital.php">
                As a Hospital
              </a>
              <a 
                class="nav-link  dropdown-item" 
                href="registerReceiver.php">
                As a Receiver
              </a>
            </div>
          </li>';
      } else {
        echo '
          <li class="nav-item">
            <a class="nav-link " href="logout.php">
              Logout
            </a>
          </li>';
      } ?>
    </ul>
  </div>
</nav>