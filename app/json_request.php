<?php 
include 'randgen.php';

class JSONUserRequest {
    private $js_obj;

    function __construct($js_str) {
        $this->js_obj = json_decode($js_str, true);
    }

    function getRandType() {
        if (!array_key_exists("randType", $this->js_obj)) {
            throw new Exception("JSON has no randType.");
        }
        return $this->js_obj["randType"];
    }

    function getExtAlphabet() {
        if (!array_key_exists("extAlphabet", $this->js_obj)) {
            throw new Exception("JSON has no extAlphabet.");
        }
        return $this->js_obj["extAlphabet"];
    }

    function getStrLen() {
        if (!array_key_exists("strLen", $this->js_obj)) {
            throw new Exception("JSON has no length.");
        }
        $len = $this->js_obj["strLen"];
        if (!is_int($len)) {
            throw new Exception("Length is not integer.");
        }
        return $this->js_obj["strLen"];
    }
    
    function getIntRange() {
        if (!array_key_exists("intRange", $this->js_obj)) {
            throw new Exception("JSON has no intRange.");
        }
        $arr = $this->js_obj["intRange"];
        if (!is_array($arr)) {
            throw new Exception("intRange is not array.");
        }
        return $arr;
    }

}

?>
