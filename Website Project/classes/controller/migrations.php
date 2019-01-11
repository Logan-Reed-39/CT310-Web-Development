<?php 


use Model\Users;

use Fuel\App\Migrations;

class Controller_migrations extends Controller
{
	public function action_migrateA()
	{	
		$session = Session::instance();
		$sessionID = $session->get('id');
		
		$migrate_status = "Migrated to Version A";

		
		$content = View::forge('Migrate/index');
		$layout = View::forge('Migrate/layoutfull');
		$layout->content = Response::forge($content);

		// User is logged in
		if ($sessionID != 76)
		{
			$session = Session::instance();
			$username = $session->get('username');
			$content->set_safe('username', $username);
			$isAdmin = $this->isAdmin();
			$content->set_safe('admin', $isAdmin);
			$content->set_safe('sessionID', $sessionID);
		}

		$content->set_safe('migrate_status', $migrate_status);
		$content->set_safe('A_Been_Run', "Yes");
		$content->set_safe('B_Been_Run', "No");
		$content->set_safe('C_Been_Run', "No");
		
		
		Migrate::version(1);

		

		
		return $layout;
		
	}
	public function action_migrateB()
	{		
		$session = Session::instance();
		$sessionID = $session->get('id');
		
		$migrate_status = "Migrated to Version B";
		
		$content = View::forge('Migrate/index');

		// User is logged in
		if ($sessionID != 76)
		{
			$session = Session::instance();
			$username = $session->get('username');
			$content->set_safe('username', $username);
			$isAdmin = $this->isAdmin();
			$content->set_safe('admin', $isAdmin);
			$content->set_safe('migrate_status', $migrate_status);
			$content->set_safe('sessionID', $sessionID);
		}
		
		$layout = View::forge('Migrate/layoutfull');
		
		$content->set_safe('A_Been_Run', 'No');
		$content->set_safe('B_Been_Run', 'Yes');
		$content->set_safe('C_Been_Run', 'No');

		
		$layout->content = Response::forge($content);
		
		Migrate::version(2);
		
		return $layout;
		
	}
	public function action_migrateC()
	{		
		
		$session = Session::instance();
		$sessionID = $session->get('id');
		
		$migrate_status = "Migrated to Version C";
		
		$content = View::forge('Migrate/index');

		// User is logged in
		if ($sessionID != 76)
		{
			$session = Session::instance();
			$username = $session->get('username');
			$content->set_safe('username', $username);
			$isAdmin = $this->isAdmin();
			$content->set_safe('admin', $isAdmin);
			$content->set_safe('migrate_status', $migrate_status);
			$content->set_safe('sessionID', $sessionID);
		}
		
		$layout = View::forge('Migrate/layoutfull');
		
		$content->set_safe('A_Been_Run', 'No');
		$content->set_safe('B_Been_Run', 'No');
		$content->set_safe('C_Been_Run', 'Yes');
		
		$layout->content = Response::forge($content);

		
		Migrate::version(3);
		
		return $layout;
		
	}
	public function action_migrate_current()
	{	
		$migrate_status = "Migrated to current version";		
		$session = Session::instance();
		$sessionID = $session->get('id');
		
		$content = View::forge('Migrate/index');

		// User is logged in
		if ($sessionID != 76)
		{
			$session = Session::instance();
			$username = $session->get('username');
			$content->set_safe('username', $username);
			$isAdmin = $this->isAdmin();
			$content->set_safe('admin', $isAdmin);
			$content->set_safe('migrate_status', $migrate_status);
			$content->set_safe('sessionID', $sessionID);
		}
		
		$layout = View::forge('Migrate/layoutfull');
		
		$content->set_safe('A_Been_Run', 'No');
		$content->set_safe('B_Been_Run', 'No');
		$content->set_safe('C_Been_Run', 'No');
		
		$layout->content = Response::forge($content);
		Migrate::version(0);

		
		return $layout;
		
	}
	public function action_index()
	{
		$session = Session::instance();
		$sessionID = $session->get('id');
				
		$migrate_status = "Not migrated yet";
		//$migrateA_file = new Fuel\Migrations\migrateA();
		
		//$migrateA_description = $migrateA_file -> $migrateAdescrip;
		
		$content = View::forge('Migrate/index');

		// User is logged in
		if ($sessionID != 76)
		{
			$session = Session::instance();
			$username = $session->get('username');
			$content->set_safe('username', $username);
			$isAdmin = $this->isAdmin();
			$content->set_safe('admin', $isAdmin);
			$content->set_safe('migrate_status', $migrate_status);
			$content->set_safe('sessionID', $sessionID);
		}
		
		$content->set_safe('A_Been_Run', 'No');
		$content->set_safe('B_Been_Run', 'No');
		$content->set_safe('C_Been_Run', 'No');
		//$content->set_safe('Migrate_A_Descrip', $migrateA_description);
		
		$layout = View::forge('Migrate/layoutfull');
		Migrate::version(0);
		
		$layout->content = Response::forge($content);
		
		return $layout;
	}
	public function isAdmin()
	{
		$session = Session::instance();
		$sessionID = $session->get('id');

		// can check if user is admin if logged in
		if ($sessionID != 76)
		{
			$session = Session::instance();

			$sessionUsername = $session->get("username");

			// get username from the db
			$adminQuery = Users::get_users_where("username", $sessionUsername);
			$isAdmin = $adminQuery[0]['admin'];

			// boolean indicating whether the user is an admin or not
			return $isAdmin;
		}
		// not an admin if not logged in or user is not listed as an admin
		return null;
	}



	
	
}

	
?>
