<?php
    $commandes=true;
    include_once __DIR__ ."/header.php";  
    include_once __DIR__ ."/main.php";

    if(!empty($_GET["id"])){
    $listidclient= [];
//  Modifier les informations de la commande  séléctionnée
    //Récupérer et afficher les informations de la commande 
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
// La liste déroulante des idclients (Table client)
    // Préparer et exécuter une requête SELECT pour récupérer tous les idclient de la table client
        $query = "SELECT idclient FROM client";
        $PDOStatement= $pdo->prepare($query);
        // Exécuter la requête
        $PDOStatement->execute();
        // Récupérer tous les résultats sous forme de tableau associatif
        $tabidclients=$PDOStatement->fetchAll(PDO::FETCH_NUM);   
        // var_dump( $tabidclients)

//  Modifier les informations de la commande séléctionnée (table:ligne_commande)
        $query2 = "SELECT * FROM  ligne_commande WHERE idcommande=:idcommande";
        $PDOStatement2= $pdo->prepare($query2);
        // Binder les valeurs des paramètres
        $PDOStatement2->bindParam(":idcommande",$_GET["id"],PDO::PARAM_INT);
        // Exécuter la requête
        $PDOStatement2->execute();
        // Récupérer tous les résultats sous forme de tableau associatif
        while($ligne_commande= $PDOStatement2->fetch(PDO::FETCH_ASSOC)):
// La liste déroulante des idarticles (Table article)
        // Préparer et exécuter une requête SELECT pour récupérer tous les idarticle de la table article
        $query = "SELECT idarticle FROM article";
        $PDOStatement= $pdo->prepare($query);
        // Exécuter la requête
        $PDOStatement->execute();
        // Récupérer tous les résultats sous forme de tableau associatif
        $tabidarticles=$PDOStatement->fetchAll(PDO::FETCH_NUM); 
        // var_dump($tabidarticles) ;
?>
        <h2  class="mt-5">Modifier la commande</h2>
        <form class="row g-3"  method="POST">
        <input type="hidden" name="myidcommande" value="<?php echo $commande['idcommande']?>">
            <div class="col-md-6">             
                <label for="idclientliste"  class="form-label">ID client:</label>
                <select class="form-control" name="idclientliste">
                    <?php
                    //la liste déroulante idclient-modifier la commande
                        foreach($tabidclients as $tabidclient){
                            foreach($tabidclient as $idclientvalue){
                                //séléctionner la commande à modifier en affichant son idclient sur la liste déroulante
                                $selected=($commande['idclient']==$idclientvalue)?"selected":"";
                                echo "<option value=".$idclientvalue." ".$selected.">".$idclientvalue."</option>";
                            }
                        }                  
                    ?>
                </select>          
            </div>
            <div class="col-md-6">
                <label for="date_commande" class="form-label">Date :</label>
                <input type="date"  class="form-control" id="date_commande" name="date_commande" value="<?php echo $commande["date_commande"]?>" required>
            </div>
            <div class="col-md-6">
                <label for="idarticle" class="form-label">ID article</label>
                <select class="form-control" name="idarticleliste">
                    <?php
                    //la liste déroulante idclient-modifier la commande
                        foreach($tabidarticles as $tabidarticle){
                            foreach($tabidarticle as $idarticlevalue){
                                //séléctionner la commande à modifier en affichant son idclient sur la liste déroulante
                                $selectedarticle=($ligne_commande["idarticle"]==$idarticlevalue)?"selected":"";
                                echo "<option value=".$idarticlevalue." ".$selectedarticle.">".$idarticlevalue."</option>";
                            }
                        }                  
                    ?>
                </select>  
            </div>
            <div class="col-md-6">
                <label for="quantite" class="form-label">Quantité</label>
                <input type="text" class="form-control" id="quantite" name="quantite" value="<?php echo $ligne_commande["quantite"]?>" required>
            </div>
            <div class="col-md-12"> 
                <button type="submit" name="submit" class="btn btn-primary">Modifier</button>
            </div>
        </form>
    </div>
</main>  
<?php   
        endwhile;
        endwhile;
        
        $PDOStatement->closeCursor();
        $PDOStatement2->closeCursor();
        try{
            if(!empty($_POST)){
            // Exécution de la première mise à jour
                $request = "UPDATE commande SET idclient =:idclient, date_commande =:date_commande WHERE idcommande = :id";
                $PDOStatement= $pdo->prepare($request);
                $PDOStatement->execute([
                    "idclient"=>$_POST["idclientliste"],
                    "date_commande"=>$_POST["date_commande"],
                    "id"=>$_POST["myidcommande"]
                ]);

            // Exécution de la deuxième mise à jour (ligne_commande)
                $request2 = "UPDATE ligne_commande SET idarticle =:idarticle, quantite=:quantite WHERE idcommande = :idcommande";
                $PDOStatement2= $pdo->prepare($request2); 
                $PDOStatement2->execute([
                    "idarticle"=>$_POST["idarticleliste"],
                    "quantite"=>$_POST["quantite"],
                    "idcommande"=>$_POST["myidcommande"]
                ]);
                $PDOStatement->closeCursor();
                $PDOStatement2->closeCursor();
                // header("location:commandes.php");  
            }
           
        }catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }else{
    echo "ID du coommande non spécifié.";
}           
?>
<?php
  include_once ("footer.php");
?>

  


 

