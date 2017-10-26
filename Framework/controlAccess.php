<?php
require_once("Tools.php");

/**
 * Access control for restricted sections
 *
 * @package    Reservation System
 * @subpackage Where To Go
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Raul Castro <rd.castro.silva@gmail.com>
 */

class controlAccess 
{
	private $db;
	private $fbId;
	private $userId;
	public $authorized;
	
	public function __construct($database, $fbId)
	{
		$this->db 	= $database;
		$this->fbId = $fbId;
		
		$this->userId = $this->doesUserExist($fbId);
		
		if ($this->userId)
		{
			if ($this->authorized = $this->isAuthorized())
			{
				$_SESSION['userId'] = $this->userId;
			}
		}
		else 
		{
			$this->createUser();
			$this->authorized = false;
		}
	}
	
	private function doesUserExist($fbId)
	{
		try {
			$query = 'SELECT user_id FROM users WHERE fb_id = "'.$this->fbId.'"';
			return $this->db->getValue($query);
			
		} catch (Exception $e) {
			return false;
		}
	}
	
	private function createUser()
	{
		try {
			$query = 'INSERT INTO users(fb_id, type, authorized) VALUES("'.$this->fbId.'", 1, 0)';
			$this->db->run($query);
			$query = "INSERT INTO user_detail(user_id, name, email) VALUES(".$this->db->insert_id.", '".$_SESSION['FULLNAME']."', '".$_SESSION['EMAIL'] ."')";
			return $this->db->run($query);
		} catch (Exception $e) {
			return false;
		}
	}
	
	private function isAuthorized()
	{
		try {
			$query = 'SELECT authorized FROM users WHERE user_id = '.$this->userId;
			return $this->db->getValue($query);
		} catch (Exception $e) {
			return false;
		}
	}
}
?>
