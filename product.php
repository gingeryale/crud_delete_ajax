<?php
require 'header.php';
?>
    <h2>All our Products</h2>
    <a href="./products.php" class="badge badge-success">Go Back</a>
    <ul class="list-group">
    <?php
    $productId = htmlspecialchars($_GET['id']) ?? null;
    $sql="SELECT * FROM products WHERE p_id=$productId";
    $prepared = mysqli_query($dbc, $sql);
    $rowNum = mysqli_num_rows($prepared);

    if($rowNum > 0){
        foreach ($prepared as $row){?>
        <li class="list-group-item d-flex flex-column">
           
                <h3><?= $row['p_name']?></h3>
                <p><?= $row['p_text']?></p>
                <p><b>Product Serial No.</b> <?= $row['p_serial']?></p>
                <p><b>In Stock:</b> <?= $row['p_inStock'] ? 'Yes' : 'Out of stock';?> </p>
            
        </li>
        <?php }
    }
    ?>
</ul>
<script>


$('button[name="delete"]').click(function(){

    let pid = $(this).parent().attr( "id" );
    console.log(pid);
    $.ajax({
    method:"POST",
    url:"delete.php",
    data:{id:pid},
    success:function(data){
        console.log('click');
    }
})
})

    </script>

<?php
require 'footer.php';
?>