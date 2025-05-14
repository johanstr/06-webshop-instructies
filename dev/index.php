<?php
$db_host = '127.0.0.1';
$db_name = '2324_wittekip';
$db_user = 'root';
$db_pass = 'root';

try {
   $db_connection = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user, $db_pass);
   $db_statement = $db_connection->prepare('SELECT * FROM products');
   $db_statement->execute();
   $products = $db_statement->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $error) {
   echo "<p style=\"color: red;\">{$error->getMessage()}</p>";
   die();
}


// Database::query('SELECT * FROM products', [':id' => $product_id]);
// $products = Database::getAll();

include_once("templates/head.inc.php");
?>

<main class="uk-container uk-padding">
   <div class="uk-alert-success" uk-alert>
      <a href class="uk-alert-close" uk-close></a>
      <p>Hier tonen we o.a. of het inloggen succesvol was.</p>
   </div>
   <div class="uk-grid">
      <section class="uk-width-1-5">
         <h4>Categoriën</h4>
         <hr class="uk-divider" />
         <div>
            <input class="uk-checkbox" id="chickens" type="checkbox" name="chickens" />
            <label for="chickens">Wedstrijd kippen</label>
         </div>
         <div>
            <input class="uk-checkbox" id="paint" type="checkbox" name="paint" />
            <label for="paint">Verf</label>
         </div>
         <div>
            <input class="uk-checkbox" id="machines" type="checkbox" name="machines" />
            <label for="machines">Broedmachines</label>
         </div>
         <div>
            <input class="uk-checkbox" id="hokken" type="checkbox" name="hokken" />
            <label for="hokken">Hokken</label>
         </div>
      </section>
      <section class="uk-width-4-5">
         <h4 class="uk-text-muted uk-text-small">Gekozen categorieën: <span class="uk-text-small uk-text-primary">Alle</span></h4>
         <div class="uk-flex uk-flex-home uk-flex-wrap">
            <?php foreach($products as $product): ?>
            <!-- PRODUCT KAART 1 -->
            <a 
               class="product-card uk-card uk-card-home uk-card-default uk-card-small uk-card-hover" 
               href="product.php?product_id=<?= $product['id'] ?>"
            >
               <div class="uk-card-media-top uk-align-center">
                  <img src="<?= $product['image'] ?>" alt="Witte kip" class="product-image uk-align-center">
               </div>
               <div class="uk-card-body uk-card-body-home">
                  <p class="product-card-p">
                     <?= $product['description'] ?>
                  </p>
                  <p class="product-card-p uk-text-large uk-text-bold uk-text-danger uk-text-right">
                     &euro; <?= $product['price'] ?>
                  </p>
               </div>
            </a>
            <!-- EINDE PRODUCT KAART 1 -->
            <?php endforeach; ?>
         </div>
      </section>
   </div>
</main>

<?php
include_once("templates/foot.inc.php");
