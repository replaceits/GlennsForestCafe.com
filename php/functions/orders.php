<?php
    class Order{

    }

    class Orders{
        private $count;
        private $orders;

        function __construct(){
            $this->count = 0;
            $this->orders = array();

            
        }

        function getCount(){
            return $this->count;
        }

        function getOrders(){

        }
    }
?>
