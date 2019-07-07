<?php 

class RandomGenerator {
    private $js_request;
    private $rnd_type;
    private $alphabet;


    function __construct($js_request) {
        $this->js_request = $js_request;
        $this->rnd_type = $js_request->getRandType();
        $this->setAlphabet();
    }

    private function setAlphabet() {
        switch ($this->rnd_type) {
            case "str":
            $this->alphabet = "abcdefghijklmnopqrstuvwxyz";
                break;
            case "strnum":
            $this->alphabet ="abcdefghijklmnopqrstuvwxyz1234567890";
            break;
            case "extstr":
            $this->alphabet = $this->js_request->getExtAlphabet();
            break;   
        }  

    }

    function generate() {
        $result = "";
        switch ($this->rnd_type) {
    case "num":
        $result = $this->getRandNum();
        break;
	case "str":
        $result = $this->getRandStr();
        break;
	case "strnum":
        $result = $this->getRandStr();
        break;
	case "uuid":
        $result = $this->getRandUUID();
        break;
	case "extstr":
        $result = $this->getRandStr();
        break;
    default:
        throw new Exception("Uknown random type.");
		break;
        }
        return $result;
    }

    function getRandStr() {
        $len = $this->js_request->getStrLen();
        $alph_len = strlen($this->alphabet);
        $result = "";
        for ($i = 0; $i < $len; $i++) {
            $result .= $this->alphabet[mt_rand(0, $alph_len - 1)];
        }
        return $result;
    
    }
    
    function getRandNum() {
        $range = $this->js_request->getIntRange();
        $a = $range[0];
        $b = $range[1];

        $result = mt_rand($a, $b);
        return strval($result);
    }
    
    function getRandUUID() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
    
    } 

}
?>