<?php

include "uuid.php";

class DBManager {
    private $dbh;
    
    function __construct($dbname) {
        $this->dbh = new PDO("sqlite:".$dbname);
        }

    function getData($id) {
        $query = sprintf("select * from table_numbers where id = '%s';", $id);
        $res_obj = $this->dbh->query($query);
        $result = $res_obj->fetch();
        if (is_bool($result)) {
            throw new Exception("The object does not exist in database.");
        }
        return $result["val"];
    }

    function putData($data) {
        $id = get_uuid();
        $unixtime = time();
        $query = sprintf("insert into table_numbers (id, val, unixtime) values ('%s', '%s', '%d')", $id, $data, $unixtime);
        $num = $this->dbh->exec($query);
        return $id;
    }
}

?>