<!-- Connexion à la base de données avec PDO -->
<!-- Configurer PDO pour générer des exceptions en cas d'erreur SQL -->
<!-- afficher le problème avec la méthode getMessage,getFile(),getLine() -->
<!-- Fermer la connexion lorsque vous avez terminé -->

<?php 
    $host="localhost";
    $DB ="gestioncommande";
    $USER ="root";
    $PASSWORD="Spartacus14@";

    function connect ($host,$DB, $USER,$PASSWORD){
        try{
            // Connexion à la base de données avec PDO
            $pdo = new PDO("mysql:host=$host;dbname=$DB",$USER,$PASSWORD);
            // Configurer PDO pour générer des exceptions en cas d'erreur SQL
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connexion réussie à la base de données.";
            return $pdo; 
            //afficher le problème avec la méthode getMessage
        }catch (PDOException $exption){
            die("La connexion à la base de données a échoué : " .$exption->getMessage(). "" .$exption->getFile(). "".$exption->getLine());
        }
    }
    // Fermer la connexion lorsque vous avez terminé
    $pdo = null;
?>
 

<!-- 
class Database {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $pdo;

    public function __construct($host, $dbname, $username, $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect() {
        try {
            // Connexion à la base de données avec PDO
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);

            // Configurer PDO pour générer des exceptions en cas d'erreur SQL
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->pdo;
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, afficher l'erreur et arrêter le script
            die("La connexion à la base de données a échoué : " . $e->getMessage());
        }
    }

    public function disconnect() {
        // Fermer la connexion à la base de données
        $this->pdo = null;
    }

    public function getPDO() {
        // Retourner l'objet PDO pour effectuer des opérations sur la base de données
        return $this->pdo;
    }
}

// Exemple d'utilisation de la classe
$host = "localhost";
$dbname = "votre_base_de_donnees";
$username = "votre_utilisateur";
$password = "votre_mot_de_passe";

$database = new Database($host, $dbname, $username, $password);
$database->connect();

// Vous pouvez utiliser $database->getPDO() pour obtenir l'objet PDO et exécuter des requêtes SQL
// ...

// Fermer la connexion lorsque vous avez terminé
$database->disconnect();
?>
 -->

 <!-- une methode -->
 <!-- 
class Database extends PDO {
    private $host;
    private $dbname;
    private $username;
    private $password;

    public function __construct($host, $dbname, $username, $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;

        // Call the parent constructor (PDO) with the database connection details
        parent::__construct("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);

        // Configuring PDO for exceptions
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}

// Example usage
$host = "localhost";
$dbname = "your_database";
$username = "your_username";
$password = "your_password";

try {
    $db = new Database($host, $dbname, $username, $password);

    // Use $db as a regular PDO object for executing queries
    $result = $db->query("SELECT * FROM your_table");
    foreach ($result as $row) {
        // Process each row
        echo $row['column_name'] . "<br>";
    }
} catch (PDOException $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}
 -->