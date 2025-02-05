<?php

require_once "CurriculoDao.php";

class CurriculoController
{
    public $curriculoDao;
    //public $data;
    public $option;

    public function __construct() {
        $this->curriculoDao = new CurriculoDao();

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

        $data['curriculos'] = $this->curriculoDao->findAll();
        require "listado.view.php";
    }

    public function create() {
        $data = $this->initForm();


        if (isset($_FILES['imagen'])) {
            $imagen = $_FILES['imagen'] ?? '';
            $localPathImagen = $imagen['name'];
        } else {
            $localPathImagen = null;
        }
        require "formulario.view.php";
    }

    public function store() {
        $data = $_POST['data'];

        $this->curriculoDao->save($data);

//        $this->data = $this->db->listCursos();
//        require "listado.php";
        $this->index();
    }

    public function show() {
        $id = $_GET['id'] ?? null;
        $data = $this->curriculoDao->findById($id);
        if ($data['aficiones']!=null) {
            $data['aficiones'] = explode(",",$data['aficiones']);
        } else
            $data['aficiones'] = [];

        if ($data['imagen']!=null) {
            $data['localPathImagen'] = $data['imagen'];
        } else {
            $data['localPathImagen'] = null;
        }

        $data['readonly'] = 'readonly';

        require "formulario.view.php";
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        $data = $this->curriculoDao->findById($id);
        if ($data['aficiones']!=null) {
            $data['aficiones'] = explode(",",$data['aficiones']);
        } else
            $data['aficiones'] = [];

        if ($data['imagen']!=null) {
            $data['localPathImagen'] = $data['imagen'];
        } else {
            $data['localPathImagen'] = null;
        }

        require "formulario.view.php";
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        $data = $this->curriculoDao->deleteById($id);
        $this->index();
    }

    private function initForm():array {
        $data['id'] = '';
        $data['nombre'] = '';
        $data['apellidos'] = '';
        $data['email'] = '';
        $data['fecha_nacimiento'] = '';
        $data['sexo'] = '';
        $data['aficiones'] = [];
        $data['estudios'] = '';
        $data['observaciones'] = '';
        $data['imagen'] = null;
        $data['localPathImagen'] = null;
        return $data;
    }

}

