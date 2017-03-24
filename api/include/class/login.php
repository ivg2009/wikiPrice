<?php
class Login
{

    function loginMe($mail, $pass, $device){

        $mail = pg_escape_string($mail);

        $query = "select * from users WHERE email='$mail'";
        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

        $password = hash('sha256', trim($mail).trim($pass));

        $result = pg_fetch_object($result);

        if($result->password == $password){
            $token = hash('sha256', hash('sha256', trim($mail).trim($device)));

            $id = $result->id;
            $name = $result->name;
            $phone = $result->phone;
            $group_id = $result->group_id;

            $query = "update users set token='$token' WHERE id='$id'";
            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());


            $out = (object) array(
                'result' => 1,
                'data'  => array(
                    'id'        => $id,
                    'token'     => $token,
                    'name'      => $name,
                    'email'     => $mail,
                    'phone'     => $phone,
                    'group_id'  => $group_id
                )
            );

        } else{
            $out = (object) array(
                'result' => 0
            );
        }

        return $out;
    }

    function register($data){

        $email = pg_escape_string($data->email);

        $query = "SELECT id FROM users WHERE email='$email'";
        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

        if(pg_num_rows($result) > 0)
        {

            $out = (object) array(
                'result' => 0,
                'error'  => 1
            );

        } else{
            $name = pg_escape_string($data->name);
            $phone = pg_escape_string($data->phone);
            $pass = hash('sha256', trim($email).trim($data->password));

            $query = "INSERT INTO users(name, email, phone, password, group_id) VALUES ('$name', '$email', '$phone', '$pass', 1)";
            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

            $out = loginClass::login($data->email, $data->password, $data->device);

        }

        return $out;
    }

    function getUserFromToken($token){
        if($token){
            $query = "select * from users WHERE token='$token'";
            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
            $result = pg_fetch_object($result);
        }

        return $result;
    }

    function logout($token){
        if($token){
            $query = "update users set token='' WHERE token='$token'";
            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

            $out = (object) array(
                'result' => 1
            );
        } else{
            $out = (object) array(
                'result' => 0
            );
        }

        return $out;
    }
}