$(document).ready(function(){
    
    var search_query = '';
    var search_model = '';
    var selected_year = 0;
    var car_id = false;

    cool_search();



    $('#search-form').on("submit", function(e){
        e.preventDefault(); // prevent form refresh
    }); 
    
    // On keyup start search cars
    $("#search-form #search-nickname").on("keyup", function() {
        //Get the value in the search box
        // Send query to PHP file 
        //Return rows from PHP file that match query
        //Replace table rows with new results

        search_query = $(this).val();
        cool_search();

    }); // end of keyup

    $("#search-form #search-model").on("keyup", function() {
        //Get the value in the search box
        // Send query to PHP file 
        //Return rows from PHP file that match query
        //Replace table rows with new results

        search_model = $(this).val();
        cool_search();

    }); // end of keyup

    $("#year-select").on("change", function(){
        selected_year = $(this).val();
        cool_search();
    });

    // On Delete Button Click
    $("#search-results").on("click", "[data-action=delete]", function() {
        car_id = $(this).data("car");
        $("#deleteCarAlert").modal("show");
    });

    // On Delete Confirmation click
    $("#deleteCarAlert").on("click", "[data-action=confirm-delete]", function(){
        console.log(car_id);
        $.ajax({
            url: "ajax/delete.php",
            type: "POST",
            data: {
                id: car_id
            }, // data object that we are sending
            //what happens when the data returns back to us
            success: function(result) { // send success message
                console.log(result)  
                $("#deleteCarAlert").modal("hide");
                car_id = false; // reset the id so it is back to false and storing a car id
                cool_search();                                                                       
            }
        }); // ajax function to post to the file.  Parent of $post and $get. start with an object {}.
    });


    /*
    *
    * cool_search
    *  send search query to search.php
    *  return json results
    * 
    */


    function cool_search() {

        $.post(
            'ajax/search.php', // URL of the file to call
            {
                search: search_query,
                search_model: search_model,
                year: selected_year  //name of what is passing: the value 
            }, // Data to be passed to file via post
            function(car_data){  // On complete function(returned data)
                if(car_data == "") return;
                var table_rows = ""; // create new table row for each ar
                var cars = JSON.parse(car_data);

                    // for each( index, object )
                $.each(cars, function(i, car){ //output as inidivual car objects
                    table_rows +=
                    "<tr><td>"+car.make+
                    "</td><td>"+car.model+
                    "</td><td>"+car.year+
                    "</td><td>"+car.nickname+
                    "</td><td>"+
                    "<button class='btn' data-action='delete' data-car='"+car.id+"'><i class ='fas fa-trash'></i></button>"
                    "</td></tr>";
                });

                $("#search-results").html(table_rows);
            }
        );



    } // end of cool search

   /* $("button[date-action=add]").on("click", "function()")
        var make
        var model
        var year
        var nickname

    $.ajax({
        url: "ajax/insert.php",
        type: "POST",
        data: {
            makemodel: model
        },
        success: function(result) {
            all_search();
        }
    }); */


    





}); // end of document ready