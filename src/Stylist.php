<?php
  class Stylist
{
    private $name;
    private $id;

    function __construct($name, $id=null)
      {
        $this->name =$name;
        $this->id = $id;
      }
      function getName()
      {
        return $this->name;
      }
      function setName($new_name)
      {
         $this->name = $new_name;
      }
      function getId()
      {
        return $this->id;
      }
      function save()
      {
        $executed = $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}');");
          if($executed){
            $this->id = $GLOBALS['DB']->lastInsertId();
            return true;
          }else{
          return false;
      }
    }
    static function getAll()
      {
        $stylists = array();
        $returned_stylists = $GLOBALS['DB']->query('SELECT * FROM stylists;');
        foreach($returned_stylists as $stylist)
        {
          $newStylist = new Stylist($stylist['name'],  $stylist["id"]);
          array_push($stylists, $newStylist);
        }

        return $stylists;
      }
      static function deleteAll()
      {
        $deleteAll = $GLOBALS['DB']->exec("DELETE FROM stylists;");
        if ($deleteAll)
        {
          return true;
        }else {
          return false;
        }
      }
    }

 ?>
