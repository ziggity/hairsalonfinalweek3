<?php



	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/
  $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

  require_once 'src/Client.php';


	class ClientTest extends PHPUnit_Framework_TestCase
	{
		protected function teardown()
		{
			Client::deleteAll();

		}
		function test_getName()
		{
			$client = 'Rus';
			$stylist_id = 1;
			$new_client = new Client($client, $stylist_id);
			$result = $new_client->getName();
			$this->assertEquals('Rus', $result);
		}
		function test_getStylistId()
    {
			$client = 'Beth';
			$stylist_id = 1;
			$new_client = new Client($client, $stylist_id);
			$result = $new_client->getStylistId();
			$this->assertEquals(1, $result);
		}
		function test_save()
    {
			$client = 'Jack';
			$stylist_id = 1;
			$new_client = new Client($client, $stylist_id);
			$new_client->save();
			$result = Client::getAll();
			$this->assertEquals($new_client, $result[0]);
		}
		function test_updateName()
    {
			$client = 'Jack';
			$stylist_id = 1;
			$new_client = new Client($client, $stylist_id);
			$new_client->save();
			$new_client = 'Jacky';
			$result = $new_client->updateName($new_client);
			$this->assertEquals('Jacky', $new_client->getName());
		}
		function test_getAll()
    {
			$client = 'Nick';
			$stylist_id = 1;
			$new_client = new Client($client, $stylist_id);
			$new_client->save();
			$result = Client::getAll();
			$this->assertEquals([$new_client], $result);
		}
		function test_deleteAll()
    {
			$client = 'Jacky';
			$stylist_id = 1;
			$new_client = new Client($client, $stylist_id);
			$new_client->save();
			Client::deleteAll();
			$result = Client::getAll();
			$this->assertEquals([], $result);
		}
		function test_deleteClient()
    {
			$client1 = 'Jacky';
			$stylist_id = 1;
			$client1 = new Client($client1, $stylist_id);
			$client1->save();
			$client2 = 'Steve';
			$stylist_id = 1;
			$client2 = new Client($client2, $stylist_id);
			$client2->save();
			$client1->deleteClient();
			$result = Client::getAll();
			$this->assertEquals([$client2], $result);
		}
	}

?>
