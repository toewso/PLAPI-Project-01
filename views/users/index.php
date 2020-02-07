<?php
require_once("../../controllers/includes.php"); // includes database files and users etc
$title = "My Profile";
require_once("../elements/header.php");
require_once("../elements/nav.php");



// Check if the id is set
// if it is, get the user by id and pass data
// else load current user
if( !empty($_GET['id'])) {
    $user_id = $_GET['id'];
    $u_model = new User;
    $selected_user = $u_model->get_by_id($user_id);
} else {
    $selected_user = $current_user;
}

?>
<div class="container profileCont">
    <div class="row profileRow">
      <div class="col-md-8 profileCol">
        <div class="infoLeft">
        <img src="<?=$selected_user['profile_pic']?>" class="shapePic mb-4">

              <?php
              if($selected_user['id'] == $_SESSION['user_logged_in']) {
                ?>
                <p>
                    <a href="/users/edit.php" class="btn block2 mb-3">Edit Profile</a>
                    <a href="../projects/add.php" class="btn block2">Add Project</a>
                </p>
                <?php
                }
                ?>
        </div>
                <div class="infoRight">
                 <h4 class="proName"><?=$selected_user['firstname']. " ". $selected_user['lastname'];?></h4>
                  <div class="profileIcons">
                  <i class="fab fa-twitter"></i>
                  <i class="fab fa-instagram"></i>
                  <i class="fab fa-facebook"></i>
                </div>
                </div>
      </div> 
       
         
        
    </div>
      
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">My Work</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Bio</a>
      </li>
      
    </ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  <div class="row tabcontent" id="firstTab">
    <div class="card-columns">
        <?php
        // get all projects by this user
        $p_model = new Project;
        $user_projects = $p_model->get_by_user_id($selected_user['id']);
        foreach($user_projects as $user_project) {
        ?>
            <div class="card mt-3 project-post mr-2 ml-2">
              <div lass="card-img project-body">
              <div class="some_image">
                  <img class="img-fluid project" src="<?=$user_project['file_url'] ?>">
              </div>
              </div>
              <div class="card-body">
              <small class="text-muted">Posted <?=date("M d, Y", strtotime($user_project['date_uploaded']))?></small>
                   <?php
                  // if the project an d user_id is = to current user
                  if($user_project['user_id'] == $_SESSION['user_logged_in']){
                    ?>
                    <span class="float-right">
                      <a href="/projects/edit.php?id=<?=$user_project['id']?>"><i class="fas fa-edit"></i></a>
                      <a href="/projects/delete.php?id=<?=$user_project['id']?>"><i class="fas fa-trash"></i></a>
                    </span>
                    <?php
                  }
                    ?>
                      <h4 id="title"><?=$user_project['title']?></h4>
                      <p class="pDesc"><?=$user_project['description']?></p>
              </div>
            </div>
       <?php 

        }
        ?>
      </div>
  </div>
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <p><?=$selected_user['bio']?></p>
  </div>
  
</div>


           
       
</div><!--Container-->




<?php
    
require_once("../elements/footer.php");
?>
          