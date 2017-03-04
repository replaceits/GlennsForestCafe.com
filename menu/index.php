<?php
    require_once('../php/classes/cart.php');
    require_once('../php/base/session.php');
    require_once('../php/layout/menu.php');

    $menu = new Menu();
    $menu->parseGet();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../php/base/header.php'); ?>
    </head>

    <body>
        <?php include('../php/layout/navbar.php'); ?>

        <div id="cart-alert-container" class="container hidden" style="position: fixed; z-index: 50; top: 75px; left: 50%; transform: translateX(-50%); opacity: 0.98">
            <div id="cart-alert" class="alert alert-success text-center" role="alert"></div>
        </div>

        <div class="container">
            <div class="panel panel-default" style="background: rgba(255,255,255,1);">
                <div class="panel-body">
                    <div class="row">
                        <?php
                            $menu->render();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            window.addEventListener('DOMContentLoaded', function() {
                $('.add-to-order').click(function(){
                    let itemId = $(this).attr('id');
                    let itemName = $(this).attr('name');
                    $.ajax({
                        method: 'POST',
                        url: 'cart/cart.php',
                        cache: false,
                        data: "action=addToCart&itemId="+itemId
                    }).done( function( msg ){
                        $('#cart-alert').html(itemName + ' was added to your <a href="cart/">cart</a>!').hide().fadeIn(250, function(){
                            setTimeout(function( cartAlert ) {
                                cartAlert.fadeOut(1000);
                            }, 1000, $(this));
                        });
                        $('#cart-alert-container').removeClass('hidden');
                        $('.cart-header-items').text(parseInt($('.cart-header-items').text()) + 1);
                    }).fail( function( jqXHR, textStatus ){
                        $('#cart-alert').html('We\'re having trouble adding ' + itemName + ' to your cart <a href="cart/">cart</a>...').hide().fadeIn(250, function(){
                            setTimeout(function( cartAlert ) {
                                cartAlert.fadeOut(1000);
                            }, 1000, $(this));
                        });
                        $('#cart-alert-container').removeClass('hidden');
                    });
                });
            });
        </script>
    </body>
</html>