<?php
  class Client
{
    private $name;
    private $stylist_id;
    private $id;


    function __construct($name, $stylist_id, $id=null)
      {
        $this->name =$name;
        $this->stylist_id =$stylist_id;
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
      function getStylist_id()
      {
        return $this->stylist_id;
      }
      function setStylist_id($new_stylist_id)
      {
         $this->stylist_id = $new_stylist_id;
      }
      function getId()
      {
        return $this->id;
      }
      function save()
      {
      $executed = $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getName()}', '{$this->getStylist_id()}'); ");
        if($executed){
          $this->id = $GLOBALS['DB']->lastInsertId();
          return true;
        }else{
        return false;
        }
      }
      static function getAll()
      {
        $classes = array();
        $returned_classes = $GLOBALS['DB']->query('SELECT * FROM clients;');
        foreach($returned_classes as $class){
          $newClass = new Client($class['name'], $class["stylist_id"],  $class["id"]);
          array_push($classes, $newClass);
        }
          return $classes;
      }
      function delete()
      {
        $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->id};");
      }
      static function deleteAll()
      {
        $deleteAll = $GLOBALS['DB']->exec("DELETE FROM clients;");
        if ($deleteAll)
        {
          return true;
        }else {
          return false;
        }
      }
      function update()
        {
            $GLOBALS['DB']->exec("UPDATE clients SET name = '{$this->name}', stylist_id = {$this->stylist_id} WHERE id = {$this->id};");
        }
      function getStylistName()
      {
          $stylists = Stylist::getAll();
          foreach ($stylists as $stylist) {
              if ($stylist->getId() == $this->stylist_id) {
                  return $stylist->getName();
              }
          }
        }
      static function findByStylistId($search_stylist_id)
      {
          $found_clients = array();
          $clients = Client::getAll();
          foreach ($clients as $client) {
              if ($client->getStylistId() == $search_stylist_id) {
                  array_push($found_clients, $client);
              }
          }
          return $found_clients;
      }
}



 ?>
