<?php

/**
 * Description of database
 *
 * @author lokesh
 */
class database {
    //put your code here
    public function get_connection(){
        $connection = mysqli_connect("localhost", "root", "root", "jspdb");
        return $connection;
    }
}
?>