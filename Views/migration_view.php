<?php
    /**
    * The home page view
    */
    class MigrationView
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


        public function create_table()
        {
            $table = 'User';
            $column = array();
            $column = [
                'id' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
                'firstname' => 'VARCHAR(30) NOT NULL'
            ];
            return $this->controller->create_table($table,$column);
        }

        public function drop_table()
        {
            return $this->controller->drop_table();
        }


        public function show_table()
        {
            return $this->controller->show_table();
        }



        public function alter_table()
        {
            $query = array();
            $query[]='ALTER TABLE User ADD cc VARCHAR(30) NOT NULL ';
            $query[]='ALTER TABLE User ADD dd VARCHAR(30) NOT NULL ';

            return $this->controller->alter_table($query);
        }


        public function drop_field()
        {
            return $this->controller->drop_field();
        }


        public function rename_field()
        {
            $table = 'User';
            $field = 'ee';
            $type= 'VARCHAR(255)';
            $newfield = 'dd';
            return $this->controller->rename_field($table,$field,$newfield,$type);
        }
    }