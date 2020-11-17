<?php

   

    /**
    * The home page view
    */
    class SessionView
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


        function create_session()
        {
            $_SESSION['PHPSESSID'] = $this->generate_session();
        }


        function generate_session()
        {
            // this method using header request
            // $string = $_SERVER['HTTP_USER_AGENT'];
            // $string .= 'SHIFLETT';

            //$token = md5($string);
            // or method generate 
            $token = md5(uniqid(rand(), TRUE));

            return $token;
        }


        function view_session()
        {
            session_start();
            //var_dump($_SESSION['PHPSESSID']);
            if(empty($_SESSION['PHPSESSID'])){
                $this->generate_session();
            } else {
                return $_SESSION['PHPSESSID'];
                
            }
        }


        function destroy_session()
        {
            //session_start();
            unset($_SESSION["PHPSESSID"]);
            
        }


        function form()
        {
            session_start();
            $this->create_session();
            $base = $this->config->url();
            $route = '/session/submit_form?PHPSESSID='.$_SESSION['PHPSESSID'];
            return $this->view->templates('session', array('url' => $base.$route));
        }


        function submit_form()
        {
            $current_session = $this->view_session();

            //var_dump($current_session);
            if(empty($_GET['PHPSESSID'])){
                echo 'Routing Not Authorized';
            } else {
                if (isset($_SESSION['PHPSESSID']))
                {
                    if ($_GET['PHPSESSID']==$current_session){
                        echo 'SUCCESS USE SESSION '.$_SESSION['PHPSESSID'];
                        $this->destroy_session();
                    } else {
                        echo 'FAILED';
                    }
                } else {
                    echo 'FAILED';
                }
            }
        }


        function session_json()
        {
            session_start();
            $this->create_session();
            $base = $this->config->url();
            //$route = '/session/submit_form?PHPSESSID='.$_SESSION['PHPSESSID'];
            return $this->view->templates('session_json', array('url' => $base,'token'=>$_SESSION['PHPSESSID']));
        }

        function get_json()
        {
            session_start();
            if (empty($_SESSION['PHPSESSID'])) {
                $_SESSION['PHPSESSID'] = bin2hex($this->random_bytes(32));
            }

            header('Content-Type: application/json');

            $headers = apache_request_headers();
            if (isset($headers['PHPSESSID'])) {
                if ($headers['PHPSESSID'] !== $_SESSION['PHPSESSID']) {
                    exit(json_encode(['error' => 'Wrong CSRF token.']));
                } else {
                    $this->destroy_session();
                    return json_encode(['success' => 'Success CSRF token.']);
                }
            } else {
                exit(json_encode(['error' => 'No CSRF token.']));
            }
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