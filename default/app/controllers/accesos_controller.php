<?php

class AccesosController extends RestController{
    //Devuelve todos los registros del id indicado
    public function getAll()
    {
        $this->data = (new Accesos())->find();
    }
     //Devuelve un paginador con una cantidad limitada de recursos en la pagina indicada
    public function get_paginar($page=1)
    {
        $this->data = (new Accesos())->paginate("page: $page", 'order: id desc');
    }
    //Obtiene el recurso indicado en el id
    public function get_obtener($id)
    {
        if((new Accesos())->find_first((int) $id)){
            $this->data = (new Accesos())->find_first((int) $id);
        }else{
            http_response_code(400);
            $this->data = ['mensage'=>"Error, este registro no existe"];
        }
    }
    //Crea un nuevo registro para el recurso indicado con los datos enviados en el cuerpo json
    public function put_crear($id)
    {
        if( $data = json_decode(file_get_contents('php://input'))){
            $nReg = new Accesos();
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
            $nReg = new Accesos();
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
    //Elimina el id coincidente con {id} para el recurso indicado
    public function delete($id)
    {
        if (!(new Accesos())->delete((int) $id)) {
        }else{
            http_response_code(400);
            $this->data = ['mensage'=>"Error, este registro no existe"];
        }
    }

}