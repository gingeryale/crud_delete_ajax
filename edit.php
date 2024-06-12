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
  $file = $row['p_pic'];
  $saved_image=$file;

  $uploadsDir = 'uploads/';

  if (isset($_FILES['productpic'])) {
    $file= $_FILES['productpic'];
    var_dump($file);
    $filename = uniqid().'_'.$file["name"];
    var_dump($filename);
  
    $allowedEXT = ['jpg','jpeg', 'svg','png', 'pdf'];
    $fileEntension=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
      
    if(in_array($fileEntension, $allowedEXT)){
      if(move_uploaded_file($file['tmp_name'], $uploadsDir.$filename)){
        $saved_image = $filename;
      } else{
        echo "file error".$file['error'];
      }
    }else{
      echo "Invalid image file type";
    }
  }
  

  $prepare = mysqli_prepare($dbc, "UPDATE products SET 
  p_serial=?,
  p_name=?, 
  p_text=?, 
  p_inStock=?, 
  p_pic=?
  WHERE p_id=?");

  mysqli_stmt_bind_param($prepare, 'sssisi', $serialno, $name, $text, $stock,$saved_image ,$productId);
  // var_dump($_POST["stocked"]);
  mysqli_stmt_execute($prepare);
//var_dump($prepare);
header("location: products.php");
}
?>
  <h2>EDIT</h2>
  <form method="POST" action="<?$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">

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
    <input type="text" name="text" placeholder="<?= $row['p_text']?>" value="<?= $row['p_text']?>">
    </div>
    <div class="form-group">
    Is Stocked?
    <? $status = $row['p_inStock'];
    $checked = ($status) ? 'checked="checked"' : '';?>
      <input type="checkbox" name="stocked" value="<?= $status?>" <?= $checked ?> />
      <?
    ?>
</div>
<div class="form-group">
  <img src="uploads/<?= $row['p_pic']; ?>" alt="product picture">
</div>
<div class="form-group">
    <label for="productpic">Replace product Pic:</label>
    <input type="file" name="productpic" value="<?= $row['p_pic']; ?>" class="form-control" id="productpic">
</div>
  <button class="mt-4 btn btn-success" name="submit">Edit</button>
</div>
  </form>
  <?php
require 'footer.php';
?>