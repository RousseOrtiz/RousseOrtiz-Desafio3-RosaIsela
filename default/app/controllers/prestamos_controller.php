<?php

class PrestamosController extends RestController{
    public function getAll()
    {
        $this->data = (new Prestamos())->find();
    }
    public function get_paginar($page=1)
    {
        $this->data = (new Prestamos())->paginate("page: $page", 'order: id desc');
    }

    public function get_obtener($id)
    {
        if((new Prestamos())->find_first((int) $id)){
            $this->data = (new Prestamos())->find_first((int) $id);
        }else{
            http_response_code(400);
            $this->data = ['mensage'=>"Error, este registro no existe"];
        }
    }
    //Crea un nuevo registro para el recurso indicado con los datos enviados en el cuerpo json
    public function put_crear($id)
    {
        if( $data = json_decode(file_get_contents('php://input'))){
            $nReg = new Prestamos();
        foreach ($data as $key => $id){
            $nReg->$key = $id;
        }
        $nReg->save();
        $this->data= $nReg;
        }else{
            http_response_code(400);
            $this->data = ['mensage'=>"Error, no se creo el registro"];
        }
    }
    //Edita un registro existente del tipo indicado en el recurso, usando la información enviada en el cuerpo json
    public function patch_editar(){
        if( $data = json_decode(file_get_contents('php://input'))){
            $nReg = new Prestamos();
        foreach ($data as $key => $dataR){
            $nReg->$key = $dataR;
        }
        $nReg->save();
        $this->data= $nReg;
        }else{
            http_response_code(400);
            $this->data = ['mensage'=>"Error, no se creo el registro"];

        }
    }
    public function delete($id)
    {
        if (!(new Prestamos())->delete((int) $id)) {
        }else{
            http_response_code(400);
            $this->data = ['mensage'=>"Error, este registro no existe"];
        }
    }

}