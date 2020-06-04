<div class="col-12">


        <table cellpadding="6" cellspacing="1" style="width:100%;margin:15px" border="0" class="table">

                <tr>

                        <th>Item Description</th>
                        <th>QTY</th>
                        <th style="text-align:right">Item Price</th>
                        <th style="text-align:right">Sub-Total</th>
                </tr>

                <?php $i = 1; ?>

                <?php foreach ($this->cart->contents() as $items) : ?>

                        <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>

                        <tr>

                                <td>
                                        <?php echo $items['name']; ?>

                                        <?php if ($this->cart->has_options($items['rowid']) == TRUE) : ?>

                                                <p>
                                                        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value) : ?>

                                                                <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

                                                        <?php endforeach; ?>
                                                </p>

                                        <?php endif; ?>

                                </td>
                                <td><?php echo $items['qty'] ?></td>
                                <td style="text-align:right"><?php echo ($items['price']); ?></td>
                                <td style="text-align:right">INR <?php echo ($items['subtotal']); ?></td>
                        </tr>

                        <?php $i++; ?>

                <?php endforeach; ?>

                <tr>
                        <td colspan="2"> </td>
                        <td class="right"><strong>Total</strong></td>
                        <td class="right">INR <?php echo ($this->cart->total()); ?></td>
                </tr>

        </table>

        <a href="<?php echo site_url('home/placeOrder') ?>" style="margin-left: 30px;float:right"><input class="btn btn-success" type="button" value="Place Order" /></a>
</div>
<?php if($history) { ?>
<h3 style="margin-left: 30px">Based on Purchase History</h3>
<div class="span12">
        <ul class="thumbnails listing-products">
        <?php  foreach($history as $product) { ?>
                <li class="span3">
                        <div class="product-box">
                                <span class="sale_tag"></span>
                                <a href="<?php echo site_url('home/detail/') . $product['product_id'] ?>"><img style="width:150px;height:auto; max-height:200px;" alt="" src="<?php echo $product['image'] ?>"></a><br />
                                <a href="<?php echo site_url('home/detail/') . $product['product_id'] ?>" class="title"><?php echo $product['product_name'] ?></a><br />
                                <a href="<?php echo site_url('home/detail/') . $product['product_id'] ?>" class="category"><?php echo $product['brand'] ?></a>
                                <p class="price">INR <?php echo $product['price'] ?></p>

                        </div>
                        <?php if ($this->session->role == 2) { ?>
                                <a href="<?php echo site_url('home/order/') . $product['product_id'] ?>" /> <button class="btn btn-inverse">ADD TO CART</button></a>
                        <?php } else { ?>
                                <a href="<?php echo site_url('user/login/') ?>" class="" /><button class="btn btn-inverse">Login to Buy</button>
                        <?php } ?>
                </li>
                        <?php } ?>
        </ul>
        <hr>
</div>
                        <?php } ?>

<h3 style="margin-left: 30px">Recommended Products</h3>
<div class="span12">
        <ul class="thumbnails listing-products">
        <?php if($products) { foreach($products as $product) { ?>
                <li class="span3">
                        <div class="product-box">
                                <span class="sale_tag"></span>
                                <a href="<?php echo site_url('home/detail/') . $product['product_id'] ?>"><img style="width:150px;height:auto; max-height:200px;" alt="" src="<?php echo $product['image'] ?>"></a><br />
                                <a href="<?php echo site_url('home/detail/') . $product['product_id'] ?>" class="title"><?php echo $product['product_name'] ?></a><br />
                                <a href="<?php echo site_url('home/detail/') . $product['product_id'] ?>" class="category"><?php echo $product['brand'] ?></a>
                                <p class="price">INR <?php echo $product['price'] ?></p>

                        </div>
                        <?php if ($this->session->role == 2) { ?>
                                <a href="<?php echo site_url('home/order/') . $product['product_id'] ?>" /> <button class="btn btn-inverse">ADD TO CART</button></a>
                        <?php } else { ?>
                                <a href="<?php echo site_url('user/login/') ?>" class="" /><button class="btn btn-inverse">Login to Buy</button>
                        <?php } ?>
                </li>
                        <?php } ?>
        </ul>
        <hr>
</div>
                        <?php }  ?>
                        <?php if($frequent) { ?>
<h3 style="margin-left: 30px">People Who Also Bought</h3>
<div class="span12">
        <ul class="thumbnails listing-products">
                <?php foreach($frequent as $product) { ?>
                <li class="span3">
                        <div class="product-box">
                                <span class="sale_tag"></span>
                                <a href="<?php echo site_url('home/detail/') . $product['product_id'] ?>"><img style="width:150px;height:auto; max-height:200px;" alt="" src="<?php echo $product['image'] ?>"></a><br />
                                <a href="<?php echo site_url('home/detail/') . $product['product_id'] ?>" class="title"><?php echo $product['product_name'] ?></a><br />
                                <a href="<?php echo site_url('home/detail/') . $product['product_id'] ?>" class="category"><?php echo $product['brand'] ?></a>
                                <p class="price">INR <?php echo $product['price'] ?></p>

                        </div>
                        <?php if ($this->session->role == 2) { ?>
                                <a href="<?php echo site_url('home/order/') . $product['product_id'] ?>" /> <button class="btn btn-inverse">ADD TO CART</button></a>
                        <?php } else { ?>
                                <a href="<?php echo site_url('user/login/') ?>" class="" /><button class="btn btn-inverse">Login to Buy</button>
                        <?php } ?>
                </li>
                        <?php } ?>
        </ul>
        <hr>
</div>
<?php } ?>