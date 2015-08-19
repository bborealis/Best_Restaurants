<?php
    class Cuisine
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function getId()
        {
            return $this->id;
        }

        function getRestaurants()
        {
            $restaurants = array();
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE cuisine_id = {$this->getId()};");
            foreach($returned_restaurants as $restaurant) {
                $place_name = $restaurant["place_name"];
                $id = $restaurant["id"];
                $address = $restaurant["address"];
                $phone = $restaurant["phone"];
                $cuisine_id = $restaurant["cuisine_id"];
                $new_restaurant = new Restaurant($place_name, $id, $address, $phone, $cuisine_id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        //this function calls the function setId
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cuisines (name) VALUES ('{$this->getName()}');");
            $result_id = $GLOBALS['DB']->lastInsertId();
            $this->setId($result_id);
        }

        //this function calls the function setName
        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE categories SET name = '{new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines WHERE id = {$this->getId()};");
        }

        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisines as $cuisine) {
                $name = $cuisine['name'];
                $id = $cuisine['id'];
                $new_cuisine = new Cuisine($name, $id);
                array_push($cuisines, $new_cuisine);

            }
            return $cuisines;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec('DELETE FROM cuisines;');
        }

        static function find($search_id)
        {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine) {
                $cuisine_id = $cuisine->getId();
                if ($cuisine_id == $search_id) {
                    $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }
    }

?>
