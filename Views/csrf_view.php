<?php

   

    /**
    * The home page view
    */
    class CSRFView
    {

        private $model;
        private $controller;

        protected $view;
        protected $config;
        protected $query;

        protected $template;

        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->model = $model;
            
            $this->view = new View();
            $this->config = new Config();
            $this->query = new Query();
            $this->template = new Template();
            $this->migrate = new Migration();
        }

        public function form()
        {
            $base = $this->config->url();
            $route = '/csrf/submit_form';

            session_start();
            $token = $this->generate_token();
            return $this->view->templates('csrf', array('url' => $base.$route,'token'=>$token));
        }


        public function submit_form()
        {
            session_start();
            if ($_GET["csrf_token"] != $_SESSION["csrf_token"]) {
                // Reset token
                unset($_SESSION["csrf_token"]);
                die("CSRF token validation failed");
            } else {
                echo 'Success';
                unset($_SESSION["csrf_token"]); // comment this function if to generate new token
            }
        }


        function generate_token() {
            // Check if a token is present for the current session
            if(!isset($_SESSION["csrf_token"])) {
                // No token present, generate a new one
                $token = $this->random_bytes(64);
                $_SESSION["csrf_token"] = $token;
            } else {
                // Reuse the token
                $token = $_SESSION["csrf_token"];
            }
            return $token;
        }





        function random_bytes($length = 6)
        {
            $characters = '0123456789';
            $characters_length = strlen($characters);
            $output = '';
            for ($i = 0; $i < $length; $i++)
                $output .= $characters[rand(0, $characters_length - 1)];

            return $output;
        }



       

    }