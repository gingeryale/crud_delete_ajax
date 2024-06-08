<?php
require 'header.php';

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["submit"])){

  $serialno=htmlspecialchars($_POST["serialno"]);
  $name=htmlspecialchars($_POST["name"]);
  $text=htmlspecialchars($_POST["text"]);
  $stock=htmlspecialchars(isset($_POST["stocked"]) ? 1 : 0);

  $prepare = mysqli_prepare($dbc, "INSERT INTO products (p_serial,
  p_name,p_text,p_inStock) VALUES (?,?,?,?)");

  mysqli_stmt_bind_param($prepare, 'sssi', $serialno, $name, $text, $stock);

  mysqli_stmt_execute($prepare);
header("location: products.php");
}
?>

    <h2>Adding Products</h2>
    <form method="POST" action="<? $_SERVER['PHP_SELF']; ?>">
  <div class="form-group">
    <label for="serial">Serial No.</label>
    <input type="text" name="serialno" class="form-control" id="serial" aria-describedby="serial" placeholder="Enter serial number">
  
  </div>
  <div class="form-group">
    <label for="productsname">Product Name</label>
    <input type="text" name="name" class="form-control" id="productsname" placeholder="Product Name">
  </div>
  
  <div class="form-check">
  <? $status = 1;
    $checked = ($status) ? 'checked="checked"' : '';
    ?>
    <input type="checkbox" name="stocked" class="form-check-input" id="stocked" value="<?= $status?>" <?= $checked ?>>
    <label class="form-check-label" for="stocked">In Stock?</label>
  </div>
  <div class="form-group">
    <label for="description">Product Description</label>
    <textarea class="form-control" name="text" id="description" rows="4"></textarea>
  </div>

  <button type="submit" name="submit" class="btn btn-primary">Add New Product</button>
</form>

<script>

    </script>

<?php
require 'footer.php';

?>