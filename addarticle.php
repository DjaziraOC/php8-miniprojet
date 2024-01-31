<?php
$articles=true;
include_once __DIR__ . "/header.php";
include_once __DIR__ . "/main.php";
$errors =[] ;
//---s'assurer qu'aucun champ de formulaire est vide 
if(!empty($_POST["description"])&&!empty($_POST["prix_unitaire"])){
    if(empty( $errors['global'])){
        try{
            $query = "INSERT INTO  article (description,prix_unitaire) VALUES (:description,:prix_unitaire)";
            $pdoStmt= $pdo->prepare($query);
            $pdoStmt->bindParam(':description', $_POST["description"]);
            $pdoStmt->bindParam(':prix_unitaire', $_POST["prix_unitaire"]);
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
            //    header(header:"/Location:clients.php");
            //    exit;

        }

    }
} 
?>
    <h1 class="mt-5">Ajouter un article</h1>
    <form class="row g-3" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <div class="col-12">
            <label for="floatingTextarea">Description</label>
            <textarea class="form-control" placeholder="Mettre la description de l'article" id="floatingTextarea" name="description" required></textarea>
        </div>
        <div class="col-12">
            <label for="prix_unitaire" class="form-label">Prix_unitaire</label>
            <input type="decimal" class="form-control" id="prix_unitaire" name="prix_unitaire" required>
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
