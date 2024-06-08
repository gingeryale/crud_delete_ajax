<?php 
include 'header.php'
?>

<h2>Login</h2>
<?php
if(isset($_GET["error"])){
    if($_GET["error"]=="emptyinput"){
        echo "<p>Input fields must be filled out</p>";
    }
    if($_GET["error"]=="wronglogin"){
        echo "<p>Login or password are wrong</p>";
    }
    if($_GET["error"]=="loginbad"){
      echo "<p>Wrong login credentials</p>";
  }
   
}
?>
<form action="login_exe.php" method="POST">
<div class="mb-3">
  <label for="uemail" class="form-label">User Email</label>
  <input type="email" name="uemail" class="form-control" id="uemail">
</div>
<div class="mb-3">
  <label for="upassword" class="form-label">User password</label>
  <input type="text" name="upassword" class="form-control" id="upassword">
</div>
<button class="btn btn-primary">Login</button>
</form>

<?php 
include 'footer.php'
?>