<?php
    class Cuisine
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id= $id;
        }

        // function setName($new_name)
        // {
        //     $this->name = (string) $new_name;
        // }

        function getName()
        {
            return $this->name;
        }
    }

?>