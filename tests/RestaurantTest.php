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

        function test_getCuisineId()
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

            $result = $test_restaurant->getCuisineId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
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

            $result = Restaurant::getAll();

            $this->assertEquals($test_restaurant, $result[0]);
        }

        function test_getAll()
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

            $place_name2 = "Golden Dragon";
            $address2 = "324 SW 3rd Ave, Portland, OR 97204";
            $phone2 = "503-274-1900";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant2 = new Restaurant($place_name2, $id, $address2, $phone2, $cuisine_id);
            $test_restaurant2->save();

            $result = Restaurant::getAll();

            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }


    }


?>
