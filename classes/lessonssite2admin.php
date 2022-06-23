<?php
class LessonsSite2admin extends LessonsSite2 {
  private Signin $signin;
  
  public function __construct() {
    $this->headers = array();
    $this->footers = array();
    $this->menus = array();
  }

  public function __destruct() {
    // destructor: for cleaning memory
    // mostly empty
  }

  public function set_sign_in($signin) {
    $this->signin = $signin;
  }


  public function render() {
    
    $this->page->render();

  }
  
}

?>