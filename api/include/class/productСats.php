<?php

require_once __ROOT__ . "include/dbWorker.php";

class ProductCats extends dbWorker
{
    var $table = 'product_cats';

    var $getAllData = array(
        array(
            'dbName'    => 'id',
            'jsonName'  => 'id'
        ),
        array(
            'dbName'    => 'name',
            'jsonName'  => 'name'
        ),
        array(
            'dbName'    => 'description',
            'jsonName'  => 'description'
        ),
    );

    var $addData = array(
        array(
            'dbName'    => 'name',
            'jsonName'  => 'name'
        ),
        array(
            'dbName'    => 'description',
            'jsonName'  => 'description'
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
    );
}