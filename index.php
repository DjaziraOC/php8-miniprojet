<!-- Bootstrap:Sticky footer with fixed navbar header,footer,... -->
<!-- Activation des liens du menu Navbar-->
  <!-- Définisser la variable $index à true -->
  <!-- appliquer echo !empty($index)? "active":"" sur les liens <a></a>-->
<!-- Appéler la bibliothèque jQuery: hosted libraries-->
<!-- Intégrer la database jquery -->
<!-- Initialisation DataTables -->
<!-- Connexion à la base de données PDO -->
  <!-- créer le fichier connexion: -->
    <!-- Connexion à la base de données avec PDO -->
    <!-- Configurer PDO pour générer des exceptions en cas d'erreur SQL -->
    <!-- afficher le problème avec la méthode getMessage,getFile(),getLine() -->
  <!-- Fermer la connexion lorsque vous avez terminé -->
  <!-- créer le fichier main  -->
<!-- Affichage SELECT-Afficher tous les clients de la base de données -->
  <!-- Préparer et exécuter une requête SELECT pour récupérer tous les clients  -->
  <!-- Exécuter la requête: $query-> execute(); -->
  <!-- Récupérez tous les résultats sous forme de tableau associatif(où les noms de colonnes servent de clés pour les valeurs correspondantes.) -->
  <!-- Afficher les résultats (Tous les clients) à l'aide de la boule foreach  -->
<?php
  $index = true;
  include_once __DIR__ . "/header.php";
  include_once __DIR__ . "/main.php";

// table: client/commande/ligne_commande/article
    $query = "SELECT client.nom, client.ville, client.telephone, commande.date_commande, ligne_commande.quantite, article.description, article.prix_unitaire FROM client INNER JOIN commande ON client.idclient=commande.idclient INNER JOIN ligne_commande ON commande.idcommande=ligne_commande.idcommande INNER JOIN article ON ligne_commande.idarticle=article.idarticle" ;
    $PDOstatment = $pdo->prepare( $query);
    $PDOstatment->execute();
?>
<!-- Begin page content -->
    <h1 class="mt-5">Accueil</h1>
    <table id="datatable" class="display">
      <thead>
        <tr>
          <th>Vues</th>
          <th>Nom</th>
          <th>Téléphone</th>
          <th>Ville</th>
          <th>Date</th>
          <th>Description</th>
          <th>Prix_unitaire</th>
          <th>Quantité</th>
        </tr>
      </thead>
      <tbody>
        <?php while($ligne = $PDOstatment->fetch(PDO::FETCH_ASSOC)):?>
          <tr>
            <td>
              <a href= "detail.php?id=<?php echo $ligne["quantite"]?>" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                </svg>
              </a>
            </td>
            <td><?php echo $ligne["nom"]?></td>
            <td><?php echo $ligne["telephone"]?></td>
            <td><?php echo $ligne["ville"]?></td>
            <td><?php echo $ligne["date_commande"]?></td>
            <td><?php echo $ligne["description"]?></td>
            <td><?php echo $ligne["prix_unitaire"]?></td>
            <td><?php echo $ligne["quantite"]?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</main>
<?php
  $PDOstatment->closeCursor();
  include_once ("footer.php");
?>
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

