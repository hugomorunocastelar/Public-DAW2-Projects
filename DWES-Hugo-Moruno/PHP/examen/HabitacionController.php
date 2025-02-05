<?php

require_once "HabitacionDao.php";

class HabitacionController
{
    public $habitacionDao;
    public $option;

    public function __construct() {
        $this->habitacionDao = new HabitacionDao();

        if(!isset($_GET['option'])) {
            $this->index();
        } else {
            switch($_GET['option']) {
                case "create": $this->create(); break;
                case "store": $this->store(); break;
                case "show": $this->show(); break;
                case "edit": $this->edit(); break;
                case "delete": $this->delete(); break;
            }
        }
    }

    public function index() {

        $data['habitaciones'] = $this->habitacionDao->findAll();
        require "listado.view.php";
    }

    public function create()
    {
        $data = $this->initForm();
        require "formulario.view.php";
    }


    private function initForm():array {
        $data['imagen'] = null;
        $data['localPathImagen'] = null;
        $data['id'] = '';
        $data['numero'] = '';
        $data['fumador'] = '';
        $data['capacidad'] = '';
        $data['uso'] = '';
        $data['servicios'] = [];
        return $data;
    }

    public function store()
    {
        $data = $_POST['data'];
        if (isset($_FILES['imagen']))
        {
            $imagen = $_FILES['imagen'] ?? '';
            $localPathImagen = './imagenes/' . $imagen['name'];
            $pathImagen = $_SERVER['DOCUMENT_ROOT'].$localPathImagen;
            move_uploaded_file($imagen["tmp_name"], $pathImagen);
            $data['imagen'] = $imagen['name'];
        }
        else
        {
            $data['imagen'] = null;
        }
        if (empty($data['id']))
        {
            $this->habitacionDao->save($data);
        }
        else
        {
            $this->habitacionDao->update($data['id'], $data);
        }
        $this->index();
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        $data = $this->habitacionDao->findById($id);
        if ($data['servicios']!=null)
        {
            $data['servicios'] = explode(",",$data['servicios']);
        }
        else
            $data['servicios'] = [];

        if ($data['imagen']!=null)
        {
            $data['localPathImagen'] = $data['imagen'];
        }
        else
        {
            $data['localPathImagen'] = null;
        }

        require "formulario.view.php";
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        $data = $this->habitacionDao->deleteById($id);
        $this->index();
    }

    public function show() {
        $id = $_GET['id'] ?? null;
        $data = $this->habitacionDao->findById($id);
        if ($data['servicios']!=null)
        {
            $data['servicios'] = explode(",",$data['servicios']);
        }
        else
            $data['servicios'] = [];

        if ($data['imagen']!=null)
        {
            $localPathImagen = './imagenes/' . $data['imagen'];
            $data['localPathImagen'] = $localPathImagen;
        }
        else
        {
            $data['localPathImagen'] = null;
        }

        $data['readonly'] = 'readonly';
        require "formulario.view.php";
    }

}

