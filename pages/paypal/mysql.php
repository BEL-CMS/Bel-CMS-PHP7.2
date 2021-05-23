<?php	
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) {
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
}

	$header  = "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

	$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
	//$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);


		if (!$fp) {

		} else {
			fputs ($fp, $header . $req);
			while (!feof($fp)) {
				$res = fgets ($fp, 1024);
				if (strcmp ($res, "VERIFIED") == 0) {
					foreach ($_POST as $key => $value) {
						$value = urlencode(stripslashes($value));
						$req .= "&amp;$key=$value";
					}
					$montant  = $_POST['mc_gross']; 
					$autor    = $_POST['option_name1'];
					$autor_id = $_POST['custom'];
					$date = time();
					$data       = array(
						'id'        => '',
						'author'    => $_POST['option_name1'],
						'hash_key' => $_SESSION['USER']['HASH_KEY'],
						'date'      => time(),
						'montant'   => $_POST['mc_gross']
					);


			$sql = New BDD();
			$sql->table('TABLE_PAYPAL_ACCEPTE');
			$sql->sqldata($data);
			$sql->insert();

			if ($sql->rowCount == 1) {
				$return['text']	= COMMENT_SEND_TRUE;
				$return['type']	= 'success';
			} else {
				$return['text']	= COMMENT_SEND_FALSE;
				$return['type']	= 'danger';
			}

		} else {
			$return = false;
		}
		return $return;
	}
  
} else if (strcmp ($res, "INVALID") == 0) {

	echo "Clef frauduleuse: <b>" .$res ."</b>"
}

}
fclose ($fp);
}