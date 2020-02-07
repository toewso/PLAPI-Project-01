<?php

class Love extends DB {


    /*
    * add()
    * Add love to a project
    * @params $love_data
    * @returns array
    */

    public function add( $love_data ) {

         // send via ajax post data from add to here

         $project_id = $this->data['project_id'];
         $user_id = (int)$_SESSION['user_logged_in'];

           // Check if already loved by user
            $sql = "SELECT * FROM loves WHERE project_id = $project_id AND user_id = $user_id";
            $love = $this->select($sql);

            if( !empty($love)){
                $love = $love[0];
            }
           // If so, delete the love
           if( !empty($love['id'])) {
               // we'll delete the love
               $sql = "DELETE FROM loves WHERE project_id = $project_id AND user_id = $user_id";
               $this->execute($sql);
               $love_data['loved'] = 'unloved';
               $love_data['error'] = false;
           } else {
                  // Else, show some love
                  $sql = "INSERT INTO loves (user_id, project_id) VALUES ($user_id, $project_id)";
                  $love_id = (int)$this->execute_return_id($sql); // inssert in DB and returns back the id of what was just inserted
                  if( !empty($love_id) && $love_id !=0) {
                      $love_data['loved'] = 'loved';
                      $love_data['error'] = false;
                  }
           }

           // Get the new loves count
           $sql = "SELECT COUNT(loves.id) AS love_count FROM loves WHERE loves.project_id = $project_id";
           $love_count = $this->select($sql)[0];
           $love_data['love_count'] = $love_count['love_count'];


           return $love_data;
         

  
    }


  













}

?>