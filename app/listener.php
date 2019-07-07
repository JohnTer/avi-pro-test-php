<?php 

include 'json_request.php';
include "dbmanager.php";

class ApiListener {
    private $dbmanager;

    function __construct($dbname) {
        $this->dbmanager = new DBManager($dbname);
    }

    function listen() {
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
            case "POST":
                $this->postHandler();
                break;
            case "GET":
                $this->getHandler();
                break;
        }
    }

    private function postHandler() {
        $data = file_get_contents('php://input');
        $js = new JSONUserRequest($data);
        try{
            $rnd = new RandomGenerator($js);
            $randval = $rnd->generate();
            $id = $this->dbmanager->putData($randval);
        } 
        catch (Exception $ex) {
            $this->sendResponse("", 1);
            return;
        }
        $this->sendResponse($id, 0);

    }

    private function getHandler() {
        $id = $_GET["id"];
        try {
            $randval = $this->dbmanager->getData($id);
        } 
        catch (Exception $ex) {
            $this->sendResponse("", 1);
            return;
        }
        $this->sendResponse($randval, 0);
    }

    private function sendResponse($data, $err) {
        $mapjs = array("data" => $data, "err" => $err);
        header( "Content-type: application/json" );
        echo json_encode($mapjs);
    }


}
?>
