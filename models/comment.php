<?php


class Comment extends DB {

    /*
    * add()
    * Adds comment to the database and returns full list of ocomments
    * @param $comment_data
    * @returns array
    */


    public function add($comment_data) {

        // get $post data keys
        $comment = $this->data['comment']; 
        $project_id = $this->data['project_id'];
        $user_id = (int)$_SESSION['user_logged_in'];
        $posted_time = date('Y-m-d H:i:s', time());
        
        // insert comment into the database
        $sql = "INSERT INTO comments(comment, posted_time, project_id, user_id)
                VALUES ('$comment', '$posted_time', $project_id, $user_id)";

        $comment_id = $this->execute_return_id($sql); // insert

        if (!empty($comment_id) && is_numeric($comment_id)) { // did the comment return and ID
            // get the comment count for the current project
                $comment_count = $this->get_count($project_id);

            // get all comment for the project
            $all_project_comments = $this->get_all_by_project_id($project_id);

            // Pass it back to our script.js in our $coment_data
            // put it all in this array
            $comment_data['error'] = false;
            $comment_data['comment_count'] = $comment_count;
            $comment_data['comments'] = $all_project_comments;

            // the value returned by the function
            return $comment_data;
        }
    }


    public function delete() {


    }


    public function get_all_by_project_id($project_id) {
        
        $project_id = (int)$project_id;
        $user_id = (int)$_SESSION['user_logged_in'];


        // IF my user ID = comment user ID - you can edit your own comments
        $sql = "SELECT comments.*, users.username, 
                IF(comments.user_id = $user_id, 'true', 'false') AS user_owns
                FROM comments
                LEFT JOIN users
                ON comments.user_id = users.id
                WHERE comments.project_id = $project_id 
                ORDER BY comments.posted_time ASC
                LIMIT 50";

        $project_comments = $this->select($sql);

        return $project_comments;

    }


    public function get_count($project_id) {
        $project_id = (int)$project_id;
        // get the count of a specific column
        // store as comment_count
        $sql = "SELECT COUNT(id) AS comment_count
                FROM comments
                WHERE project_id = $project_id";

        // store the above, only first one

        $returned_count = $this->select($sql)[0];
        // RETURN ARRAY
        /* Array (
            0 => array (
                'comment_count => 5
             )
        )
        */

        return $returned_count['comment_count'];




    }
}

