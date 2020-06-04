
					<div class="span12">
						<ul class="thumbnails listing-products">
                        <?php foreach ($products as $p) {?>
							<li class="span3">
								<div class="product-box">
									<span class="sale_tag"></span>
									<a href="<?php echo site_url('home/detail/').$p['product_id'] ?>"><img style="width:150px;height:auto; max-height:200px;" alt="" src="<?php echo $p['image'] ?>"></a><br/>
									<a href="<?php echo site_url('home/detail/').$p['product_id'] ?>" class="title"><?php echo $p['product_name'] ?></a><br/>
									<a href="<?php echo site_url('home/detail/').$p['product_id'] ?>" class="category"><?php echo $p['brand'] ?></a>
									<p class="price">INR <?php echo $p['price'] ?></p>
								</div>
                            </li>
                            <?php }?>
						</ul>
						<hr>
					</div>
