<!-- Navbar Component -->
        <nav class="navbar navbar-expand-lg navbar-light">
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#collapsibleNavbar"
            aria-controls="collapsibleNavbar"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"> </span>
          </button>

          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
              <li class="nav-item">
                <a
                  class="nav-link text-dark"
                  href = "index.php"
                  >Home</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-dark"
                  href = "viewSamples.php"
                  >View Samples</a
                >
              </li>
             
                    <li class="nav-item">
                      <a
                        class="nav-link text-dark"
                        href = "login.php"
                        >Login</a
                      >
                    </li>
                    <li class="nav-item dropdown">
                      <a 
                        class="nav-link text-dark dropdown-toggle" 
                        href="#" 
                        id="dropdownMenuLink" 
                        data-toggle="dropdown" 
                        >Register</a>
                      <div class="dropdown-menu">
                        <a 
                          class="nav-link text-dark dropdown-item" 
                          href="registerHospital.php"
                        >As a Hospital</a>
                        <a 
                          class="nav-link text-dark dropdown-item" 
                          href="registerReceiver.php"
                        >As a Receiver</a>
                      </div>
                    </li>
               <li class="nav-item">
                            <a class="nav-link text-dark" href="logout.php">
                            Logout
                            </a>
                          </li>
                
              
            </ul>
          </div>
        </nav>