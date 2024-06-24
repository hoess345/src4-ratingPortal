<?php $render('partial/header', $data); ?>

    <h1><?php $data['selectedBookId']->productName ?></h1>

<?php if($data['products'] > 0): ?>
    <?php if(sizeof($data['products']) > 0) { ?>
        <?php $render('partial/rating', array(
            'ratings' => $data['ratings'],
            'context' => $data['context']
        )); ?>
    <?php } ?>
<?php else: ?>
    <p>No products created yet</p>
<?php endif; ?>
<?php $render('partial/footer', $data); ?>