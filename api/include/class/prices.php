<?php

require_once __ROOT__ . "include/dbWorker.php";

class Prices extends dbWorker
{
    var $table = 'prices';

    var $getAllData = array(
        array(
            'dbName'    => 'prices.id',
            'jsonName'  => 'id'
        ),
        array(
            'dbName'    => 'prices.time',
            'jsonName'  => 'time'
        ),
        array(
            'dbName'    => 'prices.rating',
            'jsonName'  => 'rating'
        ),
        array(
            'dbName'    => 'prices.product_id',
            'jsonName'  => 'product_id'
        ),
        array(
            'dbName'    => 'prices.store_id',
            'jsonName'  => 'store_id'
        ),
        array(
            'dbName'    => 'prices.author_id',
            'jsonName'  => 'author_id'
        ),
        array(
            'dbName'    => 'stores.name',
            'jsonName'  => 'store_name'
        ),
        array(
            'dbName'    => 'users.name',
            'jsonName'  => 'author_name'
        ),
        array(
            'dbName'    => 'products.name',
            'jsonName'  => 'product_name'
        )
    );

    var $getAllDataJoin = "join users ON prices.author_id = users.id join stores on prices.store_id = stores.id join products on prices.product_id = products.id";

    var $addData = array(
        array(
            'dbName'    => 'name',
            'jsonName'  => 'name'
        ),
        array(
            'dbName'    => 'description',
            'jsonName'  => 'description'
        ),
        array(
            'dbName'    => 'image',
            'jsonName'  => 'image'
        ),
        array(
            'dbName'    => 'creator_id',
            'jsonName'  => 'creator_id'
        ),
    );

    var $updateData = array(
        array(
            'dbName'    => 'name',
            'jsonName'  => 'name'
        ),
        array(
            'dbName'    => 'description',
            'jsonName'  => 'description'
        ),
        array(
            'dbName'    => 'image',
            'jsonName'  => 'image'
        ),
        array(
            'dbName'    => 'creator_id',
            'jsonName'  => 'creator_id'
        ),
    );

    function getAll($productId)
    {
        $query = "select ";

        foreach ($this->getAllData as $key){
            $query .= $key['dbName'] . " as " . $key['jsonName'] . ', ';
        }

        $query = substr($query,0,-2);
        $query .= " from " . $this->table . " " . $this->getAllDataJoin . " where " . $this->table . ".product_id = '$productId'";

        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

        $out = (object) array(
            'result' => 0
        );

        if(pg_num_rows($result) > 0){

            $arr = [];

            while ($row = pg_fetch_assoc($result)) {


                $arrItem = [];
                foreach ($this->getAllData as $key){
                    $arrItem[$key["jsonName"]] = $row[$key["jsonName"]];
                }
                array_push($arr, $arrItem);
            }

            $out = (object) array(
                'result' => 1,
                'data'  => $arr
            );
        }

        return $out;
    }
}