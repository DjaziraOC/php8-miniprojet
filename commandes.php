<?php
  $commandes=true;
  include_once __DIR__ . "/header.php";
  include_once __DIR__ . "/main.php";
?>

    <h1 class="mt-5">Commandes</h1>
    <table id="datatable" class="display">
      <thead>
          <tr>
              <th>Column 1</th>
              <th>Column 2</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>Row  1 Data 1</td>
              <td>Row 1 Data 2</td>
          </tr>
          <tr>
              <td>Row 2 Data 1</td>
              <td>Row 2 Data 2</td>
          </tr>
      </tbody>
    </table>
  </div>
</main>

<?php
  include_once ("footer.php");
?>


<!-- CREATE TABLE lcommande (
    idcommande INT PRIMARY KEY AUTO_INCREMENT,
    idclient INT,
    date_commande DATE,
    FOREIGN KEY (idclient) REFERENCES client(id_client) ON DELETE RESTRICT
); -->

<!-- // La liste déroulante des idclients (commande)
    //   Préparer et exécuter une requête SELECT pour récupérer tous les idclient de la table commande
      $query = "SELECT idclient FROM commande";
      $PDOStatement= $pdo->prepare($query);
      // Exécuter la requête
      $PDOStatement->execute();
      // Récupérer tous les résultats sous forme de tableau associatif
          
    //  var_dump($listidclient);

    <select class="form-control" name="idclientlist" required>
                    <?php 
                        foreach($PDOStatement->fetchAll(PDO::FETCH_NUM) as $tabidclient){
                            foreach($tabidclient as $idclientvalue){
                            echo "<option >".$idclientvalue."</option>";
                            }
                        }   
                    ?>  
                </select>   -->