<?php

require_once __ROOT__ . "include/dbWorker.php";

class Stores extends dbWorker{
    var $table = 'stores';

    var $getAllData = array(
        array(
            'dbName'    => 'stores.id',
            'jsonName'  => 'id'
        ),
        array(
            'dbName'    => 'stores.name',
            'jsonName'  => 'name'
        ),
        array(
            'dbName'    => 'stores.description',
            'jsonName'  => 'description'
        ),
        array(
            'dbName'    => 'stores.lat',
            'jsonName'  => 'lat'
        ),
        array(
            'dbName'    => 'stores.lon',
            'jsonName'  => 'lon'
        ),
        array(
            'dbName'    => 'cities.id',
            'jsonName'  => 'city_id'
        ),
        array(
            'dbName'    => 'cities.name',
            'jsonName'  => 'city_name'
        ),
    );
    var $getAllDataJoin = "join cities ON stores.city_id = cities.id";

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
            'dbName'    => 'lat',
            'jsonName'  => 'lat'
        ),
        array(
            'dbName'    => 'lon',
            'jsonName'  => 'lon'
        ),
        array(
            'dbName'    => 'city_id',
            'jsonName'  => 'city_id'
        )
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
            'dbName'    => 'lat',
            'jsonName'  => 'lat'
        ),
        array(
            'dbName'    => 'lon',
            'jsonName'  => 'lon'
        ),
        array(
            'dbName'    => 'city_id',
            'jsonName'  => 'city_id'
        )
    );
}