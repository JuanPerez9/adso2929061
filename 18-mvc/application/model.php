<?php
class Model {

    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    // Listar
    public function listPokemons(){
        $stmt = $this->db->prepare("SELECT * FROM pokemons");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // listar trainer
    public function listTrainers(){
        $stmt = $this->db->prepare("SELECT id, name FROM trainers");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear
    public function createPokemon($name, $type, $trainerId){
        $stmt = $this->db->prepare(
        "INSERT INTO pokemons (name, type, trainer_id)
         VALUES (?, ?, ?)"
    );
        return $stmt->execute([$name, $type, $trainerId]);
    }

    // Buscar
    public function getPokemon($id){
        $stmt = $this->db->prepare(
            "SELECT * FROM pokemons WHERE id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Editar
    public function updatePokemon($id, $name, $type){
        $stmt = $this->db->prepare(
            "UPDATE pokemons SET name = ?, type = ? WHERE id = ?"
        );
        return $stmt->execute([$name, $type, $id]);
    }

    // Eliminar
    public function deletePokemon($id){
        $stmt = $this->db->prepare(
            "DELETE FROM pokemons WHERE id = ?"
        );
        return $stmt->execute([$id]);
    }
}
