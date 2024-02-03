<?php
    $clients=true;
    include_once __DIR__ ."/header.php";  
    include_once __DIR__ ."/main.php";
        if(!empty($_GET["id"])){
        // var_dump($_GET["id"]); 
//  Modifier les informations de client séléctionné
        // Préparer et exécuter une requête SELECT pour récupérer tous les clients 
        $query = "SELECT * FROM client WHERE id=:id";
        $PDOStatement= $pdo->prepare($query);
        // Binder les valeurs des paramètres
            // $PDOStatement->bindParam(":id",$id,PDO::PARAM_INT);
        // Exécuter la requête
        $PDOStatement->execute(["id"=>$_GET["id"]]);
        // Récupérez tous les résultats sous forme de tableau associatif(où les noms de colonnes servent de clés pour les valeurs correspondantes.)
        while($client= $PDOStatement->fetch(PDO::FETCH_ASSOC)):
        // echo "Le client existe dans la base de donnée";       
?>
        <h2  class="mt-5">Modifier le Client</h2>
        <form class="row g-3"  method="POST">
        <input type="hidden" name="myid" value="<?php echo $client['id']?>">
            <div class="col-md-6">
                <label for="nom"  class="form-label">Nom :</label>
                <input type="text"  class="form-control" id="nom" name="nom" value="<?php echo $client["nom"]?>" required>
            </div>
            <div class="col-md-6">
                <label for="ville" class="form-label">Ville:</label>
                <input type="text"  class="form-control" id="ville" name="ville" value="<?php echo $client["ville"]?>" required>
            </div>
            <div class="col-md-6">    
                <label for="telephone"  class="form-label">Télephone :</label>
                <input type="text"  class="form-control" id="telephone" name="telephone" value="<?php echo $client["telephone"]?>" required>
            </div>
            <div class="col-md-12"> 
                <button type="submit" name="submit" class="btn btn-primary">Modifier</button>
            </div>
        </form>
    </div>
</main>  
<?php   
        endwhile;
        $PDOStatement->closeCursor();
        if(!empty($_POST)){
            $request = "UPDATE client SET nom =:nom, prenom =:prenom, telephone =:telephone WHERE id = :id";
            $PDOStatement= $pdo->prepare($request);
            //l'excution de la requête 
            $PDOStatement->execute([
                "nom"=>$_POST["nom"],
                "prenom"=>$_POST["prenom"],
                "telephone"=>$_POST["telephone"],
                "id"=>$_POST["myid"]
            ]);
            // header("location:clients.php");  
        }
    }else{
    echo "ID du client non spécifié.";
}           
?>
<?php
  include_once ("footer.php");
?>
  






