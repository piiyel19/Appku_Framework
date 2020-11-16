<?php

   

    /**
    * The home page view
    */
    class CookiesView
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


        function sessionStart($lifetime,$path,$domain,$secure,$httpOnly)
        {
            session_set_cookie_params($lifetime,$path,$domain,$secure,$httpOnly);
            session_start();

        }


        function cookies()
        {
            // https
            //$this->sessionStart(0,'/','localhost',true,true);

            //http
            $this->sessionStart(0,'/','localhost',false,true);

            $_SESSION['id']=2234;

            echo 'SESSION STARTED';
        }


        function cookies_die()
        {
            $_SESSION['id'] = 2234;
            setcookie($_SESSION['id'], "", time() - 3600);

            session_unset();
        }


        function view_cookies()
        {
            $base = $this->config->url();
            $route = '';
            // You Cannot See Cookies Data Set
            return $this->view->templates('cookies', array('url' => $base.$route));
        }


    }