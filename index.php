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
    <h3>Cars</h3>

    <div class="row">
        <div class="col-12 py-3">
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
                <input type="search" name="search" placeholder="Search" id="search-model">
                <input type="search" name="search" placeholder="Enter Nickname" id="search-nickname">
                <button class="btn btn-primary" type="submit">
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
        </thead>
        <tbody id="search-results">
            <?php
            // run function from the myqli object $db
            // query creates a new object, returns mysqli_results objects -  $results is now object
            $sql = "SELECT * FROM cars";
            $results = $db->query($sql);

            while($row = $results->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . __($row["make"]) . "</td>";
                echo "<td>" . __($row["model"]) . "</td>";
                echo "<td>" . __($row["year"]) . "</td>";
                echo "<td>" . __($row["nickname"]) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>

    </table>
</div>

     






<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="Assests/js/scripts.js"></script>
</body>
</html>