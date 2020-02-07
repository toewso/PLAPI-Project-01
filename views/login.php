<?php
require_once("../controllers/includes.php"); // includes database files and users etc
$title = "Home Page";
require_once("elements/header.php");




// create a new class object of User store in var $user, when called it goes to the indcludes.php
?>


<div class="logIn">
  <div class="row">
    <div class="col-md-6 backgroundLogin">
      <img class="logowhite" src="../assests/images/Logowhite.png" width="211" height="30" >
        <div id="cjText">
          <h1>culture jamming</h1>
          <p class="cjDesc">is a tactic used to disrupt or subvert media culture and its mainstream cultural institutions to foster progressive change.</p>
        </div>
    </div>
    <div class="col-md-6 loginForm">
      <div id="signupCard" data-toggle="collapse" data-target="#signupCardBody">
        <h4 class="mb-4">Member Login</h4>
      </div>
      <div data-parent="#signupAccordian" id="signupCardBody">
        <?php echo (!empty($_SESSION["login_attempt_msg"]))? $_SESSION["login_attempt_msg"]: ''; ?>
        <form action="/users/login.php" method="post" class="formone">
          <input type="text" name="username" class="form-control mb-3" placeholder="Username or Email" required id="formControl">
          <input type="password" name="password" class="form-control mb-3" placeholder="Password" required id="formControl">
          <div class="form-group">
            <input type="checkbox" name="remember" id="remember" value="true">
            <label id="rememberMe" for="remember">Remember Me</label>
          </div>
          <div><button type="submit" class="btn block mb-3">Login</button></div>
          <div class="noAccount"><p>Don't have an account? <a href="/">Signup!</a></p></div>
        </form>
      </div>
    </div>
  </div>
</div>



    <?php
    unset($_SESSION["login_attempt_msg"]);
    unset($_SESSION["create_account_msg"]);
    ?>
  


<?php
require_once("elements/footer.php");
?>



  


  


<?php
require_once("elements/footer.php");
?>

    