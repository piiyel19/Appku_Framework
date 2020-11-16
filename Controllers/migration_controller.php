<?php

    class MigrationController
    {
        private $modelObj;

        protected $config;
        protected $query;
        protected $migrate;

        function __construct( $model )
        {
            $this->modelObj = $model;

            $this->config = new Config();
            $this->query = new Query();
            $this->migrate = new Migration();
        }



        public function create_table($table,$column)
        {
            return $this->migrate->create_table($table,$column);
        }

        public function drop_table()
        {
            $table = 'User';
            return $this->migrate->drop_table($table);
        }


        public function show_table()
        {
            return $this->migrate->show_table();
        }



        public function alter_table($query)
        {
           return $this->migrate->alter_table($query);
        }


        public function drop_field()
        {
            $table = 'User';
            $field = 'dd';
            return $this->migrate->drop_field($table,$field);
        }


        public function rename_field($table,$field,$newfield,$type)
        {
            return $this->migrate->rename_field($table,$field,$newfield,$type);
        }


    }