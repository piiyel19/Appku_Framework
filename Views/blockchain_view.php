<?php

   

    /**
    * The home page view
    */
    class BlockchainView
    {

        private $model;
        private $controller;

        protected $view;
        protected $config;
        protected $query;

        protected $template;

        protected $blockchain;

        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->model = $model;
            
            $this->view = new View();
            $this->config = new Config();
            $this->query = new Query();
            $this->template = new Template();
            $this->migrate = new Migration();

            $this->blockchain = new Blockchain();
        }




        function simpleChain()
        {
            echo "mining block 1...\n";
            $this->blockchain->push(new Block(1, strtotime("now"), "amount: 4"));
            echo '<br>';
            echo "mining block 2...\n";
            $this->blockchain->push(new Block(2, strtotime("now"), "amount: 10"));
            echo '<br>';
            echo '<pre>';
            echo json_encode($this->blockchain, JSON_PRETTY_PRINT);
            echo '</pre>';
        }
        

        function hack()
        {
            echo "mining block 1...\n";
            $this->blockchain->push(new Block(1, strtotime("now"), "amount: 4"));
            echo '<br>';
            echo "mining block 2...\n";
            $this->blockchain->push(new Block(2, strtotime("now"), "amount: 10"));
            echo '<br>';
            echo "Chain valid: ".($this->blockchain->isValid() ? "true" : "false")."\n";
            echo '<br>';
            echo "Changing second block...\n";
            $this->blockchain->chain[1]->data = "amount: 1000";
            $this->blockchain->chain[1]->hash = $this->blockchain->chain[1]->calculateHash();
            
            echo '<br>';
            echo "Chain valid: ".($this->blockchain->isValid() ? "true" : "false")."\n";
        }
        


    }