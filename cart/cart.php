<?php
    require_once(__DIR__ . '/../php/classes/cart.php');
    require_once(__DIR__ . '/../php/base/session.php');

    if( !isset($_POST['action']) || empty($_POST['action']) ){
        header('Location: ' . dirname($_SERVER['REQUEST_URI']) . "/");
        exit(0);
    }

    require_once(__DIR__ . "/../php/functions/items.php");

    switch($_POST['action']){
        case 'addToCart':
            if( !isset($_POST['itemId']) || empty($_POST['itemId']) ){
                http_response_code(400);
                echo "Invalid item ID";
                exit(0);
                break;
            }
            $item = Items::getItemById(intval($_POST['itemId']));
            if($item === null){
                http_response_code(400);
                echo "Invalid item ID";
                exit(0);
                break;
            }
            $_SESSION['cart']->addItem($item);
            http_response_code(200);
            exit(0);
            break;
        default:
            http_response_code(400);
            echo "Invalid action";
            exit(0);
            break;
    }
    exit(0);
?>