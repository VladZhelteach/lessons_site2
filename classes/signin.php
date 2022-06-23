<?php
class Signin {
    private $db_connect;
    private $name;
    private $role;
    private $status;

    public function __construct($db_connect) {
        $this->db_connect = $db_connect;
    }

    public function __destruct() {
        //
    }

    private function set_status($status) {
        $this->status = $status;
    }

    private function set_role($role) {
        $this->role = $role;
    }

    public function get_status() {
        return $this->status;
    }

    public function get_role() {
        return $this->role;
    }

    public function check_update() {
        //$_SESSION['user_name'];
        $role = $_SESSION['user_role'];
    }

    public function check_cookie() {
        if (isset($_COOKIE['user_name']) && isset($_COOKIE['user_role'])) {
            return true;
        } else {
            return false;
        }
    }
    
    public function sign_in($sign_in_login, $sign_in_password) {
        $this->db_connect->set_sql_text("SELECT * FROM `users` WHERE `username` = '$sign_in_login'");
        $this->db_connect->query();
        if ($this->db_connect->get_result_num_rows() > 0) {
            while($row = $this->db_connect->fetch()) {
                if ($row["username"] == $sign_in_login && $row["password"] == MD5($sign_in_password)) {
                    $ses_user_name = $row["username"];
                    $ses_user_role = $row["role"];
                    $_SESSION['user_name'] = $ses_user_name;
                    $_SESSION['user_role'] = $ses_user_role;
                    setcookie('user_name', $ses_user_name, time()+3600*24*30);
                    setcookie('user_role', $ses_user_role, time()+3600*24*30);
                    return "Successfully logged in";
                } else {
                    return "Password incorrect";
                }
            }
        }
    }

    public function sign_out() {
        session_destroy();
        setcookie ("user_name", "", time() - 3600);
        setcookie ("user_role", "", time() - 3600);
        return "Successfully logged out";
    }
}
?>