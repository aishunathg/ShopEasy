<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Products Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('dashboard/addproduct'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Product Id</th>
						<th>Product Name</th>
						<th>Brand</th>
						<th>Price</th>
						<th>Image</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($products as $p){ ?>
                    <tr>
						<td><?php echo $p['product_id']; ?></td>
						<td><?php echo $p['product_name']; ?></td>
						<td><?php echo $p['brand']; ?></td>
						<td><?php echo $p['price']; ?></td>
						<td><img style="width:100px;height:auto" class="img-fluid" src="<?php echo $p['image']; ?>" alt="image"></td>
						<td>
                            <a href="<?php echo site_url('dashboard/productremove/'.$p['product_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>