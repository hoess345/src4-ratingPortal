<?php $render('partial/header', $data); ?>

<h1>Create Product</h1>

<?php $beginForm('Products', 'Create', method: 'post'); ?>
<div class="mb-3">
    <label for="productName" class="form-label">Product Name</label>
    <input class="form-control" id="productName" name="pn"/>
</div>
<div class="mb-3">
    <label for="producer" class="form-label">Producer</label>
    <input class="form-control" id="producer" name="pr"/>
</div>
<button class="btn btn-primary">Create</button>
<?php $endForm(); ?>

<?php $render('partial/footer', $data); ?>
