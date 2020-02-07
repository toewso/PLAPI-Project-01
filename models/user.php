<?php

// Defined the Class of User for the includes page to call when necessary
class User extends DB {





     /*
    *  get_all()
    *  Get all users data from the database
    *  @returns array
    */
    public function get_all(){

        $user_id = (int)$_SESSION['user_logged_in'];

        if( !empty($_GET['search']) ) { // returns unflitered data, check to make sure completely empty no characters
            $search_query = $this->params['search']; // returns filtered data
            $search_query = str_replace('@','', $search_query);
            $sql_where = "WHERE users.username LIKE '%$search_query%'
                          OR users.firstname LIKE '%$search_query%'
                          OR users.lastname LIKE '%$search_query%' ";
        } else {
            $sql_where = '';
        }


        $sql = "SELECT * FROM users $sql_where";

        $user_results = $this->select($sql); // select the users table from DB store results in $projects and return $projects

        foreach($user_results as $key => $user) { // returns array plus key which is the number in the array
            
            $user_results[$key]['title'] = $user['firstname'] . " " . $user['lastname'];
            // puting the results back into the correct user and return results, also adding title
            // if you run the search you should see first and last name

        }


        return $user_results;






    }






    /*
    *  get_by_id()
    *  Get a users data from the database by ID
    *  @params $user_id
    *  @returns array
    */
    public function get_by_id($user_id) {
        $sql = "SELECT * FROM users WHERE id = $user_id";
        $user = $this->select($sql)[0]; // select the first row of the array [0]

        return $user;
    }


    /*
    *  exists()
    *  Check if user already exists in the datbase
    *
    *  @returns array
    */

    public function exists() {
        if(APP_DEBUG) echo 'exists<br>';
   
        // Check the database to see if the user exists
        // extend the class to pull in all the functions 
        $username = $this->data["username"];
        $email = $this->data["email"];

        $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email' LIMIT 1";

        $user = $this->select($sql);

        return $user; // if it finds a user it will return it
       
    }

    /*
    *  add()
    *  Add the new user to the database
    *
    *  @returns intiger
    */

    public function add() {
        if(APP_DEBUG) echo 'add<br>';
        $username = $this->data['username'];
        $email = $this->data['email'];
        $firstname = $this->data['firstname'];
        $lastname = $this->data['lastname'];
        $bio = $this->data['bio'];
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

        $sql = "INSERT INTO
                    users  (username, email, firstname, lastname, bio, password) 
                    VALUES ('$username', '$email', '$firstname', '$lastname', '$bio', '$password')";

        $new_user_id = $this->execute_return_id($sql);

        return $new_user_id;
    }

    /*
    *  edit()
    *  Edit the current user
    *  
    *  @returns null
    */

    public function edit() {
        $id = (int)$_SESSION['user_logged_in']; // use current $_SESSION to make sure it is the current user that we are editing. Make sure info is not a string use INT
        $username = $this->data['username'];
        $firstname = $this->data['firstname'];
        $lastname = $this->data['lastname'];
        $bio = $this->data['bio'];
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

        if( !empty($_FILES['fileToUpload']['name'])) { // check if new file was submitted

            $util = new Util;
            $file_upload = $util->file_upload(); // Upload the new file
            $filename = $file_upload['filename'];
            

            if($file_upload['file_upload_error_status'] == 0 ) {
                // get old image
                $old_profile_image = $this->get_by_id($id)['profile_pic']; // id stored is var above

                $sql = "UPDATE users SET profile_pic = '$filename' WHERE id = $id";

               
                $this->execute($sql);

                // delete old image
                if( !empty($old_profile_image)) { // is there an old profile pic
                    if(file_exists(APP_ROOT. "/views" . $old_profile_image)) {
                        unlink(APP_ROOT. "/views" . $old_profile_image); // delete old profile pic file from the uploads folder
                    }
                }
            }
        }

        // make sql statment to put in all data. Set WHERE.
        

        if($_POST['password']== "") {
            $sql = "UPDATE users
                SET username = '$username',
                    firstname = '$firstname',
                    lastname = '$lastname',
                    bio = '$bio'
                WHERE id = $id";

        } else {
            $sql = "UPDATE users
                SET username = '$username',
                    firstname = '$firstname',
                    lastname = '$lastname',
                    bio = '$bio',
                    password = '$password'
                    WHERE id = $id";

        }
        
        $this->execute($sql); // create execute in db
    }




    /* 
    *  login()
    *  Logs in the user
    *
    *  @returns null
    */

    public function login() {

        $_SESSION = array(); // empty the session first to start fresh

        $username = $this->data['username']; // from the form fields post data
        $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$username' LIMIT 1";

        $user = $this->select($sql)[0];
       
        if (password_verify($_POST['password'], $user['password'] ) ) {
            $_SESSION['user_logged_in'] = $user["id"];

            // if Remember is set, set the cookc of user_logged_in
            if( !empty($_POST['remember'])){
                setcookie('user_logged_in', $user['id'], time() + (30 * 24 * 60 * 60), "/");
            } 
        } else {
            $_SESSION['login_attempt_msg'] = "<p class='incorrectPassword'>Incorrect Username or Password</p>";
        }
        
    }










}
?>