<?php $render('partial/header', $data); ?>

<h1>Edit Product</h1>

<?php $beginForm('Products', 'Edit', method: 'POST'); ?>
<div class="mb-3">
    <label for="productName" class="form-label">Product Name</label>
    <input class="form-control" id="productName" name="pn" value="<?php $data['productName'] ?>"/>
</div>
<div class="mb-3">
    <label for="producer" class="form-label">Producer</label>
    <input class="form-control" id="producer" name="pr" value="<?php $data['producer'] ?>"/>
</div>
<button class="btn btn-primary">Edit</button>
<?php $endForm(); ?>

<?php $render('partial/footer', $data); ?>
