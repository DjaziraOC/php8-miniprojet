<!-- Bootstrap:Sticky footer with fixed navbar header,footer,... -->
<!-- Activation des liens du menu Navbar-->
  <!-- Définisser la variable $index à true -->
  <!-- appliquer echo !empty($index)? "active":"" sur les liens <a></a>-->
<!-- Appéler la bibliothèque jQuery: hosted libraries-->
<!-- Intégrer la database jquery -->
<!-- Initialisation DataTables -->
<?php
  $index = true;
  include_once __DIR__ . "/header.php";
  include_once __DIR__ . "/main.php";
?>
<!-- Begin page content -->
    <h1 class="mt-5">Accueil</h1>
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
<script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

   </body>
</html>

