<?php
require_once("../controllers/includes.php"); // includes database files and users etc

require_once("elements/header.php");




// create a new class object of User store in var $user, when called it goes to the indcludes.php
?>
<div class="signUp">
      <div class="row">
        <!--Sign Up Start-->
        <div class="col-md-6 background">
          <img class="logowhite" src="../assests/images/Logowhite.png" width="211" height="30" >
            <div id="cjText">
              <h1>culture jamming</h1>
              <p class="cjDesc">is a tactic used to disrupt or subvert media culture and its mainstream cultural institutions to foster progressive change.</p>
            </div>
        </div>
        <div class="col-md-6 signUpForm">
          <div id="signupCard" data-toggle="collapse" data-target="#signupCardBody">
            <h4 class="mb-4">Join <?=APP_NAME?></h4>
            <p>Already have an account? <a class="alreadyAccount" href="../login.php">Login</a></p>
          </div>
          <div data-parent="#signupAccordian" id="signupCardBody">
            <?php echo (!empty($_SESSION["create_account_msg"]))? $_SESSION["create_account_msg"]: ''; ?>
            <form action="/users/add.php" method="post" class="formone">
              <input type="text" class="form-control mb-4 noBorder" name="username" placeholder="Username" required>
              <input type="email" class="form-control mb-4 noBorder" name="email" placeholder="Email Address" required>
              <input type="password" class="form-control mb-4 noBorder" name="password" placeholder="Password" required>
              <input type="password" class="form-control mb-5 noBorder" name="password2" placeholder="Confirm Password" required>
           
              <h5>Profile Info</h5>
              <input type="text" class="form-control mb-4 noBorder" name="firstname" placeholder="First Name" required>
              <input type="text" class="form-control mb-4 noBorder" name="lastname" placeholder="Last Name" required>
              <label id="bioLabel" for="bio">Bio</label>
              <textarea class="form-control textArea mb-5" name="bio" id="bio" required></textarea>
              <div>
                <button type="submit" class="block mt-4 mb-4">Create Account</button>
                <p class="smallText">By clicking Sign Up, you agree to our User Agreement and Privacy Policy, and to receive our promotional emails (opt out any time).</p>
              </div>
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

    