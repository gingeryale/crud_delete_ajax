<?php
require 'header.php';

$error=false;

$uploadsDir = 'uploads/';


if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["submit"])){
  
  if(empty(trim($_POST["serialno"])) || empty(trim($_POST["name"])) || empty(trim($_POST["text"])) || empty(trim($_POST["text"]))){
    $error=true;
  } else{
    $serialno=htmlspecialchars($_POST["serialno"]);
    $name=htmlspecialchars($_POST["name"]);
    $text=htmlspecialchars($_POST["text"]);
    $stock=htmlspecialchars(isset($_POST["stocked"]) ? 1 : 0);
    $file =$_FILES['productpic'];


    if(!is_dir($uploadsDir)){
      mkdir($uploadsDir, 0755, true);
    }

    $filename = uniqid().'_'.$file["name"];
    $filesize = getimagesize($file["size"]);
    var_dump($filesize);
    $allowedEXT = ['jpg','jpeg', 'svg','png', 'pdf'];
    $fileEntension=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    
    if(in_array($fileEntension, $allowedEXT)){
      if(move_uploaded_file($file['tmp_name'], $uploadsDir.$filename)){
        echo "file upload 200OK";
      } else{
        echo "file error".$file['error'];
      }
    }else{
      echo "Invalid image file type";
    }
  
    $prepare = mysqli_prepare($dbc, "INSERT INTO products (p_serial,
    p_name,p_text,p_inStock,p_pic) VALUES (?,?,?,?,?)");
  
    mysqli_stmt_bind_param($prepare, 'sssis', $serialno, $name, $text, $stock,$filename);
  
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
    <form method="POST" action="<? $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
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
    <label for="productpic">Product Pic</label>
    <input type="file" name="productpic" class="form-control" id="productpic">
  </div>

  <button type="submit" name="submit" class="btn btn-primary mt-4">Add New Product</button>
</form>

<script>

    </script>

<?php
require 'footer.php';

?>