<?php

require_once __ROOT__ . "include/dbWorker.php";

class Cities extends dbWorker{
    var $table = 'cities';

    var $getAllData = array(
        array(
            'dbName'    => 'cities.id',
            'jsonName'  => 'id'
        ),
        array(
            'dbName'    => 'cities.name',
            'jsonName'  => 'name'
        )
    );

    var $addData = array(
        array(
            'dbName'    => 'name',
            'jsonName'  => 'name'
        )
    );

    var $updateData = array(
        array(
            'dbName'    => 'name',
            'jsonName'  => 'name'
        )
    );
}