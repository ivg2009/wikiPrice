<?php
class dbWorker{
    var $table;

    var $getAllData;
    var $getAllDataJoin = "";

    var $addData;

    var $updateData;

    function getAll(){
        $query = "select ";

        foreach ($this->getAllData as $key){
            $query .= $key['dbName'] . " as " . $key['jsonName'] . ', ';
        }

        $query = substr($query,0,-2);
        $query .= " from " . $this->table . " " . $this->getAllDataJoin;

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

    function get($id){
        $query = "select ";

        foreach ($this->getAllData as $key){
            $query .= $key["dbName"] . " as " . $key["jsonName"] . ', ';
        }

        $query = substr($query,0,-2);
        $query .= " from " . $this->table . " " . $this->getAllDataJoin . " where " . $this->table . ".id = '$id'";

        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

        $out = (object) array(
            'result' => 0
        );

        if(pg_num_rows($result) > 0){
            $row = pg_fetch_assoc($result);
            $arr = [];

            foreach ($this->getAllData as $key){
                $arr[$key["jsonName"]] = $row[$key["jsonName"]];
            }

            $out = (object) array(
                'result' => 1,
                'data'  => $arr
            );
        }

        return $out;
    }

    function add($data){
        $query = "insert into " . $this->table . "(";

        foreach ($this->addData as $key){
            $query .= $key["dbName"] . ', ';
        }

        $query = substr($query,0,-2);
        $query .= ") values (";

        foreach ($this->addData as $key){
            $query = $query . $data->$key["jsonName"] . ', ';
        }

        $query = substr($query,0,-2);
        $query .= ")";

        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

        $out = (object) array(
            'result' => 1
        );

        return $out;
    }

    function remove($id){
        $query = "delete from " . $this->table . " where id = '$id'";
        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

        $out = (object) array(
            'result' => 1
        );

        return $out;
    }

    function edit($data){
        $query = "update " . $this->table . " set ";

        foreach ($this->addData as $key){
            $query .= $key["dbName"] . ' = ' . $data->$key["jsonName"] . ", ";
        }

        $query = substr($query,0,-2);
        $query .= " where id = '$data->id'";


        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

        $out = (object) array(
            'result' => 1
        );

        return $out;
    }
}