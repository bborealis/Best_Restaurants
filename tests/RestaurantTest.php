<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=best_restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown() {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_getId()
        {
            $name = "Chinese";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $place_name = "Happy House";
            $address = "4234 N Interstate Ave, Portland OR 97217";
            $phone = "503-287-9740";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($place_name, $id, $address, $phone, $cuisine_id);
            $test_restaurant->save();

            $result = $test_restaurant->getId();

            $this->assertEquals(true, is_numeric($result));
        }

    }


?>
