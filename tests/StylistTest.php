<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

$DB = new PDO('mysql:host=localhost:8889;dbname=test_hairsalon', "root", "root");
require_once "src/Stylist.php";
require_once "src/Client.php";
class StylistTest extends PHPUnit_Framework_TestCase
{
  protected function tearDown()
  {
    Stylist::deleteAll();

  }
  function test_save()
  {
    //Arrangeit
    $input_name = "Zak";
    $stylist = new Stylist($input_name);
    //Actonit
    $stylist->save();
    $result = Stylist::getAll();
    //AssertEquals
    $this->assertEquals([$stylist], $result);
  }

  function test_deleteAll()
  {
    //Arrangeit
    $newStlyist = new Stylist ("max","blue");
     //Actonit
    $newStlyist->save();
    Stylist::deleteAll();
    $result = Stylist::getAll();
    //AssertEquals
    $this->assertEquals($result, []);
  }
  function test_getAll()
  {
    //Arrangeit
    $newStlyist = new Stylist ('Joe', 'blue');
    $newStlyist2 = new Stylist ('jack', "black");
     //Actonit
    $newStlyist->save();
    $newStlyist2->save();
    $result = Stylist::getAll();
    //AssertEquals
    $this->assertEquals($result, [$newStlyist, $newStlyist2] );
  }
  function test_find()
  {
      //Arrangeit
      $input_name = "Jax";
      $test_Stylist = new Stylist($input_name);
      $test_Stylist->save();
      $input_name2 = "Nik";
      $test_Stylist2 = new Stylist($input_name2);
      $test_Stylist2->save();
      $find_id = $GLOBALS['DB']->lastInsertId();
      $result = Stylist::find($find_id);
      $this->assertEquals($test_Stylist2, $result);
  }
}






?>
