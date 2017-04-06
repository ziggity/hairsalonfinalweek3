<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

$DB = new PDO('mysql:host=localhost:8889;dbname=test_test', "root", "root");
require_once "src/Stylist.php";
require_once "src/Client.php";
class StylistTest extends PHPUnit_Framework_TestCase
{
  protected function tearDown()
  {
    Stylist::deleteAll();
    Client::deleteAll();
  }
  function test_Save()
  {
    $newClass = new Stylist ("max", "blue");
    $newClass->save();
    $result = Stylist::getAll();
    $this->assertEquals($result, [$newStlyist]);
  }
  function test_deleteAll()
  {
    $newStlyist = new Stylist ("max","blue");
    $newStlyist->save();
    Stylist::deleteAll();
    $result = Stylist::getAll();
    $this->assertEquals($result, []);
  }
  function test_getAll()
  {
    $newStlyist = new Stylist ('Joe', 'blue');
    $newStlyist2 = new Stylist ('jack', "black");
    $newStlyist->save();
    $newStlyist2->save();
    $result = Stylist::getAll();
    $this->assertEquals($result, [$newStlyist, $newStlyist2] );
  }
}






?>
