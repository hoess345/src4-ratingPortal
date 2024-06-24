<?php $render('partial/header', $data); ?>

<h1>Rate <?php $htmlOut($data['productName']) ?>: </h1>

<?php $beginForm('Rating', 'Create', ['pid' => $data['productId'], 'newRating' => ($data['rating']->rating == -1)], method: 'post'); ?>
<div class="mb-3">
    <label for="rate" class="form-label">Rating</label>
    <input type="number" name="rate" id="rate" value="<?php $htmlOut($data['rating']->rating) ?>" pattern="[0-5]{1}"
           title="Rate between 0-5"/>
</div>
<div class="mb-3">
    <label for="comment" class="form-label">Comment</label>
    <input class="form-control" id="comment" name="comment" value="<?php $htmlOut($data['rating']->comment) ?>"/>
</div>
<div class="mb-3">
    <button class="btn btn-primary"><?php if ($data['rating']->rating == -1) $htmlOut('Add'); else $htmlOut('Update') ?></button>
</div>
<?php $endForm($data); ?>
<?php $beginForm('Rating', 'Delete', ['pid' => $data['productId'], 'newRating' => ($data['rating']->rating == -1)], method: 'post'); ?>
<div class="mb-3">
    <?php if ($data['rating']->rating != -1) { ?>
        <button class="btn btn-primary">Delete</button>
    <?php } ?>
</div>

<?php $endForm($data); ?>

<?php $render('partial/footer', $data); ?>
