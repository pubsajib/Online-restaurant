<?php /*echo "<pre>"; var_dump($products); echo "</pre>";exit();*/?>
<?php $counter = 1; ?>
<?php if(!empty($products)) foreach ($products as $product) {?>
    <tr>
        <td><?= $counter;?></td>
        <td><?= $product->name ?></td>
        <td width="30%">
            <div class="pDescription-parent">
                <p class="pDescription">
                    <?= $product->description ?>
                </p>
                <div class="expandBtn">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                </div>
            </div>
        </td>
        <td>
            <image class="pImage" src="http://lorempixel.com/40/40/">
        </td>
        <td><?= $product->category_name ?></td>
        <td class="text-center">
            <div class="action-icon">
                <a class="btn btn-success" href="javascript:;" data-toggle="modal" data-target="#offerModal">
                    <i class="fa fa-gift" aria-hidden="true"></i>
                </a>
            </div>
        </td>
        <td class="text-center">
            <span class="action-icon">
                <a class="btn btn-danger" id="editProduct" href="javascript:;" title="Edit" data-toggle="modal" data-target="#editModal">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
            </span>

            <span class="action-icon">
                <a class="btn btn-primary" id="delProduct" href="javascript:;" title="Edit">
                    <i class="fa fa-minus-circle" aria-hidden="true"></i>
                </a>
            </span>

            <span class="action-icon">
                <a class="btn btn-success" id="discountPorduct" title="discount" href="javascript:;">
                    <i class="fa fa-handshake-o" aria-hidden="true"></i>
                </a>
            </span>
        </td>
    </tr>
    <?php $counter++; ?>
<?php }?>