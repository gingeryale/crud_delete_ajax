<?php
require 'header.php';

$error=false;
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["submit"])){
  
  if(empty(trim($_POST["serialno"])) || empty(trim($_POST["name"])) || empty(trim($_POST["text"])) || empty(trim($_POST["text"]))){
    $error=true;
  } else{
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

  
}
?>

    <h2 class="mb-4">Adding Products</h2>
    <div class="err">
      <?= $error? '<span class="text-bg-danger p-1 rounded">Required fields were left empty</span>' : ''?>
    </div>
    <br />
    <form method="POST" action="<? $_SERVER['PHP_SELF']; ?>">
  <div class="form-group">
    <label for="serial" class="<?= $error? 'badge text-bg-danger' : ''?>">Serial No.</label>
    <input type="text" name="serialno" class="form-control" id="serial" aria-describedby="serial" placeholder="Enter serial number" required>
  
  </div>
  <div class="form-group">
    <label for="productsname" class="<?= $error? 'badge text-bg-danger' : ''?>">Product Name</label>
    <input type="text" name="name" class="form-control" id="productsname" placeholder="Product Name" required>
  </div>
  
  <div class="form-check">
  <? $status = 1;
    $checked = ($status) ? 'checked="checked"' : '';
    ?>
    <input type="checkbox" name="stocked" class="form-check-input" id="stocked" value="<?= $status?>" <?= $checked ?>>
    <label class="form-check-label" for="stocked">In Stock?</label>
  </div>
  <div class="form-group">
    <label for="description" class="<?= $error? 'badge text-bg-danger' : ''?>">Product Description</label>
    <textarea class="form-control" name="text" id="description" rows="4" required></textarea>
  </div>
  <div class="form-group">
    <label for="description">Product Pic</label>
    <input type="file" name="productImg" class="form-control" id="productImg">
  </div>

  <button type="submit" name="submit" class="btn btn-primary mt-4">Add New Product</button>
</form>

<script>

    </script>

<?php
require 'footer.php';

?>