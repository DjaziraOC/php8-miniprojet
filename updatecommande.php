<?php
    $commandes=true;
    include_once __DIR__ ."/header.php";  
    include_once __DIR__ ."/main.php";
if(!empty($_GET["id"])){
    $listidclient= [];
//  Modifier les informations de la commande  séléctionné
    //  Récupérer et afficher les informations de la commande 
        // Préparer et exécuter une requête SELECT pour récupérer tous les clients 
        $query = "SELECT * FROM commande WHERE idcommande=:idcommande";
        $PDOStatement= $pdo->prepare($query);
        // Binder les valeurs des paramètres
        $PDOStatement->bindParam(":idcommande",$_GET["id"],PDO::PARAM_INT);
        // Exécuter la requête
        $PDOStatement->execute();
        // Récupérer tous les résultats sous forme de tableau associatif
        while($commande= $PDOStatement->fetch(PDO::FETCH_ASSOC)):
        // echo "Le client existe dans la base de donnée";  
// La liste déroulante des idclients (commande)
    // Préparer et exécuter une requête SELECT pour récupérer tous les idclient de la table commande
      $query = "SELECT idclient FROM commande";
      $PDOStatement= $pdo->prepare($query);
      // Exécuter la requête
      $PDOStatement->execute();
      // Récupérer tous les résultats sous forme de tableau associatif
      $tabidclients=$PDOStatement->fetchAll(PDO::FETCH_NUM);   
    //   var_dump( $tabidclients);
?>
        <h2  class="mt-5">Modifier la commande</h2>
        <form class="row g-3"  method="POST">
        <input type="hidden" name="myidcommande" value="<?php echo $commande['idcommande']?>">
            <div class="col-md-6">             
                <label for="idclient"  class="form-label">ID client:</label>
                <select class="form-control" name="idclientliste">
                    <?php
                        foreach( $tabidclients as  $tabidclient){
                            foreach($tabidclient as $tabidclientlist){
                                echo "<option value=".$tabidclientlist.">".$tabidclientlist."</option>";
                            }
                        }
                    ?>
                </select>
                <input type="text"  class="form-control" id="idclient" name="idclient" value="<?php 
                    // récupérer et afficher la valeur sélectionnée
                    echo(!empty($_POST["idclient"]))? $_POST["idclientliste"]:$commande["idclient"];
                ?>
                
                "required>
            </div>
            <div class="col-md-6">
                <label for="date_commande" class="form-label">Date :</label>
                <input type="date"  class="form-control" id="date_commande" name="date_commande" value="<?php echo $commande["date_commande"]?>" required>
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
            $request = "UPDATE commande SET idclient =:idclient, date_commande =:date_commande WHERE idcommande = :id";
            $PDOStatement= $pdo->prepare($request);
            //l'excution de la requête 
            $PDOStatement->execute([
                "idclient"=>$_POST["idclientliste"],
                "date_commande"=>$_POST["date_commande"],
                "id"=>$_POST["myidcommande"]
            ]);
            // header("location:commandes.php");  
        }
    }else{
    echo "ID du coommande non spécifié.";
}           
?>
<?php
  include_once ("footer.php");
?>

  


 

