<div class="row" style="margin-top:85px;"> 

    <div class="col-6" style="border-right: 1px solid">
        <img class="img-fluid" style="max-height:500px" src="<?php echo $product['image'] ?>" />
    </div>
    <div class="col-5">
        <h4>
            <?php echo $product["product_name"]; ?>
        </h4>
        <p>
            Rs . <?php echo $product["price"]; ?>
        </p>
        <p>
           Brand :  <?php echo $product["brand"]; ?>
        </p>
        <?php  if($this->session->role==2) { ?>
        <a href="<?php echo site_url('home/order/').$product['product_id'] ?>" class="btn btn-warning" />BUY NOW</a>
        <?php } else { ?>
            <a href="<?php echo site_url('user/login/')?>" class="btn btn-warning" />LOGIN TO BUY</a>
        <?php } ?>
    </div>


</div>
<div class="row my-4">

<div class="col-12">
        <h2>Reviews</h2>
        </div>
        <?php if($this->session->role==2 && !$is_reviewed) { ?>
    <div class="col-6">
    <?php echo form_open('home/reviews/'.$product['product_id']); ?>
        <div class="col-md-12">
            <label for="brand" class="control-label"><span class="text-danger">*</span>Review Title</label>
            <div class="form-group">
                <input required type="text" name="review_title" value="<?php echo $this->input->post('review_title'); ?>" class="form-control" id="review_title" />
                <span class="text-danger"><?php echo form_error('review_title');?></span>
            </div>
        </div>
        <div class="col-md-12">
            <label for="brand" class="control-label"><span class="text-danger">*</span>Review Text</label>
            <div class="form-group">
                <input required type="text" name="review_text" value="<?php echo $this->input->post('review_text'); ?>" class="form-control" id="review_text" />
                <span class="text-danger"><?php echo form_error('review_text');?></span>
            </div>
        </div>
        <div class="col-md-12">
            <label for="brand" class="control-label"><span class="text-danger">*</span>Rating</label>
            <div class="form-group">
                <input required type="number" max=5 name="rating" value="<?php echo $this->input->post('rating'); ?>" class="form-control" id="rating" />
                <span class="text-danger"><?php echo form_error('rating');?></span>
            </div>
        </div>
        <div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
        <?php } ?>
    </div>

    <div class="col-12">
    <?php foreach($reviews as $r) { ?>
    <div class="p-2 my-2">
        <b><?php echo $r['review_title'] ?></b>
        <p><?php echo $r['rating'] ?></p>
        <p><?php echo $r['review_text'] ?></p>
    </div>
    <hr>
    <?php } ?>
    </div>
</div>