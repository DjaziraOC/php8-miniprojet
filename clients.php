<!-- Connexion à la base de données PDO: fichier connexion et main -->
<!-- Affichage SELECT-Afficher tous les clients de la base de données -->
<!-- Préparer et exécuter une requête SELECT pour récupérer tous les clients  -->
<!-- Exécuter la requête: $query-> execute(); -->
<!-- Récupérez tous les résultats sous forme de tableau associatif(où les noms de colonnes servent de clés pour les valeurs correspondantes.) -->
<!-- Afficher les résultats (Tous les clients) à l'aide de la boucle foreach appliqué sur <td></td> -->
<!-- Créer une colonne Action et mettre une icon pencil & trash f(svg)  de bootstrap avec un btn -->
<!-- créer une icon add (svg) -->
<!-- Préparer et exécuter une requête DELET pour supprimer un client -->
<?php
  $clients= true;
  include_once __DIR__ . "/header.php";
  include_once __DIR__ . "/main.php";
  $count = 0;
  $list=[];
  // gérer la clé étrangère/désactiver la clé idclient
  // Préparer et exécuter une requête SELECT pour récupérer tous les clients 
  $query = "SELECT idclient FROM client WHERE idclient IN(SELECT idclient FROM commande WHERE commande.idclient = client.idclient)";
  $PDOstmt = $pdo->prepare( $query);
  $PDOstmt->execute();
  // afficher les idclient
  // var_dump($PDOstmt->fetchAll(mode:PDO::FETCH_NUM));
  foreach($PDOstmt->fetchAll(mode:PDO::FETCH_NUM) as $tabvalue){
    foreach($tabvalue as $value){
      $list[]=$value;
    } 
  };
  // var_dump($list);
//<!-- Affichage SELECT-Afficher tous les clients de la base de données -->
    // Préparer et exécuter une requête SELECT pour récupérer tous les clients 
    $query=$pdo->prepare("SELECT * FROM client");
    // Exécuter la requête
    $query-> execute();
    // Récupérez tous les résultats sous forme de tableau associatif(où les noms de colonnes servent de clés pour les valeurs correspondantes.)
    $lignes = $query->fetchAll(mode:PDO::FETCH_ASSOC); 
    //Afficher les résultats (Tous les clients)avec foreach appliqué sur <td></td>(foreach $lignes as $ligne){$alllignes = [$ligne['idclient'] , $ligne['nom'], $ligne['ville'], $ligne['telephone']];}
?>

<!-- Begin page content -->
    <h1 class="mt-5">Clients</h1>
    <a href= "addclient.php" class="btn btn-primary" style="float:right;margin-bottom:20px;">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
        <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4"/>
      </svg>
    </a>
    <table id="datatable" class="display">
      <thead>
          <tr>
              <th>ID</th>
              <th>Nom</th>
              <th>Ville</th>
              <th>Téléphone</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
      <?php 
        foreach($lignes as $ligne){
        $count++;
      ?>
        <tr>
          <td><?php echo $ligne["idclient"]?></td>
          <td><?php echo $ligne["nom"]?></td>
          <td><?php echo $ligne["ville"]?></td>
          <td><?php echo $ligne["telephone"]?></td>
          <td> 
            <!-- Bouton pour ouvrir le modal -->
            <a href="updateclient.php?id=<?php echo $ligne["idclient"]?>"class="btn btn-success">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
              </svg>
            </a>
              <!-- Bouton pour ouvrir le modal -->
            <button type="button" class="btn btn-danger"  data-bs-toggle="modal"  <?php if(in_array($ligne["idclient"],$list)){echo "disabled";}?> data-bs-target="#deleteModal<?php echo $count?>">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
              </svg>
            </button>
          </td>
        </tr> 
        
          <!-- Modal de Suppression -->
          <div class="modal fade" id="deleteModal<?php echo $count?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Voulez vous vraient supprimer ce client?
                </div>
                <div class="modal-footer">
                  <a href="clients.php" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</a>
                  <a href="deleteclient.php?id=<?php echo $ligne["idclient"]?>" type="button" class="btn btn-danger">Supprimer</a>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>     
      </tbody>
    </table>
  </div>
</main>
<?php
  include_once ("footer.php");
?>
