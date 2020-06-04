<?php foreach($orders as $o) { ?>
<h3 style="margin: 30px">Order Id : 

<?php echo $o['order_id']; ?>
<small style="margin-left: 30px"><?php echo $o['order_date'] ?></small>
<?php $detail = $this->Order_model->getOrderDetail($o['order_id']); ?></h3>
<table class="table" style="margin: 30px" >
  
<tr>
        <th style="width:25%">Sub Order Id</th>
        <th style="width:25%">Product Name</th>
        <th style="width:25%">Qty</th>
        <th style="width:25%">Price</th>
    </tr>
    <?php foreach($detail as $d) { ?>  
        <tr>
        <td><?php echo $d->orderdetail_id ?></td>
        <td><?php echo $d->product_name ?></td>
        <td><?php echo $d->qty ?></td>
        <td>INR <?php echo $d->price * $d->qty ?></td>
        <tr>
<?php } ?>
<tr>
    <td colspan="3">Total</td>
    <td>INR <?php echo $o['total'] ?></td>
</tr>
</table>
<hr>
<?php } ?>