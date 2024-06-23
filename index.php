<?php
// === register autoloader
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once($file);
    }
});

$sp = new \ServiceProvider();

$sp->register(\Presentation\MVC\MVC::class, function () {
    return new \Presentation\MVC\MVC();
}, isSingleton: true);

// PRESENTATION
// controllers
$sp->register(\Presentation\Controllers\Home::class);
$sp->register(\Presentation\Controllers\Products::class);
$sp->register(\Presentation\Controllers\User::class);


// Application
// querries
$sp->register(\Application\Query\ProductSearchQuery::class);
$sp->register(\Application\Query\SignedInUserQuery::class);
$sp->register(\Application\Query\ProductQuery::class);

// commands
$sp->register(\Application\Command\SignInCommand::class);
$sp->register(\Application\Command\SignOutCommand::class);
$sp->register(\Application\Command\RegisterCommand::class);

// services
$sp->register(\Application\Services\AuthenticationService::class);
// $sp->register(\Application\CategoriesQuery::class);
// $sp->register(\Application\BooksQuery::class);
// $sp->register(\Application\BookSearchQuery::class);
// $sp->register(\Application\CartSizeQuery::class);
// $sp->register(\Application\CheckoutCommand::class);
// $sp->register(\Application\AddBookToCartCommand::class);
// $sp->register(\Application\RemoveBookFromCartCommand::class);
// $sp->register(\Application\SignInCommand::class);
// $sp->register(\Application\SignedInUserQuery::class);
// $sp->register(\Application\SignOutCommand::class);

// $sp->register(\Application\Services\CartService::class);
// $sp->register(\Application\Services\AuthenticationService::class);


// INFRASTRUCTURE
// sessions
$sp->register(\Infrastructure\Session::class, isSingleton: true);
$sp->register(\Application\Interfaces\Session::class, \Infrastructure\Session::class);

// repository
$sp->register(\Infrastructure\Repository::class, function () {
    return new \Infrastructure\Repository("localhost", "root", "", "ratingportal");
}, isSingleton: true);
$sp->register(\Application\Interfaces\UserRepository::class, \Infrastructure\Repository::class);
$sp->register(\Application\Interfaces\ProductRepository::class, \Infrastructure\Repository::class);
// $sp->register(\Application\Interfaces\CategoryRepository::class, \Infrastructure\Repository::class);
// $sp->register(\Application\Interfaces\BookRepository::class, \Infrastructure\Repository::class);
// $sp->register(\Application\Interfaces\OrderRepository::class, \Infrastructure\Repository::class);

$sp->resolve(\Presentation\MVC\MVC::class)->handleRequest($sp);

