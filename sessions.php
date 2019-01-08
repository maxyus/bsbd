<?php
	require_once 'db.php';
	
	function mySession_start()
	{	
		if (isset($_COOKIE['SESSID'])) 
		{	

			global $db;
			$sess_id = $_COOKIE['SESSID'];

			$sql = 'SELECT account_email FROM session WHERE id = :sess_id';
			$stmt = $db->prepare($sql);
			$stmt->execute([':sess_id' => $sess_id]);
			$acc = $stmt->fetch(PDO::FETCH_OBJ);

			if ($acc)
			{	

				$sess_update = 'UPDATE session SET time = :s_date, id = :s_id WHERE account_email = :account_email';
				$params_update = [ ':s_date' => date("Y-m-d H:i:s"), ':s_id' => $sess_id, ':account_email' => $acc->account_email];

				$stmt = $db->prepare($sess_update);
				$stmt->execute($params_update);

				return true;
			}

			return false;

		}
	}

	function mySession_write($account_email)
	{
		$SESSID = uniqid();
		global $db;
		setcookie('SESSID', $SESSID, time()+60*60*24*30);
		$_COOKIE['SESSID'] = $SESSID;
		$sess_check = 'SELECT account_email FROM session WHERE account_email = :account_email';
		$stmt = $db->prepare($sess_check);
		$stmt->execute([':account_email' => $account_email]);
		$acc = $stmt->fetch(PDO::FETCH_OBJ);

		if ($acc)
		{
			$sess_update = 'UPDATE session SET time = :s_date, id = :s_id';
			$params_update = [ ':s_date' => date("Y-m-d H:i:s"), ':s_id' => $SESSID];
			$stmt = $db->prepare($sess_update);
			$stmt->execute($params_update);			
			return;
		}

		$sql = 'INSERT INTO session(id, time, account_email) VALUES (:id, :time, :account_email)';
		$params = [ ':id' => $SESSID, ':time' => date("Y-m-d H:i:s"), ':account_email' => $account_email ];
		$stmt = $db->prepare($sql);
 		$stmt->execute($params);

	}

	function mySession_stop()
	{
		global $db;
		$SESSID = $_COOKIE['SESSID'];

		$sql = 'DELETE FROM session WHERE id = :sess_id';
		$stmt = $db->prepare($sql);
		$stmt->execute([':sess_id' => $SESSID]);

		setcookie('ACCID', '', time());
		setcookie('SESSID', '', time());
	}

?>