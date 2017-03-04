<?php
    class Item{
        private $image_url;
        private $ingredients;
        private $id;
        private $name;
        private $description;
        private $cost;
        private $type;

        function __construct(){
            $this->image_url   =      "";
            $this->ingredients = array();
            $this->id          =       0;
            $this->name        =      "";
            $this->description =      "";
            $this->cost        =    0.00;
            $this->type        =      "";
        }

        function getImage(){
            return $this->image_url;
        }

        function setImage( $image_url ){
            $this->image_url = $image_url;
        }

        function getIngredients(){
            return $this->ingredients;
        }

        function addIngredient( $ingredient){
            array_push($this->ingredients,$ingredient);
        }

        function getID(){
            return $this->id;
        }

        function setID( $id ){
            $this->id = $id;
        }

        function getName(){
            return $this->name;
        }

        function setName( $name ){
            $this->name = $name;
        }

        function getDescription(){
            return $this->description;
        }

        function setDescription( $description ){
            $this->description = $description;
        }

        function getCost(){
            return $this->cost;
        }

        function setCost( $cost ){
             $this->cost = $cost;
        }

        function getType(){
            return $this->type;
        }

        function setType( $type ){
            $this->type = $type;
        }
    }
?>
