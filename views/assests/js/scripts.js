$(document).ready(function(){

    $("#projectFeed").on('click', '.comment-btn', function(){
        var comment_loop = $(this).closest('.project-post').find('.comment-loop');

        comment_loop.slideToggle(500, function(){ // $(this) now refers to new function comment_loop
            $(this).animate({
                scrollTop: $(this).prop('scrollHeight')
            }, 500);
        });
    });

    /*
    * LOVE BUTTON
    */

    $("#projectFeed").on('click', '.love-btn', function() {

        // Store the components in variables
        var love_btn = $(this);
        var love_icon = love_btn.find('.love-icon');
        var love_count = love_btn.find('.love-count');

        // Values
        var project_id = love_btn.data("project"); // set in index page span class data-project

        $.post ( // makes this post data to send to add.php then to love.,php
            '/loves/add.php',
            {
                'project_id': project_id
            },    
            function(love_results) {
                love_results = JSON.parse(love_results); // turns it from string to object "{project_id: 1}" object notation but in a string PARSE to {project: 1}
                console.log(love_results);

                if(love_results.error == false) { // if no errors and loved worked
                    if(love_results.loved == 'loved') {
                        love_icon.removeClass('far').addClass('fas'); // remove far heart outline, add fas heart fill
                        love_count.html(love_results.love_count);

                    } else if(love_results.loved == 'unloved') {
                        love_icon.removeClass('fas').addClass('far'); 
                        love_count.html(love_results.love_count);

                    }

                    console.log(love_results);

                }

            }
        );

    });



    /*
    * SUBMIT COMMENT
    */

    $("#projectFeed").on('submit', '.comment-form', function(e){
        e.preventDefault();

        // Store comment components
        var comment_form = $(this);
        var comment_box = comment_form.find('.comment-box');
        var comment_count = comment_form.closest('.project-post').find('.comment-count');
        var comment_loop = comment_form.closest('.project-post').find('.comment-loop');

        // Store the values
        var project_id = comment_form.data('project');
        var comment_text = comment_box.val();

        console.log(project_id, comment_text);
        // make sure there is text
        if( $.trim( comment_text ).length > 0){ // if you typed something // trim removes spacebars

            $.post(
                '/comments/add.php', //url
                {
                    project_id: project_id, 
                    comment: comment_text
                }, //data
                function(comment_data) { //complete function
                    // do stuff here...
                 
                    comment_data = JSON.parse(comment_data);
                    // check error value
                    if(comment_data.error == false) {
                        console.log(comment_data, comment_count);
                        comment_count.html(comment_data.comment_count);

                        var comment_html = '';
                        // output individual comments
                        $.each(comment_data.comments, function(index, comment) {
                            comment_html += "<div class='user-comment ";
                            comment_html += (comment.user_owns == 'true') ? 'my_comment' : '';
                            comment_html += "'><p>";
                            comment_html += "<span class='font-weight-bold comment-username'>"+comment.username+":</span> "; // selecting the user name within the object of comment (from above)
                            comment_html += comment.comment; // selecting the commment within the object of comment
                            comment_html += "</p></div>";
                        });

                        // call upon comment loop

                        comment_loop.html(comment_html);
                        comment_loop.slideDown(500, function(){

                            comment_loop.animate({
                                scrollTop: comment_loop.prop('scrollHeight')
                            }, 500);

                        });
                        comment_box.val(''); // after you submit your comment it wipes the box clean for a new comment



                    }

                    



                }
            );
        }
    });







    /*
    * FILE UPLOADING
    */


    $("#file-with-preview").on("change", function(){
        previewFile();

    });

    function previewFile() {
        // Select our preview <img> 
        // Get the file contents from upload field
        // Set the src of our <img> to the uploaded file location

       var preview =  $("#img-preview");
       var file = $("#file-with-preview")[0].files[0];

       var reader = new FileReader;
        // Run when file finishes reading
       reader.onloadend = function(){
           preview.attr('src', reader.result);      // change attribute
       }

       // load the info from the file var into the reader
       if(file) {
            reader.readAsDataURL(file);
            
       } else {
           preview.attr('src', "");
       }
    }


    /*
    * MODAL
    */

    $("#modal").click(function(){
        $.get('users/share.php', function(data){

            $( "#exampleModal .modal-body" ).html(data);

        });

    });



    /*
    * SEARCH
    */

    // get the result of what is being typed

    $("#search_form").on('submit', function(e) {
        //e.preventDefault();
    });


    $("input#search").on('keyup', function(e){
        var user_search = $(this).val();
        
        if(user_search.length > 2) {
           
            $.ajax({
                method: 'get',
                url: '/search_results.php',
                data: {
                    search: user_search
                },
                success: function(search_results) {
                    search_results = JSON.parse(search_results); // updating its self to be parsed data

                    var output = "<div class='list-group'>";
                    $.each(search_results, function(i, search_result){ // return each single result
                        output += "<a class='list-group-item' href='/projects?id="+search_result.id+"'>"+ search_result.title +"</a>";
                        
                    });

                    output += "</div>";
                    $("#search_results").html(output);
                    console.log(search_results);

                }
            });

        } else {
            $("#search_results").html('');
        }
    });







    /*
    * USER INDEX TABS
    */

    


});



