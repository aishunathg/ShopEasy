<div class="row" style="margin-top:80px;">
<?php foreach($products as $p) { ?>
    <div class="col-2 col-md-4 col-sm-3 col-lg-3">
    <div style="border:1px solid; min-height:320px;" class="p-2 my-2">
    <a style="text-decoration: none;color:black;" href="<?php echo site_url('home/detail/').$p['product_id'] ?>" ?>
        <div style="height:200px;display:flex;align-item:center;justify-content:center">
            <img src="<?php echo $p['image'] ?>" style="width:150px;height:auto; max-height:200px;" class="img-fluid" />
        </div>
        <div>
            <p class="text-center"><?php echo $p['product_name']; ?></p>
            <p class="text-center">Rs. <?php echo $p['price']; ?></p>
        </div>
    </a>
    </div>
    </div>
<?php } ?>
</div>