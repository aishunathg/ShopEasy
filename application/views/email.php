<div class="col-12">


        <table cellpadding="6" cellspacing="1" border="1" style="width:100%;margin:15px" border="0" class="table">

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

       
</div>