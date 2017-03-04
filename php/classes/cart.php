<?php
    class Cart{
        private $items;

        function __construct(){
            $this->items = array();
        }

        function getItems(){
            return $this->items;
        }

        function addItem( $item, $count = 1 ){
            for($i = 0; $i < $count; $i++){
                array_push($this->items,$item);
            }
        }

        function removeItem( $item ){
            unset($this->items[array_search($item,$this->items)]);
        }

        function removeAllOfItem( $item ){
            while(array_search($item,$this->items)){
                unset($this->items[array_search($item,$this->items)]);
            }
        }

        function removeAllItems(){
            unset($this->items);
            $this->items = array();
        }

        function getCount(){
            return count($this->items);
        }

        function getTotalCost(){
            $total = 0.00;
            foreach( $this->items as $item ){
                $total += $item->getCost();
            }
            return $total;
        }
    }
?>
