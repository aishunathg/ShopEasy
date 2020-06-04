<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Product Add</h3>
            </div>
            <?php echo form_open('dashboard/addproduct',array("enctype"=>"multipart/form-data")); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-12">
						<label for="product_name" class="control-label"><span class="text-danger">*</span>Product Name</label>
						<div class="form-group">
							<input type="text" name="product_name" value="<?php echo $this->input->post('product_name'); ?>" class="form-control" id="product_name" />
							<span class="text-danger"><?php echo form_error('product_name');?></span>
						</div>
					</div>
					<div class="col-md-12">
						<label for="brand" class="control-label"><span class="text-danger">*</span>Brand</label>
						<div class="form-group">
							<input type="text" name="brand" value="<?php echo $this->input->post('brand'); ?>" class="form-control" id="brand" />
							<span class="text-danger"><?php echo form_error('brand');?></span>
						</div>
					</div>
					<div class="col-md-12">
						<label for="price" class="control-label"><span class="text-danger">*</span>Price</label>
						<div class="form-group">
							<input type="text" name="price" value="<?php echo $this->input->post('price'); ?>" class="form-control" id="price" />
							<span class="text-danger"><?php echo form_error('price');?></span>
						</div>
					</div>
					<div class="col-md-12">
						<label for="image" class="control-label"><span class="text-danger">*</span>Image</label>
						<div class="form-group">
							<input type="file" name="image" value="<?php echo $this->input->post('image'); ?>" class="form-control" id="image" />
							<span class="text-danger"><?php echo form_error('image');?></span>
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>