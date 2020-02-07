<?php
require_once("../../controllers/includes.php"); // includes database files and users etc

// IF the form was submitted
if(!empty($_POST) ) {
    $user->edit();   // make new function edit() in the user model
    header("Location: /users/"); // redirect to profile page
    exit; // stops from running anything else
}




$title = "Editing ".$current_user['username'];
require_once("../elements/header.php");
require_once("../elements/nav.php");
?>

<div class="container">
    <div class="row editProfile">
        <div class="card mt-4 w-50">
        <div class="card-header">
            <h2>Editing Profile </h2>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <img id="img-preview" class="w-100 uploadPic" src="<?=$current_user['profile_pic']?>">
                <div class="form-group custom-file mt-3">
                    <input id="file-with-preview" type="file" name="fileToUpload" class="custom-file-input">
                    <label class="custom-file-label">Upload</label>
                </div>
                <div class="form-group mt-3">
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" class="form-control" value="<?=$current_user['username']?>" required>
                </div>
                <div class="form-group mt-3">
                    <label for="firstname">First Name</label>
                    <input id="firstname" type="text" name="firstname" class="form-control" value="<?=$current_user['firstname']?>" required>
                </div>
                <div class="form-group mt-3">
                    <label for="lastname">Last Name</label>
                    <input id="lastname" type="text" name="lastname" class="form-control" value="<?=$current_user['lastname']?>" required>
                </div>
                <div class="form-group mt-3">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" class="form-control"><?=$current_user['bio']?></textarea>
                </div>
                <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input class="form-control" id="password" name="password" type="password">
                </div>
                <div class="form-group mt-3">
                    <label for="password2">Confirm Password</label>
                    <input class="form-control" id="password2" name="password2" type="password">
                </div>
                <div class="text-right mt-3 mb-3">
                    <button type="submit" class="btn block">Update</button>
                </div>
            </form>

        </div>
        </div>
    </div>
</div>











<?php
require_once("../elements/footer.php");
?>

    