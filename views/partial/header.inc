<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Rating Platform</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
        <div class="container">
            <?php $link('Rating Platform', 'Home', 'Index', cssClass: 'navbar-brand'); ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <nav class="navbar-nav me-auto">
                    <?php $link('Home', 'Home', 'Index', cssClass: 'nav-link'); ?>
                    <?php $link('Products', 'Products', 'Index', cssClass: 'nav-link'); ?>
                    <?php $link('Search', 'Products', 'Search', cssClass: 'nav-link'); ?>
                    <?php $link('Create Product', 'Products', 'Create', cssClass: 'nav-link'); ?>
                </nav>
                <?php $render('partial/user', $data['user']); ?>
                <!-- TODO: navigation user -->
            </div>
        </div>
    </nav>
    <div class="container mb-3">

        <?php
            if(isset($data['errors'])) {
                $render('partial/errors', $data['errors']);
            }
        ?>
