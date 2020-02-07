    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand col-md-2" href="/index.php">
            <img src="/assests/images/logo.png" width="211" height="30" alt="">
        </a>
        <?php
        // if user is logged in (session is NOT empty)
        if(!empty($_SESSION['user_logged_in'])) {
        ?>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNavBar"> 
            <i class="fas fa-hamburger"></i>
        </button>

        <div class="navbar-collapse collapse navbar-nav row" id="mainNavBar">
            <div class="links">
                <a class="col-md-2" href="/views/index.php">Current Projects</a>
                
            </div>
            <form class="form-inline col-md-6" id="search_form">
                <input type="search" autocomplete="off" name="search" id="search" class="form-control" placeholder="Search..."> 
            </form>
            <div class="dropdown col-md">
                <a class="nav-link dropdown-toggle" id="accountDropdown" data-toggle="dropdown" >Welcome <?=$current_user['firstname']?></a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/users/index.php">My Profile</a>
                    <a class="dropdown-item" href="/users/logout.php">Logout</a>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </nav>





