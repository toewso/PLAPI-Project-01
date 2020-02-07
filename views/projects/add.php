<?php
require_once("../../controllers/includes.php");

if( !empty($_POST['title']) && !empty($_POST['description'])){
    // Add new project

    $project = new Project;
    $project->add();

    header("Location:/");
} 

$title = "My Profile";
require_once("../elements/header.php");
require_once("../elements/nav.php");
   
        // check for Alerts


              if( !empty($_SESSION['errors']) && is_array($_SESSION['errors'])) {
                  foreach( $_SESSION['errors'] as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                  }

                  unset($_SESSION['errors']); // wipe errors from page
              }

              ?>

      <div class="row addProject">
       
          <div class="card mt-4 w-50" id="shareProjectCard">
            <div class="card-header">
              <h4>Share New Project</h4>
            </div>
              <div class="card-body">
                <form action="/projects/add.php" method="post" enctype="multipart/form-data">
                  <img id="img-preview" class="w-100">
                    <div class="form-group custom-file mt-3">
                      <input id="file-with-preview" type="file" name="fileToUpload" class="custom-file-input" required>
                      <label class="custom-file-label">Upload</label>
                      </div>
                      <div class="form-group mt-3">
                        <input class="form-control" type="text" name="title" placeholder="Project Title" required>
                      </div>
                      <div class="form-group mt-3">
                        <textarea class="form-control" name="description" placeholder="Project Description" required></textarea>
                      </div>
                      <div class="form-group text-right">
                        <button type="submit" class="btn block">Post Project</button>
                      </div>
                      
                   
                </form>
              </div>
          
          </div> 
       
      </div><!--End shareProjectCard-->


        

<?php
require_once("../elements/footer.php");
?>

    