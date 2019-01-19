<?php

/**
 * Description of Database_class
 *
 * @author lokesh
 */
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '\PhpProject5\Model\database.php');

class Database_class extends database {

    
    public function saverecords($model, $time, $date) {
// Inserting in Table(time Information) of Database
        $connection = database::get_connection();
        $query = "insert into model_information_table(model,time,date) values('$model','$time','$date')";
        if (mysqli_query($connection, $query)) {
            echo "values are inserted successfully.";
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
        }
    }

    public function get_max_query($tvs1, $tvs2, $tvs3) { //function returns the model that has maximum enquaries
        if ($tvs2 > $tvs1 && $tvs2 > $tvs3) {
            return array("Tvs2", $tvs2);
        }
        if ($tvs1 > $tvs2 && $tvs1 > $tvs3) {
            return array("Tvs1", $tvs1);
        }
        if ($tvs3 > $tvs1 && $tvs3 > $tvs2) {
            return array("Tvs3", $tvs3);
        }
    }

    public function get_max_model_of_day($day) {
        $connection = database::get_connection();
        $tvs1 = 0;
        $tvs2 = 0;
        $tvs3 = 0;
        $data = [];
        $res = mysqli_query($connection, "select * from model_information_table where date='$day'");
        while ($row = mysqli_fetch_array($res)) {
            $data[] = array($row['model']); //converting database rows into array
        }
        foreach ($data as $line):
            if ($line[0] == "Tvs1") {
                $tvs1 = $tvs1 + 1;
            }
            if ($line[0] == "Tvs2") {
                $tvs2 = $tvs2 + 1;
            }
            if ($line[0] == "Tvs3") {
                $tvs3 = $tvs3 + 1;
            }endforeach;

        $instance_of_class = new Database_class;
        $data1 = $instance_of_class->get_max_query($tvs1, $tvs2, $tvs3);

        return $data1;
    }

    public function get_max__model_in_month($day) {
        $connection = database::get_connection();
        $tvs1 = 0;
        $tvs2 = 0;
        $tvs3 = 0;
        $data = [];
        $res = mysqli_query($connection, "select * from model_information_table where date like '$day%'");
        while ($row = mysqli_fetch_array($res)) {
            $data[] = array($row['model']); //converting database rows into array
        }
        foreach ($data as $line):
            if ($line[0] == "Tvs1") {
                $tvs1 = $tvs1 + 1;
            }
            if ($line[0] == "Tvs2") {
                $tvs2 = $tvs2 + 1;
            }
            if ($line[0] == "Tvs3") {
                $tvs3 = $tvs3 + 1;
            }endforeach;

        $instance_of_class = new Database_class;
        $data1 = $instance_of_class->get_max_query($tvs1, $tvs2, $tvs3);

        return $data1;
    }

    public function get_max_model_in_week($date) {
        $connection = database::get_connection();
        $tvs1 = 0;
        $tvs2 = 0;
        $tvs3 = 0;
        $data = [];
        $year = substr($date, 0, 5);
        $month = substr($date, 6, 8);
        $day = int(substr($date, 9, 11));
        for ($i = 0; $i < 7; $i++) {
            $res = mysqli_query($connection, "select * from model_information_table where date='$date'");
            while ($row = mysqli_fetch_array($res)) {
                $data[] = array($row['model']); //converting database rows into array
            }

            $day = $day - 1;
            $date = $year - $month - $day;
        }
        foreach ($data as $line):
            if ($line[0] == "Tvs1") {
                $tvs1 = $tvs1 + 1;
            }
            if ($line[0] == "Tvs2") {
                $tvs2 = $tvs2 + 1;
            }
            if ($line[0] == "Tvs3") {
                $tvs3 = $tvs3 + 1;
            }endforeach;

        $instance_of_class = new Database_class;
        $data1 = $instance_of_class->get_max_query($tvs1, $tvs2, $tvs3);//get  model that has maximum enquaries

        return $data1;
    }

}

?>