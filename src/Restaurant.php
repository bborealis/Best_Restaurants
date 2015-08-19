<?php
    class Restaurant
    {
        private $place_name;
        private $id;
        private $address;
        private $phone;
        private $cuisine_id;

        function __construct($place_name, $id =null, $address, $phone, $cuisine_id)
        {
            $this->place_name = $place_name;
            $this->id = $id;
            $this->address = $address;
            $this->phone = $phone;
            $this->cuisine_id = $cuisine_id;
        }

        function setPlace_name($new_place_name)
        {
            $this->place_name = (string) $new_place_name;
        }

        function getPlace_name()
        {
            return $this->place_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (place_name, id, address, phone, cuisine_id) VALUES ('{this->getPlace_name()}', {this->getId()}, '{this->getAddress()}', '{this->getPhone()}', {this->getCuisine_id()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
    }


?>
