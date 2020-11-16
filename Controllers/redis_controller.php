<?php
    class RedisController
    {
        private $modelObj;

        protected $config;
        protected $query;

        function __construct( $model )
        {
            $this->modelObj = $model;

            $this->config = new Config();
            $this->query = new Query();

            $this->redisObj = new Redis();
            
        }



        function create_cache($data,$key)
        {
            $redis = new Redis();
            $redis->connect('localhost','6379');
            $redis->connect('127.0.0.1');
            $redis->set($key,$data);
            $value = $redis->get('test');
            echo $value;
        }

        function get_cache($key)
        {
            $redis = new Redis();
            $redis->connect('localhost','6379');
            $redis->connect('127.0.0.1');
            $value = $redis->get($key);
            echo $value;
        }

        function kill_cache($key)
        {
            $redis = new Redis();
            $redis->connect('localhost','6379');
            $redis->connect('127.0.0.1');
            $redis->mset(array($key => ''));
        }



        /* Functions for converting sql result  object to array goes below  */ 
        function convertToArray( $result ){ 
            $redisObj = new Redis();
            $resultArray = array(); 

            for( $count=0; $row = $result->fetch_assoc(); $count++ ) { 
              $resultArray[$count] = $row; 
            } 
            return $resultArray; 
        } 
        /* Functions for executing the mySql query goes below   */ 

        function executeQuery( $query ){ 
            $mysqli = $this->config->database();
            if( $mysqli->connect_errno ){ 
                echo "Failed to connect to MySql:"."(".mysqli_connect_error().")".mysqli_connect_errno(); 
            } 
            $result =  $mysqli->query( $query ); 
            // Calling function to convert result  to array
            $arrResult = $this->convertToArray( $result );

            return $arrResult;      
        }


        function check_redis()
        {
            $redis = new Redis();
            $redis->connect('127.0.0.1', 6379);
            echo $redis->ping();
        }

    }