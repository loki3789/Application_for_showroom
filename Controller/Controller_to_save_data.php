<?php

/**
 * Description of Controller_to_save_data1
 *
 * @author lokesh
 */
class Controller_to_save_data {

    public function process_request() {
        $category = $_REQUEST['category'];
        echo $category;
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '\PhpProject5\Model\Database_class.php');
        $date = date("Y-m-d");
        $time = date("h-i-sa");

        $t = new Database_class;
        $t->saverecords($category, $time, $date);
        echo 'data stored succefully';

        header('Location:../index.php');   // redirecting to same page after saving data to database
    }

}
