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

        function render(){
            if($this->getCount() > 0){
                $counter = 0;
                foreach($this->items as $item){
                    $counter++;
                ?>
                    
                    <div class="row">
                        <div class="col-xs-3 col-sm-2">
                            <img src="<?php echo($item->getImage()); ?>" class="img-thumbnail" alt="<?php echo($item->getName()); ?>">
                        </div>
                        <div class="col-xs-9 col-sm-10">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4><?php echo($item->getName()); ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <?php echo($item->getDescription()); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    if($counter !== $this->getCount()){
                        echo("<hr>");
                    }
                }
            } else {
            ?>
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Your cart is empty.</h4>
                    </div>
                </div>
            <?php
            }
        }

        function renderCosts(){
            foreach($this->items as $item){
            ?>
                <div class="row">
                    <div class="col-xs-8">
                        <em><?php echo($item->getName()); ?></em>
                    </div>
                    <div class="col-xs-4 text-right">
                        $<?php echo(number_format($item->getCost(),2)); ?>
                    </div>
                </div>
                <div class="spacer"></div>
            <?php
            }
            if($this->getCount() > 0){
            ?>
                <hr>
            <?php
            }
            ?>
                <div class="row">
                    <div class="col-xs-8">
                        <strong>Total</strong>
                    </div>
                    <div class="col-xs-4 text-right">
                        <strong>$<?php echo(number_format($this->getTotalCost(),2)); ?></strong>
                    </div>
                </div>
            <?php
        }
    }
?>
