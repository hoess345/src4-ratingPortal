<?php $render('partial/header', $data); ?>

    <h1>Ratings for <?php echo $data['productName'] ?></h1>

<?php if($data['ratings'] > 0): ?>
    <?php if(sizeof($data['ratings']) > 0) { ?>
        <?php $render('partial/rating', array(
            'ratings' => $data['ratings'],
            'context' => $data['context']
        )); ?>
    <?php } ?>
<?php else: ?>
    <p>No ratings yet!</p>
<?php endif; ?>
<?php $render('partial/footer', $data); ?>