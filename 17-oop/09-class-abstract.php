<?php
$title = '09 - Class Abstract';
$description = 'A class that cannot be instantiated, only extended from.';

include_once 'template/header.php';
echo '<section>';

abstract class DatabaseConnection {
    protected $connection;
    
    public function __construct(
        private $host = 'localhost',
        private $database = 'pokeadso_a',
        private $user = 'root',
        private $password = ''
    ) {
        $this->connect();
    }
    
    protected function connect(): void {
        $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
        
        try {
            $this->connection = new PDO($dsn, $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("❌ Error de conexión: " . $e->getMessage());
        }
    }
    
    protected function disconnect(): void {
        $this->connection = null;
    }
}

class pokemons extends DatabaseConnection {
    public function list(): string {
        try {
            $query = "SELECT id, name, type FROM pokemons ORDER BY id";
            $stmt = $this->connection->query($query);
            $pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $output = "<table>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                        </tr>";
            
            foreach ($pokemons as $pokemon) {
                $output .= "<tr>
                            <td>{$pokemon['id']}</td>
                            <td>{$pokemon['name']}</td>
                            <td>{$pokemon['type']}</td>
                        </tr>";
            }
            
            return $output . '</table>';
            
        } catch (PDOException $e) {
            return '';
        } finally {
            $this->disconnect();
        }
    }
}

$pokemonList = new pokemons();
echo $pokemonList->list();

include_once 'template/footer.php';