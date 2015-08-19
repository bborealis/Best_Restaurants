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

        function setPlaceName($new_place_name)
        {
            $this->place_name = (string) $new_place_name;
        }

        function getPlaceName()
        {
            return $this->place_name;
        }

        function getId()
        {
            return $this->id;
        }

        function setAddress($new_address)
        {
            $this->address = (string) $new_address;
        }

        function getAddress()
        {
            return $this->address;
        }

        function setPhone($new_phone)
        {
            $this->phone = (string) $new_phone;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (place_name, address, phone, cuisine_id) VALUES ('{$this->getPlaceName()}', '{$this->getAddress()}', '{$this->getPhone()}', {$this->getCuisineId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }
    }


?>
