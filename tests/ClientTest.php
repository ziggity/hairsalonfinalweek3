<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

$DB = new PDO('mysql:host=localhost:8889;dbname=test_hairsalon', "root", "root");
require_once "src/Stylist.php";
require_once "src/Client.php";
class ClientTest extends PHPUnit_Framework_TestCase
{
  protected function tearDown()
  {
    Stylist::deleteAll();
    Client::deleteAll();

  }
  function test_save()
  {
      //Arrangeit
      $name = "Eliot";
      $stylist_id = 8;
      $client = new Client($name, $stylist_id);
      //Actonit
      $executed =$client->save();
      // AssertEquals
      $this->assertTrue($executed, "Client not saved to database");
  }

    function test_deleteAll()
    {
      $newClient = new Client ("max","blue");
      $newClient->save();
      Client::deleteAll();
      $result = Client::getAll();
      $this->assertEquals($result, []);
    }
    function test_getAll()
    {
      $newClient = new Client ('max', 8);
      $newClient->save();
      $newClient2 = new Client ('jack', 9);
      $newClient2->save();
      $result = Client::getAll();
      $this->assertEquals([$newClient, $newClient2], $result);
    }
  }






?>
