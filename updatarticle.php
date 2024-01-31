<?php
$articles = true;
include_once __DIR__ . "/header.php";
include_once __DIR__ . "/main.php";
//  Modifier les informations de client séléctionné
if (!empty($_GET["idarticle"])) {
    try{
        // Préparer et exécuter une requête SELECT pour récupérer article sélectioné via sn idarticle  
        $query = "SELECT * FROM article WHERE idarticle=:idarticle";
        $pdoStmt = $pdo->prepare($query);
        // Binder les valeurs des paramètres
        $pdoStmt->bindParam(':idarticle', $_GET["idarticle"], PDO::PARAM_INT);
        //l'excution de la requête 
        $pdoStmt->execute();
        // récupérer article sélectioné via son idarticle  
        while($article = $pdoStmt->fetch(PDO::FETCH_ASSOC)):   
?>
<h1 class="mt-5">Modifier un article</h1>
<form class="row g-3" method="POST">
    <input type="hidden" name="myidarticle" value="<?php echo $article['idarticle']?>">
    <div class="col-12">
        <label for="floatingTextarea">Description</label>
        <textarea class="form-control" id="floatingTextarea" name="description"required><?php echo $article["description"]?></textarea>
    </div>
    <div class="col-12">
        <label for="prix_unitaire" class="form-label">Prix_unitaire</label>
        <input type="text" class="form-control" id="prix_unitaire" name="prix_unitaire" value="<?php echo $article["prix_unitaire"]?>" required>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit" name="submit">Modifier</button>
    </div>
</form>
</div>
</main>
<?php
        endwhile;
        $pdoStmt->closeCursor();
        if(!empty($_POST)){
            $request = "UPDATE article SET description=:description, prix_unitaire =:prix_unitaire WHERE idarticle = :idarticle";
            $pdoStmt= $pdo->prepare($request);
            //l'excution de la requête 
            $pdoStmt->execute([
                "description"=>$_POST["description"],
                "prix_unitaire"=>$_POST["prix_unitaire"],
                "idarticle"=>$_POST["myidarticle"]
            ]); 
        }
    }catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }   
}
?>
<?php
include_once("footer.php");
?>