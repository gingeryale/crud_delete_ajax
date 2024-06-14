<?php
require 'header.php';

$userId = htmlspecialchars($_SESSION["userid"]) ?? null;
$result = mysqli_query($dbc, "SELECT * FROM users where u_id=$userId");
$row = mysqli_fetch_assoc($result);

if(isset($_GET["error"])){
    if($_GET["error"]=="invalidfield"){
        echo "<p>Check Your Email</p>";
    }
}


if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["submit"])){

  $userfname=htmlspecialchars($_POST["firstname"]);
  $userlname=htmlspecialchars($_POST["lastname"]);
  $useremail=htmlspecialchars($_POST["email"]);
  $userrole=htmlspecialchars(isset($_POST["role"]) ? 1 : 0);
  $file = $row['u_pic'];
  $saved_image=$file;

  $uploadsDir = 'uploads/';

  if (isset($_FILES['userpic'])) {
    $file= $_FILES['userpic'];
    var_dump($file);
    $filename = uniqid().'_'.$file["name"];
    var_dump($filename);
  
    $allowedEXT = ['jpg','jpeg', 'svg','png', 'pdf'];
    $fileEntension=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
      
    if(in_array($fileEntension, $allowedEXT)){
      if(move_uploaded_file($file['tmp_name'], $uploadsDir.$filename)){
        $saved_image = $filename;
      } else{
        echo "file error: ".$file['error'];
      }
    }else{
      echo "Invalid image file type";
    }
  }
  

  $prepare = mysqli_prepare($dbc, "UPDATE users SET 
  u_fname=?,
  u_lname=?, 
  u_email=?, 
  u_role=?, 
  u_pic=?
  WHERE u_id=?");

  mysqli_stmt_bind_param($prepare, 'sssisi', $userfname, $userlname, $useremail, $userrole,$saved_image ,$userId);

  mysqli_stmt_execute($prepare);
var_dump($prepare);
header("location: profile.php");
}
?>
  <h2>Edit User profile</h2>
  <form method="POST" action="<?$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">

  <div class="form-group">
    Firstname.
    <input type="text" name="firstname" placeholder="<?= $row['u_fname']?>" value="<?= $row['u_fname']?>">
</div>
  <div class="form-group">
    Lastname:
    <input type="text" name="lastname" placeholder="<?= $row['u_lname']?>" value="<?= $row['u_lname']?>">
    </div>
    <div class="form-group">
    Email:
    <input type="text" name="email" placeholder="<?= $row['u_email']?>" value="<?= $row['u_email']?>">
    </div>
    <div class="form-group">
    Is Admin?
    <? $status = $row['u_role'];
    $checked = ($status) ? 'checked="checked"' : '';?>
      <input type="checkbox" name="role" value="<?= $status?>" <?= $checked ?> />
      <?
    ?>
</div>
<div class="form-group">
  <img src="<?= $row['u_pic'] ? 'uploads/'.$row['u_pic'] : 'images/default_user_pic.svg'; ?>" alt="user profile image" width="50">
</div>
<div class="form-group">
    <label for="userpic">Replace your profile pic:</label>
    <input type="file" name="userpic" value="<?= $row['u_pic']; ?>" class="form-control" id="userpic">
</div>
  <button class="mt-4 btn btn-success" name="submit">Edit</button>
</div>
  </form>
  <?php
require 'footer.php';
?>