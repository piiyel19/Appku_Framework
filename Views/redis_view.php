<?php

    /**
    * The home page view
    */
    class RedisView
    {

        private $model;
        private $controller;

        protected $view;
        protected $config;
        protected $query;

        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->model = $model;
            
            $this->view = new View();
            $this->config = new Config();
            $this->query = new Query();
        }


        function redis_query()
        {
            $query = 'select * from test limit 1'; 
            // Calling function to execute sql query
            $arrValues = $this->controller->executeQuery( $query );

            // Making json string
            $jsonValue = json_encode($arrValues);

            return $jsonValue;
        }


        function create_cache()
        {
            $data = $this->redis_query();
            $key = 'test';
            return $this->controller->create_cache($data,$key);
        }

        function get_cache()
        {
            $key = 'test';
            return $this->controller->get_cache($key);
        }

        function kill_cache()
        {
            $key = 'test';
            return $this->controller->kill_cache($key);
        }


        function check_redis()
        {
            return $this->controller->check_redis();
        }



    }