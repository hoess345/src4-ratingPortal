<?php $render('partial/header', $data); ?>

    <h1>Products</h1>

<?php if($data['products'] > 0): ?>
    <?php if(sizeof($data['products']) > 0) { ?>
        <?php $render('partial/products', array(
            'products' => $data['products'],
            'context' => $data['context'],
            'userName' => $data['user']->userName
        )); ?>
    <?php } ?>
<?php else: ?>
    <p>No products created yet</p>
<?php endif; ?>
<?php $render('partial/footer', $data); ?>