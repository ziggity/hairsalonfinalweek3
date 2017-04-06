<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

$DB = new PDO('mysql:host=localhost:8889;dbname=test_test', "root", "root");
require_once "src/Stylist.php";
require_once "src/Client.php";
class ClientTest extends PHPUnit_Framework_TestCase
{
  protected function tearDown()
  {
    Stylist::deleteAll();
    Client::deleteAll();

  }
    function test_Save()
    {
      $newClass = new Client ("max", "blue");
      $newClass->save();
      $result = Client::getAll();
      $this->assertEquals($result, [$newClass]);
    }

    function test_deleteAll()
    {
      $newClass = new Client ("max","blue");
      $newClass->save();
      Client::deleteAll();
      $result = Client::getAll();
      $this->assertEquals($result, []);
    }
    function test_getAll()
    {
      $newClass = new Client ('max', 'blue');
      $newClass2 = new Client ('jack', "black");
      $newClass->save();
      $newClass2->save();
      $result = Client::getAll();
      $this->assertEquals($result, [$newClass, $newClass2] );
    }
  }






?>
