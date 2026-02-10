<?php
class Controller {

    public $load;
    public $model;

    public function __construct(){
        $this->load = new Load();
        $this->model = new Model();
        $this->handleRequest();
    }

    private function handleRequest(){
        $action = $_GET['action'] ?? 'list';

        switch ($action) {
            case 'create':
                $this->create();
                break;

            case 'edit':
                $this->edit();
                break;

            case 'delete':
                $this->delete();
                break;

            default:
                $this->list();
        }
    }

    private function list(){
        $pokemons = $this->model->listPokemons();
        $this->load->view('welcome.php', $pokemons);
    }

    private function create(){
        if ($_POST) {
            $this->model->createPokemon(
                $_POST['name'],
                $_POST['type'],
                $_POST['trainer_id']
            );
            header('Location: index.php');
            exit;
        }

        $trainers = $this->model->listTrainers();
        $this->load->view('create.php', $trainers);
    }

    private function edit(){
        $id = $_GET['id'] ?? null;

        if ($_POST && $id) {
            $this->model->updatePokemon(
                $id,
                $_POST['name'],
                $_POST['type']
            );
            header('Location: index.php');
            exit;
        }

        $pokemon = $this->model->getPokemon($id);
        $this->load->view('edit.php', $pokemon);
    }

    private function delete(){
        $id = $_GET['id'];
        $this->model->deletePokemon($id);
        header('Location: index.php');
        exit;
    }
}

