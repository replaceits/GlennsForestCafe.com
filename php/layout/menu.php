<?php

    class Menu{
        private $menuItems = array(
            "specials"   => false,
            "sandwiches" => false,
            "wraps"      => false,
            "salads"     => false,
            "sides"      => false,
            "drinks"     => false
        );

        public function parseGet(){
            $atLeastOne = false;
            foreach( $this->menuItems as $key => &$value ){
                if(isset($_GET[$key])){
                    $value = ($_GET[$key] === "1");
                    if($value && !$atLeastOne){
                        $atLeastOne = true;
                    }
                }
            }
            if(!$atLeastOne){
                foreach( $this->menuItems as &$value ){
                    $value = true;
                }
            }
        }

        public function render(){
            $valid_database = false;
            $database_key = file_get_contents('/api-keys/database.key');

            foreach( $this->menuItems as $key => $value ){
                if($value){
                    $mysqli_con = new mysqli("localhost","http",$database_key,"glennsforestcafe");
                    if(!mysqli_connect_errno()){
                        $valid_database = true;

                        // I may want to name these tables something different, everything just blends into "food"
                        $sql = "SELECT food_item_name, food_item_cost, food_item_description, food_image_url, food_item_type_name FROM food_item
                                    join food_item_types on food_item.food_item_id=food_item_types.food_item_id
                                    join food_item_type on food_item_type.food_item_type_id=food_item_types.food_item_type_id
                                    join food_image on food_image.food_item_id=food_item.food_item_id
                                    WHERE food_item_type_name=?;";
                                    
                        if($stmt = $mysqli_con->prepare($sql)){
                            $stmt->bind_param('s',$key);
                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($food_item_name, $food_item_cost, $food_item_description, $food_image_url, $food_item_type_name);
                            if($stmt->num_rows > 0){
                            ?>
                                <div class="col-md-12">
                                    <div class="well"><?php echo(ucfirst($key)); ?></div>
                                </div>
                            <?php
                                while( $stmt->fetch()){
                                ?>
                                    <div class="col-md-3">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><?php echo($food_item_name); ?></h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <img src="<?php echo($food_image_url); ?>" class="img-thumbnail" alt="coffee">
                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <?php echo($food_item_description); ?>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <span class="glyphicon glyphicon-usd" aria-hidden="true"></span><strong><?php echo($food_item_cost); ?></strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer text-center">
                                                <button class="btn btn-primary">Add to order</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php
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
            }
        }
    }
?>
