<?php
    function getMenuCounts(){
        $menuCount = array(
            "specials"   => 0,
            "sandwiches" => 0,
            "wraps"      => 0,
            "salads"     => 0,
            "sides"      => 0,
            "drinks"     => 0
        );

        $valid_database = false;
        $database_key = file_get_contents('/api-keys/database.key');

        foreach( $menuCount as $key => $value ){
            $mysqli_con = new mysqli("localhost","http",$database_key,"glennsforestcafe");
            if(!mysqli_connect_errno()){
                $valid_database = true;

                $sql = "SELECT COUNT(*) as 'items', food_item_type_name from food_item_type join food_item_types on food_item_types.food_item_type_id=food_item_type.food_item_type_id GROUP BY food_item_types.food_item_type_id;";
                
                if($stmt = $mysqli_con->prepare($sql)){
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($items, $food_item_type_name);
                    if($stmt->num_rows > 0){
                        while( $stmt->fetch() ){
                            $menuCount[$food_item_type_name] = $items;
                        }
                    }
                    $stmt->close();
                } else {
                    $valid_database = false;
                }
            } else {
                $valid_database = false;
            }
            $mysqli_con->close();
        }
        return $menuCount;
    }
?>