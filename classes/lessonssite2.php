<?php
class LessonsSite2 {
  protected $headers;
  protected $footers;
  protected $menus;
  protected $page;
  
  public function __construct() {
    $this->headers = array();
    $this->footers = array();
    $this->menus = array();
  }

  public function __destruct() {
    // destructor: for cleaning memory
    // mostly empty
  }

  public function add_header($heaher) {
    $this->headers[] = $heaher;
  }

  public function add_footer($footer) {
      $this->footers[] = $footer;
  }

  public function add_menu(Menu $menu) {
    $this->menus[] = $menu;
  }

  public function set_page(Page $page) {
    $this->page = $page;
  }

  public function get_page() {
    return $this->page;
  }

  public function render() {
    /*foreach($this->headers as $header) {
        include($header);
    }
    foreach($this->menus as $menu) {
      $menu->render();
    }*/
    
    $this->page->render();

    /*foreach($this->footers as $footer) {
        include($footer);
    }*/
  }
  
}

?>