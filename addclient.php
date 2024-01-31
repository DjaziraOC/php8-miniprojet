<?php
$clients=true;
include_once __DIR__ . "/header.php";
include_once __DIR__ . "/main.php";
$errors =[] ;
//---s'assurer qu'aucun champ de formulaire est vide 
if(!empty($_POST["nom"])&&!empty($_POST["prenom"]) && !empty($_POST["telephone"])){
    try{
        $query = "INSERT INTO  client (nom,prenom,telephone) VALUES (:nom,:prenom,:telephone)";
        $pdoStmt= $pdo->prepare($query);
        // $pdoStmt->execute(["nom"=>$_POST["nom"], "prenom"=>$_POST["prenom"],"telephone"=>$_POST["telephone"]]);
        $pdoStmt->bindParam(':nom', $_POST["nom"]);
        $pdoStmt->bindParam(':prenom', $_POST["prenom"]);
        $pdoStmt->bindParam(':telephone', $_POST["telephone"]);
        //l'excution de la requête 
        if ($message=$pdoStmt->execute()) {
            // echo "les données de formulaire sont sauvegarder dans la BD avec succée.";
            $messageS ['messages']="les données de formulaire sont sauvegarder dans la BD avec succée.";
        } else {
            echo "Erreur d'execution SQL statement: " . $pdoStmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    } finally {
        // Fermeture du curseur pour libérer les ressources du curseur.
            $pdoStmt->closeCursor();
        // header(header:"/Location:clients.php");
    }
} 
?>
    <h1 class="mt-5">Ajouter un client</h1>
    <form class="row g-3" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <div class="col-md-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="col-md-6">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="col-md-12">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" required>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit" name="submit">Ajouter</button>
        </div>
        <div class="alert alert-primary d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
            <div><?= isset($message)? '<div class="mt-5">'.$messageS ['messages'] .'</div>':''?> </div>
        </div>
    </form>
</div>
</main>

<?php
  include_once ("footer.php");
?>
