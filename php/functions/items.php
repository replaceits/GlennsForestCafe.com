<?php
    require_once(__DIR__ . "/../classes/item.php");

    class Items{
        public static function getAllItems(){
            $items = array();
            $database_key = file_get_contents('/api-keys/database.key');
            $mysqli_con = new mysqli("localhost","http",$this->database_key,"glennsforestcafe");

            if(!mysqli_connect_errno()){
                $sql = "SELECT food_item.food_item_id, food_item_name, food_item_cost, food_item_description, food_image_url, food_item_type_name
                            FROM food_item
                            LEFT JOIN food_item_types ON food_item.food_item_id=food_item_types.food_item_id
                            LEFT JOIN food_item_type ON food_item_type.food_item_type_id=food_item_types.food_item_type_id
                            LEFT JOIN food_image ON food_image.food_item_id=food_item.food_item_id
                            ORDER BY food_item_type_name;";
                            
                if($stmt = $mysqli_con->prepare($sql)){
                    $stmt->bind_param('s',$type);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($food_item_name, $food_item_cost, $food_item_description, $food_image_url, $food_item_type_name);

                    if($stmt->num_rows > 0){
                        while( $stmt->fetch()){
                            array_push($items, new Item( $food_image_url ));
                        }
                    }
                    $stmt->close();
                }
            }
            $mysqli_con->close();
            return $items;
        }

        public static function getItemsByType( $type ){
            $items = array();
            $database_key = file_get_contents('/api-keys/database.key');
            $mysqli_con = new mysqli("localhost","http",$database_key,"glennsforestcafe");

            if(!mysqli_connect_errno()){
                $sql = "SELECT food_item.food_item_id, food_item_name, food_item_cost, food_item_description, food_image_url, food_item_type_name
                            FROM food_item
                            LEFT JOIN food_item_types ON food_item.food_item_id=food_item_types.food_item_id
                            LEFT JOIN food_item_type ON food_item_type.food_item_type_id=food_item_types.food_item_type_id
                            LEFT JOIN food_image ON food_image.food_item_id=food_item.food_item_id
                            WHERE food_item_type_name=?;";
                            
                if($stmt = $mysqli_con->prepare($sql)){
                    $stmt->bind_param('s',$type);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($food_item_id, $food_item_name, $food_item_cost, $food_item_description, $food_image_url, $food_item_type_name);

                    if($stmt->num_rows > 0){
                        while( $stmt->fetch()){
                            $items[$food_item_name] =  new Item();
                            $items[$food_item_name]->setID($food_item_id);
                            $items[$food_item_name]->setName($food_item_name);
                            $items[$food_item_name]->setCost($food_item_cost);
                            $items[$food_item_name]->setDescription($food_item_description);
                            $items[$food_item_name]->setImage($food_image_url==null?"images/default_tea.jpeg":$food_image_url);
                            $items[$food_item_name]->setType($food_item_type_name);
                        }
                    }
                    $stmt->close();
                }

                $sql = "SELECT food_item_name, ingredient_name 
                            FROM food_item_ingredient 
                            INNER JOIN ingredient on food_item_ingredient.ingredient_id=ingredient.ingredient_id 
                            INNER JOIN food_item on food_item_ingredient.food_item_id=food_item.food_item_id
                            INNER JOIN food_item_types ON food_item.food_item_id=food_item_types.food_item_id
                            INNER JOIN food_item_type ON food_item_type.food_item_type_id=food_item_types.food_item_type_id
                            WHERE food_item_type_name=?;";

                if($stmt = $mysqli_con->prepare($sql)){
                    $stmt->bind_param('s',$type);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($food_item_name, $ingredient_name);

                    if($stmt->num_rows > 0){
                        while( $stmt->fetch()){
                            $items[$food_item_name]->addIngredient($ingredient_name);
                        }
                    }
                    $stmt->close();
                }
            }
            $mysqli_con->close();
            return $items;
        }
    }
?>