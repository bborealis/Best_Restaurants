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

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown() {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_getName()
        {
            $name = "Chinese";
            $test_cuisine = new Cuisine($name);

            $result = $test_cuisine->getName();

            $this->assertEquals($name, $result);
        }

        function test_save()
        {
            $name = "Chinese";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();

            $result = Cuisine::getAll();

            $this->assertEquals($test_cuisine,  $result[0]);
        }

        function test_getAll()
        {
            $name = "Chinese";
            $name2 = "Greek";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();

            $result = Cuisine::getAll();

            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);
        }

        function test_deleteAll()
        {
            $name = "Chinese";
            $name2 = "Greek";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();

            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            $this->assertEquals([], $result);
        }

        function test_find()
        {
            $name = "Chinese";
            $name2 = "Greek";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();

            $result = Cuisine::find($test_cuisine->getId());

            $this->assertEquals($test_cuisine, $result);
        }

        function test_update()
        {
            $name = "Chinese";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $new_name = "Chinese American";

            $test_cuisine->update($new_name);

            $this->assertEquals("Chinese American", $test_cuisine->getName());
        }

        function test_delete()
        {
            $name = "Chinese";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name2 = "Greek";
            $test_cuisine2 = new Cuisine($name2, $id);
            $test_cuisine2->save();

            $test_cuisine->delete();

            $this->assertEquals([$test_cuisine2], Cuisine::getAll());
        }

        function test_getRestaurants()
        {
            $name = "Chinese";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $test_address = "4234 N Interstate Ave, Portland OR 97217";
            $test_phone = "503-287-9740";
            $test_cuisine_id = $test_cuisine->getId();

            $place_name = "Happy House";
            $test_restaurant = new Restaurant($place_name, $id, $test_address, $test_phone, $test_cuisine_id);
            $test_restaurant->save();

            $place_name2 = "Golden Dragon";
            $test_restaurant2 = new Restaurant($place_name2, $id, $test_address, $test_phone, $test_cuisine_id);
            $test_restaurant2->save();

            $result = $test_cuisine->getRestaurants();

            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);


        }

    }
?>
