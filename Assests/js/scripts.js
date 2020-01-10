$(document).ready(function(){
    
    var search_query = '';
    var selected_year = 0;



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

        search_query = $(this).val();
        cool_search();

    }); // end of keyup

    $("#year-select").on("change", function(){
        selected_year = $(this).val();
        cool_search();
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
                year: selected_year  //name of what is passing: the value 
            }, // Data to be passed to file via post
            function(car_data){  // On complete function(returned data)
                if(car_data == "") return;
                var table_rows = ""; // create new table row for each ar
                var cars = JSON.parse(car_data);

                    // for each( index, object )
                $.each(cars, function(i, car){ //output as inidivual car objects
                    table_rows += "<tr><td>"+car.make+"</td><td>"+car.model+"</td><td>"+car.year+"</td><td>"+car.nickname+"</td></tr>";

                });

                $("#search-results").html(table_rows);
            }
        );



    } // end of cool search


}); // end of document ready