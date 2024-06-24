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
            <td><?php $htmlOut($rating->getUsername()); ?></td>
            <td><?php $htmlOut($rating->getRating()); ?></td>
            <td><?php $htmlOut($rating->getDate()); ?></td>
            <td><?php $htmlOut($rating->getComment()) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
