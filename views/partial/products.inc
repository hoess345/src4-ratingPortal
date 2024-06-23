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
                <td><?php $htmlOut($product->productName); ?></td>
                <td><?php $htmlOut($product->producer); ?></td>
                <td><?php $htmlOut($product->rating); ?></td>
                <td><?php $htmlOut($product->ratingCount) ?></td>
                <td>
<!--                    <div class="d-flex">
                        <?php $beginForm('Cart', 'Add', ['bid' => $book->id, 'ctx' => $data['context']], 'post', 'form-inline'); ?>
                            <button class="btn btn-link">Add</button>
                        <?php $endForm(); ?>

                        <?php $beginForm('Cart', 'Remove', ['bid' => $book->id, 'ctx' => $data['context']], 'post', 'form-inline'); ?>
                        <button class="btn btn-link" <?php if(!$book->isInCart){?> disabled <?php } ?>>Remove</button>
                        <?php $endForm(); ?>
                    </div> -->
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
