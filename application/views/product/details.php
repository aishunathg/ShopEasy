<div class="span12">
						<div class="row">
							<div class="span4">
								<a href="#" class="thumbnail" data-fancybox-group="group1" title="Description 1"><img style="max-width:300px;" alt="" src="<?php echo $product['image'] ?>"></a>
								<ul class="thumbnails small">
									<li class="span1">
										<a href="#" class="thumbnail" data-fancybox-group="group1" title="Description 2"><img src="<?php echo $product['image'] ?>" alt=""></a>
									</li>
								</ul>
							</div>
							<div class="span5">
								<address>
									<strong>Brand:</strong> <span><?php echo $product['brand'] ?></span><br>
									<strong>Product Code:</strong> <span><?php echo $product['product_id'] ?></span><br>

									<strong>Availability:</strong> <span>Available</span><br>
								</address>
								<h4><strong>Price: INR <?php echo $product['price'] ?></strong></h4>
                                <?php  if($this->session->role==2) { ?>
                                    <a href="<?php echo site_url('home/order/').$product['product_id'] ?>" /> <button class="btn btn-inverse" type="submit">ADD TO CART</button></a>
                                <?php } else { ?>
                                    <a href="<?php echo site_url('user/login/')?>" class="" /><button class="btn btn-inverse" type="submit">Login to Buy</button>
                                    <?php } ?>
							</div>
						</div>
						<div class="row">
							<div class="span9">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active"><a href="#home">Reiews</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="home">
                                    <?php if ($this->session->role == 2 && !$is_reviewed) {?>
    <div class="col-6">
    <?php echo form_open('home/reviews/' . $product['product_id']); ?>
        <div class="col-md-12">
            <label for="brand" class="control-label"><span class="text-danger">*</span>Review Title</label>
            <div class="form-group">
                <input required type="text" name="review_title" value="<?php echo $this->input->post('review_title'); ?>" class="form-control" id="review_title" />
                <span class="text-danger"><?php echo form_error('review_title'); ?></span>
            </div>
        </div>
        <div class="col-md-12">
            <label for="brand" class="control-label"><span class="text-danger">*</span>Review Text</label>
            <div class="form-group">
                <input required type="text" name="review_text" value="<?php echo $this->input->post('review_text'); ?>" class="form-control" id="review_text" />
                <span class="text-danger"><?php echo form_error('review_text'); ?></span>
            </div>
        </div>
        <div class="col-md-12">
            <label for="brand" class="control-label"><span class="text-danger">*</span>Rating</label>
            <div class="form-group">
                <input required type="number" max=5 name="rating" value="<?php echo $this->input->post('rating'); ?>" class="form-control" id="rating" />
                <span class="text-danger"><?php echo form_error('rating'); ?></span>
            </div>
        </div>
        <div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
        <?php }?>

        <div class="col-12">
    <?php foreach ($reviews as $r) {?>
    <div class="p-2 my-2">
        <b><?php echo $r['review_title'] ?> 



        <?php if($r['verified_buyer']==1)
        { ?>
            <span style="color:Blue">Verified Buyer</span>
        <?php } ?>

        
        </b>
        <p>Rating<?php echo $r['rating'] ?></p>
        <p><?php echo $r['review_text'] ?></p>
    </div>
    <hr>
    <?php }?>
                                    </div>
								</div>
							</div>
						</div>
					</div>