<?php
class UserLogin
{

    public $postdata;
    public function __construct()
    {


        add_shortcode('finapp-user-login', array($this, 'showLoginForm'));
    }

    public function showLoginForm()
    {
        ob_start();
        include plugin_dir_path(__FILE__) . '../views/login.php';
        $output = ob_get_clean();
        return $output;
    }
}
