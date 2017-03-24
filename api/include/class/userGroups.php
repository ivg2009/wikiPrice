<?php

require_once __ROOT__ . "include/dbWorker.php";

class UserGroups extends dbWorker
{
    var $table = 'user_groups';

    var $getAllData = array(
        array(
            'dbName'    => 'user_groups.id',
            'jsonName'  => 'id'
        ),
        array(
            'dbName'    => 'user_groups.name',
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