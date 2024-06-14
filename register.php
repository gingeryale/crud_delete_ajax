<?php
require 'header.php';
?>
<h2>
Register
</h2>

<h4>
<?php
    if(isset($_GET["error"])){
        if($_GET["error"]=="emptyinput"){
            echo "<p>Fill in all fields</p>";
        }
        if($_GET["error"]=="invalidemail"){
            echo "<p>Check Your Email</p>";
        }
        if($_GET["error"]=="emailexists"){
            echo "<p>Your username is taken</p>";
        }
        if($_GET["error"]=="none"){
            echo "<p>Great! All signed up</p>";
        }
    }
?>
</h4>
<form action="register_exe.php" method="POST">
    <div class="form-control">
        <label for="firstname">firstname</label>
        <input type="text" name="firstname">
    </div>
    <div class="form-control">
    <label for="lastname">lastname</label>
        <input type="text" name="lastname">
    </div>
    <div class="form-control">
    <label for="uemail">Email</label>
        <input type="text" name="uemail">
    </div>
    <div class="form-control">
    <label for="pwd">Password</label>
        <input type="text" name="pwd">
    </div>
   
    <div class="form-control">
        <input type="submit" name="submit" value="Register">
    </div>
</form>

<?php
require 'footer.php';
?>