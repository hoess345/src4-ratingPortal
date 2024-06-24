<div class="table-responsive">
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
                <td style="font-weight: bold"><?php $link($product->productName, 'Rating', 'Overview', ['pid' => $product->id], cssClass: 'nav-link'); ?></td>
                <td><?php $htmlOut($product->producer); ?></td>
                <td><?php $htmlOut($product->rating); ?></td>
                <td><?php $htmlOut($product->ratingCount) ?></td>
                <td>
                    <div class="d-flex">
                        <?php $beginForm('Rating', 'Add', ['pid' => $product->id, 'ctx' => $data['context']], 'get', 'form-inline'); ?>
                        <button class="btn btn-link">Rate</button>
                        <?php $endForm(); ?>
                        <?php if ($product->username == $data['userName']) { ?>
                            <?php $beginForm('Products', 'Edit', ['id' => $product->id, 'ctx' => $data['context']], 'get', 'form-inline'); ?>
                            <button class="btn btn-link">Edit</button>
                            <?php $endForm(); ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>