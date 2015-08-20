<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";

    //Debugger
    //add symfony debug componet
    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=best_restaurants';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/restaurants", function() use ($app) {
        return $app['twig']->render('restaurants.html.twig', array('restaurants' => Restaurant::getAll()));
    });

    $app->get("/restaurants/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('restaurants.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->post("/cuisines", function() use ($app) {
        $cuisine = new Cuisine($_POST['name']);
        $cuisine->save();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post("/", function() use ($app) {
        Cuisine::deleteAll();
        return $app['twig']->render('index.html.twig', array ('cuisines' => Cuisine::getAll()));
    });

    $app->post("/restaurants", function() use ($app) {
        $place_name = $_POST['place_name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $cuisine_id = $_POST['cuisine_id'];
        $restaurant = new Restaurant($place_name, $id = null, $address, $phone, $cuisine_id);
        $restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('restaurants.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });



    return $app;



?>
