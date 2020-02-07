<?php
require_once("../../controllers/includes.php");


if(!empty($_GET['id']) ) {

    $p_model = new Project; // Start Project model
    $project = $p_model->get_by_id($_GET['id']); // $project - the array of that particular project selected

    if( !empty($_POST)) {
        $p_model->edit($_GET['id']);
        header ("Location: /");
        exit;
    }


} else {
    header("Location: /"); // you should not be on the edit page unless you have the id to edit
    exit();
}


require_once('../elements/header.php');
require_once('../elements/nav.php');
?>

<div class="container editProject">
    <div class="row">
        
            <div class="card mt-4 w-50 editCard">
                <div class="card-header">
                    <h4>Edit Project</h4>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <img id="img-preview" class="w-100" src="<?=$project['file_url']?>">
                        <div class="form-group custom-file mt-3">
                            <input id="file-with-preview" type="file" name="fileToUpload" class="custom-file-input">
                            <label class="custom-file-label">Upload</label>
                            </div>
                        <div class="form-group mt-3">
                            <input class="form-control" type="text" name="title" placeholder="Project Title" value="<?=$project['title']?>" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="description" placeholder="Project Description" required><?=$project['description']?></textarea>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn block">Update Project</button>
                        </div>
                       
                    </form>
                   
                </div>
            </div>
       
    </div>
</div>







<?php
require_once('../elements/footer.php')
?>