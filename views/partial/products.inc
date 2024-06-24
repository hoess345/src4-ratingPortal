<table class="table align-middle">
    <thead>
    <tr>
        <th>Name</th>
        <th>Producer</th>
        <th>Average Rating</th>
        <th>Ratings</th>
        <th colspan="2"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['products'] as $product) : ?>
        <tr>
            <td><?php $link($product->productName, 'Home', 'Index', cssClass: 'nav-link'); ?></td>
            <td><?php $htmlOut($product->producer); ?></td>
            <td><?php $htmlOut($product->rating); ?></td>
            <td><?php $htmlOut($product->ratingCount) ?></td>
            <td>
                <div class="d-flex">
                    <?php $beginForm('Rating', 'Add', ['bid' => $product->id, 'ctx' => $data['context']], 'post', 'form-inline'); ?>
                    <button class="btn btn-link" >Rate</button>
                    <?php $endForm(); ?>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
