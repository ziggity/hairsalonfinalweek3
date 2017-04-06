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
        $executed = $GLOBALS['DB']->exec("INSERT INTO class (name, stylist_id) VALUES ('{$this->getName()}', '{$this->getstylist_id()}'); ");
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
        $returned_classes = $GLOBALS['DB']->query('SELECT * FROM class;');
        foreach($returned_classes as $class){
          $newClass = new Client($class['name'], $class["stylist_id"],  $class["id"]);
          array_push($classes, $newClass);
        }
          return $classes;
      }
      static function deleteAll()
      {
        $deleteAll = $GLOBALS['DB']->exec("DELETE FROM class;");
        if ($deleteAll)
        {
          return true;
        }else {
          return false;
        }
      }
}





 ?>
