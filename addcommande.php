<?php
$commandes=true;
include_once __DIR__ . "/header.php";
include_once __DIR__ . "/main.php";
$errors =[] ;
//---s'assurer qu'aucun champ de formulaire est vide 
if(!empty($_POST["idclient"])&&!empty($_POST["date_commande"])){
    try{
        $query = "INSERT INTO  commande (idclient,date_commande) VALUES (:idclient,:date_commande)";
        $pdoStmt= $pdo->prepare($query);
        // $pdoStmt->execute(["nom"=>$_POST["nom"], "prenom"=>$_POST["prenom"],"telephone"=>$_POST["telephone"]]);
        $pdoStmt->bindParam(':idclient', $_POST["idclient"]);
        $pdoStmt->bindParam(':date_commande', $_POST["date_commande"]);
        //l'excution de la requête 
        if ($message=$pdoStmt->execute()){
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
    <h1 class="mt-5">Ajouter une commande</h1>
    <form class="row g-3" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <div class="col-md-6">
            <label for="idclient" class="form-label">ID client</label>
            <input type="text" class="form-control" id="idclient" name="idclient" required>
        </div>
        <div class="col-md-6">
            <label for="date_commande" class="form-label">Date</label>
            <input type="text" class="form-control" id="date_commande" name="date_commande" required>
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
