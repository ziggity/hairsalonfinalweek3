<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

$DB = new PDO('mysql:host=localhost:8889;dbname=hairsalon_test', "root", "root");
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
      //Arrangeit
      $newClient = new Client ("max","blue");
      $newClient->save();
      Client::deleteAll();
      $result = Client::getAll();
      // AssertEquals
      $this->assertEquals($result, []);
    }
    function test_getAll()
    {
      //Arrangeit
      $newClient = new Client ('max', 8);
      $newClient->save();
      $newClient2 = new Client ('jack', 9);
      $newClient2->save();
      $result = Client::getAll();
      // AssertEquals
      $this->assertEquals([$newClient, $newClient2], $result);
    }
    function test_delete()
    {
        //Arrangeit
        $name = "Jak";
        $stylist_id = 8;
        $testClient = new Client($name, $stylist_id);
        $testClient->save();
        $name2 = "Max";
        $stylist_id2 = 5;
        $testClient2 = new Client($name2, $stylist_id2);
        $testClient2->save();
        $testClient->delete();
        $result = Client::getAll();
        $this->assertEquals([$testClient2], $result);
    }
    function test_getName()
    {
        //Arrangeit
        $name = "Jax";
        $stylist_id = 5;
        $testClient = new Client($name, $stylist_id);
        $testClient->save();
        $result = $testClient->getName();
        $this->assertEquals($name, $result);
    }
    function test_getStylistName()
    {
        //Arrangeit
        $stylist_name = "Kahn";
        $test_Stylist = new Stylist($stylist_name);
        $test_Stylist->save();
        $stylist_id = $test_Stylist->getId();
        $client_name = "Snickerdoodle";
        $test_Client = new Client($client_name, $stylist_id);
        $test_Client->save();
        $result = $test_Client->getStylistName();
        $this->assertEquals($stylist_name, $result);
    }
    function test_update()
    {
        //Arrangeit
        $name = "Sammy";
        $stylist_id = 5;
        $test_Client = new Client($name, $stylist_id);
        $test_Client->save();
        $new_name = "Nicki";
        $new_stylist_id = 3;
        $test_Client->setName($new_name);
        $test_Client->setStylist_Id($new_stylist_id);
        $test_Client->update();
        $result = Client::getAll();
        $this->assertEquals([$test_Client], $result);
    }

}





?>
