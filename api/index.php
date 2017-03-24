<?php

define("__ROOT__", "/var/www/www-root/data/www/wikiprice.crystal-web.ru/api/");

require_once "include/dbconn.php";
require_once "include/class/login.php";

header("Content-type: application/json");

$action = $_REQUEST["action"];
$subAction = $_REQUEST["subaction"];

$header = getallheaders();
$header = $header['Authorization'];

$permissionError = (object) array(
    'result' => 2
);

$login = new Login();

$user = null;

if($header) {
    $user = $login->getUserFromToken($header);
}

$echo = null;
$data = json_decode(file_get_contents('php://input'));

switch ($action){
    case 'login':
        if($header) {
            $login->logout($header);
        }
        $echo = $login->loginMe($data->email, $data->password, $data->device);

        break;
    case 'register':
        if($header) {
            $login->logout($header);
        }
        $echo = $login->register($data);

        break;

    case 'stores':
        require_once "include/class/stores.php";

        $store = new Stores();
        switch ($subAction){
            case 'all':
                $echo = $store->getAll();
                break;

            case 'id':
                $echo = $store->get($data->id);
                break;

            case 'add':
                if($user->group_id == 1) $echo = $store->add($data);
                else $echo = $permissionError;
                break;

            case 'remove':
                if($user->group_id == 1) $echo = $store->remove($data->id);
                else $echo = $permissionError;
                break;

            case 'update':
                if($user->group_id == 1) $echo = $store->edit($data);
                else $echo = $permissionError;
                break;
        }

        break;

    case 'cities':
        require_once "include/class/cities.php";

        $city = new Cities();

        switch ($subAction){
            case 'all':
                $echo = $city->getAll();
                break;

            case 'id':
                $echo = $city->get($data->id);
                break;
        }

        break;

    case 'prices':
        require_once "include/class/prices.php";

        $price = new Prices();
        $echo = $price->getAll($data->id);

        break;

}

echo json_encode($echo);
pg_close($db);