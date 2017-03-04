<?php
    require_once(__DIR__ . "/../functions/items.php");

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
            $items = array();

            foreach( $this->menuItems as $key => $value ){
                if($value){
                    $items = array_merge($items, Items::getItemsByType($key));
                }
            }
            if( count($items) === 0 ){
            ?>
                <div class="col-md-12">
                    <div class="well text-center">
                        Whoops, it looks like this category is empty.
                        <br>
                        <a href="menu/">Click here to see the full menu.</a>
                    </div>
                </div>
            <?php
            } else {
                $previousType = "";
                foreach( $items as $item ){
                    if( $previousType !== $item->getType() ){
                        $previousType = $item->getType();
            ?>
                        <div class="col-md-12">
                            <div class="well"><?php echo(ucfirst($item->getType())); ?></div>
                        </div>
            <?php
                    }
            ?>
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo($item->getName()); ?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="<?php echo($item->getImage()); ?>" class="img-thumbnail" alt="coffee">
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php echo($item->getDescription()); ?>
                                            </div>
                                            <div class="col-md-12">
                                                <span class="glyphicon glyphicon-usd" aria-hidden="true"></span><strong><?php echo($item->getCost()); ?></strong>
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
    }
}
?>
