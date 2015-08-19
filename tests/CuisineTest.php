<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=best_restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown() {
            Cuisine::deleteAll();
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
            $test_category = new Cuisine($name);
            $test_category->save();
            $test_category2 = new Cuisine($name2);
            $test_category2->save();

            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            $this->assertEquals([], $result);
        }

    }
?>
