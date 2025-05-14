<?php
$db_host = '127.0.0.1';
$db_name = '2324_wittekip';
$db_user = 'root';
$db_pass = 'root';

$product_id = $_GET['product_id'];

try {
   $db_connection = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
   $sql = "SELECT * FROM products WHERE id = :id";
   $db_statement = $db_connection->prepare($sql);
   $db_statement->execute([':id' => $product_id]);
   $product = $db_statement->fetch(PDO::FETCH_ASSOC);

} catch(PDOException $error) {
   echo "<p style=\"color: red;\">{$error->getMessage()}</p>";
   die();
}

include_once('templates/head.inc.php');
?>

<main class="uk-container uk-padding">
   <div class="uk-grid">
      <section class="uk-width-1">
         <div class="uk-grid uk-card uk-card-default">
            <section class="uk-width-1-2 uk-card-media-left">
               <img src="<?= $product['image'] ?>" class="" alt="" title="" />
            </section>
            <section class="uk-width-1-2 uk-card-body uk-flex uk-flex-column uk-flex-between">
               <div class="">
                  <h1><?= $product['name'] ?></h1>
                  <p class="">
                     <?= $product['description'] ?>
                  </p>
               </div>
               <div class="uk-flex uk-flex-between uk-flex-middle">
                  <div class="price-block">
                     <p class="product-view__price uk-text-bold uk-text-danger uk-text-left uk-text-bolder">
                        &euro; <?= $product['price'] ?>
                     </p>
                  </div>
                  <div>
                     <button class="uk-button uk-button-primary">
                        <span uk-icon="icon: cart"></span>
                        In winkelwagen
                     </button>
                  </div>
               </div>
            </section>
         </div>
      </section>
   </div>
</main>

<?php
include_once('templates/foot.inc.php');