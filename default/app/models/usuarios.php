<?php

class Usuarios extends ActiveRecord{
    public function autenticar($password, $nombre){
        $auth= new Auth("model", "class: usuarios", "nombre: $nombre", "password: $password");

        return $auth->authenticate()? true: false;
    }

    public function isAut(){
        return Auth::is_valid();
    }
}