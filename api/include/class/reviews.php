<?php

require_once __ROOT__ . "include/dbWorker.php";

class Reviews extends dbWorker
{
    var $table = 'product_reviews';

    var $getAllData = array(
        array(
            'dbName'    => 'product_reviews.id',
            'jsonName'  => 'id'
        ),
        array(
            'dbName'    => 'product_reviews.text',
            'jsonName'  => 'text'
        ),
        array(
            'dbName'    => 'product_reviews.rating',
            'jsonName'  => 'rating'
        ),
        array(
            'dbName'    => 'product_reviews.author_id',
            'jsonName'  => 'author_id'
        ),
        array(
            'dbName'    => 'users.name',
            'jsonName'  => 'user_name'
        ),
    );
    var $getAllDataJoin = "join users ON product_reviews.author_id = users.id";

    var $addData = array(
        array(
            'dbName'    => 'text',
            'jsonName'  => 'text'
        ),
        array(
            'dbName'    => 'rating',
            'jsonName'  => 'rating'
        ),
        array(
            'dbName'    => 'author_id',
            'jsonName'  => 'author_id'
        ),
    );

    var $updateData = array(
        array(
            'dbName'    => 'text',
            'jsonName'  => 'text'
        ),
        array(
            'dbName'    => 'rating',
            'jsonName'  => 'rating'
        ),
        array(
            'dbName'    => 'author_id',
            'jsonName'  => 'author_id'
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