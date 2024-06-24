<table class="table align-middle">
    <thead>
    <tr>
        <th>Username</th>
        <th>Rating</th>
        <th>Date</th>
        <th>Comment</th>
        <th colspan="2"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['ratings'] as $rating) : ?>
        <tr>
            <td><?php $htmlOut($rating->userName); ?></td>
            <td><?php $htmlOut($rating->rating); ?></td>
            <td><?php $htmlOut($rating->data); ?></td>
            <td><?php $htmlOut($rating->comment) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
