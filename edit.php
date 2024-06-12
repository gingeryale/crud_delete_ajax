<?php
require 'header.php';

$productId = htmlspecialchars($_GET['id']) ?? null;
$result = mysqli_query($dbc, "SELECT * FROM products where p_id=$productId");
$row = mysqli_fetch_assoc($result);

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["submit"])){


  $serialno=htmlspecialchars($_POST["serialno"]);
  $name=htmlspecialchars($_POST["name"]);
  $text=htmlspecialchars($_POST["text"]);
  $stock=htmlspecialchars(isset($_POST["stocked"]) ? 1 : 0);

  $prepare = mysqli_prepare($dbc, "UPDATE products SET 
  p_serial=?,
  p_name=?, 
  p_text=?, 
  p_inStock=? 
  WHERE p_id=?");

  mysqli_stmt_bind_param($prepare, 'sssii', $serialno, $name, $text, $stock,$productId);
  // var_dump($_POST["stocked"]);
  mysqli_stmt_execute($prepare);
//var_dump($prepare);
header("location: products.php");
}
?>
  <h2>EDIT</h2>
  <form method="POST" action="<?$_SERVER['PHP_SELF']?>">

  <div class="form-group">
    Serial No.
    <input type="text" name="serialno" placeholder="<?= $row['p_serial']?>" value="<?= $row['p_serial']?>">
</div>
  <div class="form-group">
    Name:
    <input type="text" name="name" placeholder="<?= $row['p_name']?>" value="<?= $row['p_name']?>">
    </div>
    <div class="form-group">
    Describe:
    <textarea class="form-control" name="text" id="description" placeholder="<?= $row['p_text']?>" rows="4" value="<?= $row['p_text']?>" required></textarea>
    </div>
    <div class="form-group">
    Is Stocked?
    <? $status = $row['p_inStock'];
    $checked = ($status) ? 'checked="checked"' : '';?>
      <input type="checkbox" name="stocked" value="<?= $status?>" <?= $checked ?> />
      <?
    ?>
</div>
  <button class="mt-4 btn btn-success" name="submit">Edit</button>
</div>
  </form>
  <?php
require 'footer.php';
?>