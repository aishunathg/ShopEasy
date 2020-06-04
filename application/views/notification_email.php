<table cellpadding="6" cellspacing="1" border="1" style="width:100%;margin:15px" border="0" class="table">
    <tr>
        <th>Product name</th>
        <th>Brand</th>
        <th>Price</th>
    </tr>
    <?php foreach ($reminder as $r) { ?>
        <tr>
            <td><?php echo $r->product_name ?></td>
            <th><?php echo $r->brand ?></th>
            <td><?php echo $r->price ?></td>
        </tr>
    <?php } ?>
</table>