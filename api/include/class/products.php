<?php

require_once __ROOT__ . "include/dbWorker.php";

class Products extends dbWorker
{
    var $table = 'products';

    var $getAllData = array(
        array(
            'dbName'    => 'products.id',
            'jsonName'  => 'id'
        ),
        array(
            'dbName'    => 'products.name',
            'jsonName'  => 'name'
        ),
        array(
            'dbName'    => 'products.description',
            'jsonName'  => 'description'
        ),
        array(
            'dbName'    => 'products.image',
            'jsonName'  => 'image'
        ),
        array(
            'dbName'    => 'products.creator_id',
            'jsonName'  => 'creator_id'
        ),
        array(
            'dbName'    => 'users.name',
            'jsonName'  => 'name'
        )
    );

    var $getAllDataJoin = "join users ON products.creator_id = users.id";

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
}