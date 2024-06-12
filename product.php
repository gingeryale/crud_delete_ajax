<?php
require 'header.php';
?>
    <h2>All our Products</h2>
    <div class="card mb-4">
    <?php
    $productId = htmlspecialchars($_GET['id']) ?? null;
    $sql="SELECT * FROM products WHERE p_id=$productId";
    $prepared = mysqli_query($dbc, $sql);
    $rowNum = mysqli_num_rows($prepared);

    if($rowNum > 0){
        foreach ($prepared as $row){?>
        <div class="card-body d-flex">
           <div class="col-lg-6 d-flex flex-column">
           <h3><?= $row['p_name']?></h3>
                <p><?= $row['p_text']?></p>
                <p><b>Product Serial No.</b> <?= $row['p_serial']?></p>
                <p><b>Availability:</b> <?= $row['p_inStock'] ? "<span class='badge text-bg-success'>In stock</span>" : "<span class='badge text-bg-danger'>Out of stock</span>"?> </p>
           </div>
                
                <div class="col-lg-6">
           <img src="images/default.png" alt="default product image">
        </div>
            
        </div>
       
        <?php }
    }
    ?>
</div>
<a href="./products.php" class="link-primary link-offset-2 link-underline-opacity-55 link-underline-opacity-100-hover">Back to all products</a>


<?php
require 'footer.php';
?>