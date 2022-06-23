<?php
interface WebsiteInterface {
    public function check_admin();
    public function add_header($heaher);
    public function add_footer($footer);
    public function add_menu(Menu $menu);
    public function set_page(Page $page);
    public function get_page();
    public function render();
}
?>