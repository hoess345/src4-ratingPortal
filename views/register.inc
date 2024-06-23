<?php $render('partial/header', $data); ?>

<h1>Register</h1>

<?php $beginForm('User', 'Register', method: 'post'); ?>
<div class="mb-3">
    <label for="userName" class="form-label">User name</label>
    <!--            TODO: Resolve $data has no data -->
    <input class="form-control" id="username" name="un" value="<?php $htmlOut($data['userName']); ?>"/>
</div>
<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input class="form-control" type="password" id="password" name="password" />
</div>
<button class="btn btn-primary">Register</button>
<?php $endForm(); ?>


<?php $render('partial/footer', $data); ?>
