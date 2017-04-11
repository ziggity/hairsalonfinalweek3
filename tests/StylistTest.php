<?php

	require_once 'src/Stylist.php';

	/**
  	* @backupGlobals disabled
  	* @backupStaticAttributes disabled
  	*/
	$server = 'mysql:host=localhost;dbname=hair_salon_test';
	$user = 'root';
	$password = 'root';
	$DB = new PDO ($server, $user, $password);

	class StylistTest extends PHPUnit_Framework_TestCase
	{
		protected function teardown(){
			Stylist::deleteAll();
		}
		function test_getName(){
			$name = 'Ross';
			$new_stylist= new Stylist($name);
			$current_stylist = $new_stylist->getName();
			$this->assertEquals('Ross', $current_stylist);
		}
		function test_getId(){
			$name = 'Ross';
			$id = 1;
			$new_stylist= new Stylist($name, $id);
			$result = $new_stylist->getId();
			$this->assertEquals(1, $result);
		}
		function test_save(){
			$name = 'Jax';
			$new_stylist= new Stylist($name);
			$new_stylist->save();
			$result = Stylist::getAll();
			$this->assertEquals($new_stylist, $result[0]);
		}
		function test_updateName(){
			$name = 'Jax';
			$new_stylist= new Stylist($name);
			$new_stylist->save();
			$new_name = 'Nick';
			$result = $new_stylist->updateName($new_name);
			$this->assertEquals('Nick', $new_stylist->getName());
		}
		function test_getAll(){
			$name = 'Steve';
			$new_stylist= new Stylist($name);
			$new_stylist->save();
			$result = Stylist::getAll();
			$this->assertEquals([$new_stylist], $result);
		}
		function test_getClients(){
			$name = 'Steve';
			$id = null;
			$new_stylist= new Stylist($name, $id);
			$new_stylist->save();
			$stylist_id = $new_stylist->getId();
			$client = 'Nick';
			$new_client = new Client ($client, $stylist_id, $id);
			$new_client->save();
			$result = $new_stylist->getClients();
			$this->assertEquals([$new_client], $result);
		}
		function test_deleteAll(){
			$name = 'Nick';
			$new_stylist= new Stylist($name);
			$new_stylist->save();
			Stylist::deleteAll();
			$result = Stylist::getAll();
			$this->assertEquals([], $result);
		}

		function test_deleteStylist(){
			$name1 = 'Nick';
			$stylist1= new Stylist($name1);
			$stylist1->save();
			$name2 = 'Jill';
			$stylist2= new Stylist($name2);
			$stylist2->save();
			$stylist1->deleteStylist();
			$result = Stylist::getAll();
			$this->assertEquals([$stylist2], $result);
		}
		function test_searchId(){
			$name1 = 'Nick';
			$stylist1= new Stylist($name1);
			$stylist1->save();
			$id = $stylist1->getId();
			$result = $stylist1::find($id);
			$this->assertEquals($stylist1, $result);
		}
	}
?>
