<?php $render('partial/header', $data); ?>

<h1>Rate <?php echo $data['productName'] ?>: </h1>

<?php $beginForm('Rating', 'Create', ['bid' => $data['productId'], 'newRating' => ($data['rating']->rating == -1)], method: 'post'); ?>
<div class="mb-3">
    <label for="rate" class="form-label">Rating</label>
    <input type="number" name="rate" id="rate" value="<?php echo $data['rating']->rating; ?>" pattern="[0-5]{1}"
           title="Rate between 0-5"/>
</div>
<div class="mb-3">
    <label for="comment" class="form-label">Comment</label>
    <input class="form-control" id="comment" name="comment" value="<?php echo $data['rating']->comment ?>"/>
</div>
<div class="mb-3">
    <button class="btn btn-primary"><?php if ($data['rating']->rating == -1) echo 'Add'; else echo 'Update' ?></button>
    <?php if ($data['rating']->rating != -1) { ?>
        <?php $beginForm('Rating', 'Delete', ['bid' => $data['productId']], method: 'post'); ?>
        <button class="btn btn-primary">Delete</button>
    <?php } ?>
    <?php $endForm($data); ?>
</div>

<?php $endForm($data); ?>

<?php $render('partial/footer', $data); ?>
