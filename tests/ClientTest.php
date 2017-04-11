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
      $test_client = new Client('Zak', 3);
      $test_client->save();
      $test_client->deleteClient();
      $this->assertEquals([], Client::getAll());
    }
	}

?>
