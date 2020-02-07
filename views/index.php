<?php
require_once("../controllers/includes.php"); // includes database files and users etc
$title = "Home Page";
require_once("elements/header.php");




// create a new class object of User store in var $user, when called it goes to the indcludes.php
?>



  <?php
  if (empty($_SESSION["user_logged_in"])) {
      require_once("elements/sign-up-form.php");
    } else {
      require_once("elements/nav.php");
        ?>
      <!--<h1> Welcome to <?=APP_NAME?></h1>-->


      <!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="modal">
 Modal
</button>-->
<div class="container projectCont">
      <?php
      // check for Alerts




      if( !empty($_SESSION['errors']) && is_array($_SESSION['errors'])) {
          foreach( $_SESSION['errors'] as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
          }

          unset($_SESSION['errors']); // wipe errors from page
      }


      ?>

      

            <div id="projectFeed" class="row">
              <div class="card-columns">
              <?php

              $p_model = new Project;
              $projects = $p_model->get_all();
              $c_model = new Comment; //Get an instance of 

              foreach($projects as $project){
                ?>
                <div class="card mt-2 project-post">
                  <div class="card-img project-body hvrbox">
                    <img class="img-fluid project" src="<?=$project['file_url']?>">
                    <div class="middle hvrbox-layer_top hvrbox-layer_slideup w-100">
                    <div class="userName w-100"><a href="users/?id=<?=$project['user_id']?>"><?=$project['firstname']. " " . $project['lastname']?></a></div>
                    </div>
                  </div>
                  <div class="card-body">
                  <small class="text-muted">Posted <?=date("M d, Y", strtotime($project['date_uploaded']))?></small>
                  <?php
                    // if the project and user_id is = to current user
                    if($project['user_id'] == $_SESSION['user_logged_in']){
                      ?>
                      <span class="float-right">
                        <a href="/projects/edit.php?id=<?=$project['id']?>"><i class="fas fa-edit"></i></a>
                        <a href="/projects/delete.php?id=<?=$project['id']?>"><i class="fas fa-trash"></i></a>
                      </span>
                      <?php
                    }
                      ?>
                    <h4 id="title"><?=$project['title']?></h4>
                    <p class="pDesc"><?=$project['description']?></p>
                    
                  </div>
                  <div class="card-footer">
                      <?php
                      $love_class = 'far'; // font awesome outline heart
                      if( !empty($project['love_id'])) {
                          $love_class = "fas";  // Once you get the love id  - font awesome solid
                      }
                      ?>
                      <div class="project-meta">
                          <span class="love-btn float-left" data-project="<?=$project['id']?>">
                            <i class="<?=$love_class?> fa-heart love-icon"></i>
                            <span class="love-count"><?=$project['love_count']?></span>
                          </span>

                          <span class="float-right comment-btn">
                              <i class="far fa-comment"></i>
                              <span class="comment-count">
                              <?php
                                echo $c_model->get_count($project['id']);
                              ?>
                              </span>
                          </span>
                      </div>
                      
                          <div class="comment-loop pt-4">
                            <?php
                            $project_comments = $c_model->get_all_by_project_id($project['id']);
                            foreach($project_comments as $user_comment){
                              $my_comment = ($user_comment['user_owns'] == "true") ? "my_comment" : "";
                            ?>
                          
                            <div class="user-comment <?=$my_comment?>">
                              <p>
                             
                                <span class="font-weight-bold comment-username"><?=$user_comment['username']?></span> 
                                <?=$user_comment['comment']?>
                              </p>
                            </div>
                            <?php
                            } // end foreach project_comments

                          ?>
                          </div><!--end comment-loop-->
                          
                          
                          <form class="comment-form" data-project="<?=$project['id']?>">
                            <input type="text" name="comment" placeholder="Write a comment..." class="form-control comment-box">

                          </form>
                      </div>
                </div>
                <?php
              }
              ?>


           
              </div>
        </div>
        <div class="col-md-4" id="searchArea">
        
        </div>
      
      
      
      <?php
    }
  ?>


  
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

  


<?php
require_once("elements/footer.php");
?>

    