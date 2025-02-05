<?php

    require_once "TraficoDao.php";

    class TraficoController
    {
        public $traficoDao;
        public $data;
        public $option;
        public function __construct()
        {
            $this->traficoDao = new TraficoDao();
            if(!isset($_GET['option'])) {
                $this->index();
            } else {
                switch($_GET['option']) {
                    case "create": $this->crear(); break;
                    case "store": $this->store(); break;
                    case "show": $this->show(); break;
                    case "edit": $this->edit(); break;
                    case "delete": $this->delete(); break;
                }
            }
        }

        public function index() {
            $data['trafico'] = $this->traficoDao->findAll();
            require "listado.view.php";
        }

        public function crear() {
            $data = $this->initForm();
            require "formulario.view.php";
        }

        public function store() {
            $data = $_POST;
            if (isset($_FILES['imagen'])) {
                $imagen = $_FILES['imagen'];
                $localPathImagen = './img/imgProg/' . $imagen['name'];
                move_uploaded_file($imagen["tmp_name"], $localPathImagen);
                $data['imagen'] = $imagen['name'];
            } else {
                $data['imagen'] = null;
            }

            $this->traficoDao->save($data);
            $this->index();
        }

        public function show() {
            $id = $_GET['id'] ?? null;

            $data = $this->traficoDao->findById($id);
            $data = $data[0];
            $localPathImagen = './img/imgProg/';
            if ($data['imagen']!=null) {
                $data['localPathImagen'] = $localPathImagen.$data['imagen'];
            } else {
                $data['localPathImagen'] = null;
            }
            $data['readonly'] = 'readonly';
            require "formulario.view.php";
        }

        public function edit() {
            $id = $_GET['id'];
            $data = $this->traficoDao->findById($id);
            $data = $data[0];
            $localPathImagen = './img/imgProg/';
            if ($data['imagen']!=null) {
                $data['localPathImagen'] = $localPathImagen.$data['imagen'];
            } else {
                $data['localPathImagen'] = null;
            }
            require "formulario.view.php";
        }

        private function delete()
        {
            $id = $_GET['id'] ?? null;
            $this->traficoDao->delete($id);
            $this->index();
        }

        private function initForm():array {
        $data['id'] = '';
        $data['matricula'] = '';
        $data['modelo'] = '';
        $data['fecha_inscrip'] = '';
        $data['imagen'] = null;
        return $data;
    }
    }