<?php

class DB  {

    public $data = array();
    public $params = array();

    function __construct() {
        // Run as soon as DB class is called

        // Store all our $_POST data in the $data variable
        //check if not empty
        
            // set all of the data into the data array
            // everytime it runs it takes all data and puts it into data object
            if( !empty($_POST)) {
                $conn = $this->conn();
                $escPost = array();
                foreach($_POST as $key => $value){
                    $escPost[$key] = trim(mysqli_real_escape_string($conn, $value) );
                }
                $conn->close();
                $this->data = $escPost;
            }

            // Store all of our $_GET data in the $params vairable
            if( !empty($_GET)) {
                $conn = $this->conn();
                $escGet = array();
                foreach($_GET as $key => $value){
                    $escGet[$key] = trim(mysqli_real_escape_string($conn, $value) );
                }
                $conn->close();
                $this->params = $escGet;
            }
    }
  

    protected function conn(){
        
        if($_SERVER["SERVER_NAME"] == "soniatoews.com"){
            $db_servername = "localhost";
            $db_username = "culturejam";
            $db_password = "cOr@904h";
            $db_name = "projectshare";
    
        } else {
            $db_servername = "localhost";
            $db_username = "root";
            $db_password = "root";
            $db_name = "projectshare";
        }
        
        $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

        if( $conn->connect_error) {
            die("Connection failed: ". $conn->connect_error);
        }
        return $conn;
    }

    

    /*
    * select
    * run a mysql select statement and return the results
    */

    public function select($sql) {
        if(APP_DEBUG) echo 'select<br>';
        $conn = $this->conn();
        $result = $conn->query($sql);

        // Store the XSS cleaned data 
        // XSS = Cross-Site Scripting Attack
        $xssArr = array();

        if($result->num_rows > 0) { // if result is 1 that means there is already a user if it's 0 then you can create an account
            $x = 0;
            while( $row = $result->fetch_assoc() )  { 
                // Loop through each column of the current row
                                //key       //key value
                foreach($row as $column => $value){  // go through each column of the row (user data) check for any attack code
                    $xssArr[$x][$column] = htmlspecialchars($value, ENT_QUOTES); // store the value of x in xssArr. Outpust $value = clean data
                }
                // x started as 0 (first user) goes through all columns of first user, then go to next user with ++
                $x++; // tell the while loop to go to the next user
            } 
        } else {
           if(APP_DEBUG) $_SESSION['errors'][] = "Error selecting from database: $sql";
        }

        $conn->close();
        return $xssArr; // return total array data (which is now cleaned)
    }

    /*
    * execute()
    * @params $sql
    *
    * Executes sql array
    * @returns null
    */

    public function execute($sql){
        $conn = $this->conn();
        if($conn->query($sql) !== true){ // if it runs succesuflly it will run true, if not true run error message
            echo "Your Statement: " . $sql . "<br> Error: ".$conn->error;
            die("Error with the sql statement");
        }
        $conn->close();

    }

    /*
    * execute_return_id()
    * @@params $sql
    * Executs sql query and returns the last inserted ID
    * @returns int
    *
    */

    public function execute_return_id($sql){
        if(APP_DEBUG) echo 'execute_return_id<br>';
        $conn = $this->conn();

        if($conn->query($sql) !== TRUE ) {
            echo "Your Statement: " . $sql . "<br> Error: ".$conn->error;
            die("Error with the sql statement");
        }
        $last_id = $conn->insert_id; // get the last inserted row/id

        $conn->close();

        return $last_id;

    }
}
?>