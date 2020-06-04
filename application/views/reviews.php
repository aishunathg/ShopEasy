<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Review Id</th>
                        <th>Product name</th>
                        <th>Image</th>
						<th>Username</th>
                        <th>Ratings</th>
                        <th>Review Title</th>
                        <th>Review Text</th>
						<th>Verified Buyer</th>
                    </tr>
                    <?php foreach($review as $r){ ?>
                    <tr>
						<td><?php echo $r['review_id']; ?></td>
                        <td><?php echo $r['product_name']; ?></td>
                        <td><img style="width:100px;height:auto" class="img-fluid" src="<?php echo $r['image']; ?>" alt="image"></td>
						<td><?php echo $r['username']; ?></td>
                        <td><?php echo $r['rating']; ?></td>
                        <td><?php echo $r['review_title']; ?></td>
                        <td><?php echo $r['review_text']; ?></td>
						<td><?php echo $r['verified_buyer'] == 1 ? "Yes" : "No"; ?></td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>