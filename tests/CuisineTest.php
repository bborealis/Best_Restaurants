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

    }
?>
