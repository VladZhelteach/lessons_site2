<?php
class Greeting {
    private $message;

    public function __construct($message) {
        $this->message = $message;
    }

    public function __destruct() {
        //
    }

    public function get_message() {
        return $this->message;
    }
    
    public function set_message($message) {
        $this->message = $message;
    }
    
    public function print_message() {
        echo($this->message);
    }

}
?>