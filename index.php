<?php
require_once("conn.php");

function __($input){
    return htmlspecialchars($input, ENT_QUOTES);
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Assistant:600,700,800|Red+Hat+Display&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/19b446f9fb.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="Assests/css/styles.css">
</head>
<body>

<div class="container">
    <h2>Project 1 Cars</h2>

    <div class="row">
        <div class="col-12 py-5">
            <form class="input-group" id="search-form">
                <div class="input-group-prepend"> 
                    <select class="custom-select" id="year-select">
                        <option selected value="0">Year</option>
                        <?php
                        // for(i = *; i++)
                        // foreach (array as single)
                        // while (while this satement is true)

                        for($i = 1956; $i <= intval(date("Y")); $i++) {
                            echo "<option value='$i'>$i</option>";
                        }

                        ?>
                    </select>
                </div>
                <input class="form-control topSearch" type="search" name="search" placeholder="Search" id="search-model">
                <input class="form-control topSearch" type="search" name="search" placeholder="Enter Nickname" id="search-nickname">
                <button class="btn btn-primary topSearchButton" type="submit">
                    <i class="fas fa-search text-white"></i>
                </button>
            </form>
        </div>
    </div>
  
    <table class="table">
        <thead>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Nickname</th>
            <th></th>
        </thead>
        <tbody id="search-results">
           
        </tbody>
            <foot>
                <th><input type="text" class="form-control" placeholder="Make" id="carMake"></th>
                <th><input type="text" class="form-control" placeholder="Model" id="carModel"></th>
                <th><input type="text" class="form-control" placeholder="Year" id="carYear"></th>
                <th><input type="text" class="form-control" placeholder="Nickname" id="carNickname"></th>
                <th><button class="btn btn-primary" data-action="add"><i class="fas fa-plus"></i><button</th>
            </foot>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteCarAlert" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
       Are you sure you want to delete this car?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" data-action="confirm-delete">Delete</button>
      </div>
    </div>
  </div>
</div>


     






<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="Assests/js/scripts.js"></script>
</body>
</html>