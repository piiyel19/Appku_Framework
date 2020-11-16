<?php
    class RedisModel
    {
        function __construct()
        {

            $this->config = new Config();
            $this->query = new Query();
            $this->security = new Security();
        }
    }