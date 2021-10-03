<?php

class UserRegistration
{

    public $uniqueSKI;
    public $postdata;
    public function __construct()
    {
        // add_action('register_form', array($this, 'crf_registration_form'));
        // add_action('login_form_register', array($this, 'customRegistration'));
        // do_action( 'user_register', int $user_id, array $userdata )
        // add_action('login_init', array($this, 'yourloginoverrides'));
        add_shortcode('finapp_user_registration', array($this, 'showRegistrationForm'));
    }

    public function showRegistrationForm()
    {
        ob_start();

        include plugin_dir_path(__FILE__) . '../views/registration.php';

        $output = ob_get_clean();

        return $output;
    }


    public function customRegistration($data)
    {


        $this->postdata = $data;
        $email = $this->postdata['email'];

        // var_dump($this->postdata);
        // die;
        // add_filter('wpmu_signup_user_notification', '__return_true');
        // add_action('user_register', array($this, 'addUser'));
        // add_action('login_init', array($this, 'addUser'));
        // if ($user_data = $this->addUser($this->postdata)) {
        if ($user_data = $this->addUser()) {

            global $wpdb;


            return true;
        } else {
            return false;
        }


        return;
    }

    public function addUser($data = null)
    {
        // $user_id = email_exists($data['user_email']);
        // $user_id=username_exists($data['user_login'])
        // $user_id = false;
        if (is_null($data)) {
            $data = $this->postdata;
        }

        $user_id = email_exists($data['user_email']);
        if (!$user_id) {

            global $wpdb;
            // $user_id = wp_insert_user(array(
            //     'user_login' => $data['user_email'],
            //     'user_pass' => $data['password'],
            //     'user_email' => $data['user_email'],
            //     'first_name' => '',
            //     'last_name' => '',
            //     'display_name' => $data["user_email"],
            //     'role' => 'editor'
            // ));

            // var_dump(/)
            $user_id = wp_create_user($data['user_email'], $data['user_pass'], $data['user_email']);
            if (is_wp_error($user_id)) {
                $error = $user_id->get_error_message();
                //handle error here
            } else {
                $user = new WP_User($user_id);
                $user->set_role('contributor');
                //Redirect
                // wp_redirect('URL_where_you_want_redirect');
                // var_dump($user_id);
                // $user = get_user_by('ID', $user_id);
                //handle successful creation here
            }
            // $user_id = wp_insert_user($data['user_login'], $data['password'], $data['user_email']);


            // foreach ($data['meta'] as $key => $value) {
            //     $this->crf_user_register($user_id, $key, $value);
            // }

            return true;
        } else {
            $error = __('User already exists.');
            return false;
        }
    }




    public function sanitizePost()
    {
        $_POST['username']   =   sanitize_user($_POST['user_login']);
        $_POST['user_pass']   =   esc_attr($_POST['user_pass']);
        $_POST['user_email']   =   sanitize_email($_POST['user_email']);
        // $first_name =   sanitize_text_field( $_POST['fname'] );
        // $last_name  =   sanitize_text_field( $_POST['lname'] );
    }
}
