<?php
	session_start();
	define('WEB_ADDRESS', $_SESSION['WEB_ADDRESS']);
	define('ADMIN_SERVER', $_SESSION['ADMIN_SERVER']);
?>

<?php
	require_once ADMIN_SERVER.'admin/library/simple_html_dom.php';
	if (!function_exists(file_get_html))
	{
		echo 'simple_html_dom.php is not included.';
	}
	// param URL - address to the requesting website.
	// param id - returning div id format has to be in json format
	// param data - post data it will send to requesting URL
	// return array converted from json data
	function curl_request($url,$id = 'output',$data = NUll,$json=1)
	{
		// curl
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if ($data)
		{
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		$content = curl_exec($ch);

		$html = new simple_html_dom();
		$html->load($content);
		$ret = $html->find("div[id=$id]");

		if ($json){
			$str = strip_tags($ret[0]);
			$converted_array = json_decode($str,true);
		}
		else $converted_array = $ret[0];
		return $converted_array;
	}

	// mysql connection
	// removed the password (after 'root') put password to use
	// param - none
	// return - mysql link
	function connect_db()
	{
		$link = mysql_connect('localhost','root','');
		if (!$link) {
	    die('Could not connect: ' . mysql_error());
		}
		return $link;
	}

	// disconnection fron mysql server
	// return - none
	function disconnect_db($link){
		if(!mysql_close($link))
			echo '<br />connection close failed<br />';
	}

	// login to website and save it to PHP session
	// param id - string
	// param id - string
	// return none
	function login($id,$pwd)
	{
		$link = connect_db();
		$mysql = mysql_select_db('salata',$link);
		$query = "SELECT * FROM `staff` where username = '".$id."' and password = '".$pwd."'";
		// echo $query;
		$row = mysql_query($query,$link);
		while ($result = mysql_fetch_array($row)) {
			$ret=$result;
		}
		if ($ret['id']== NULL){
			// if login fails it will pop up and redirect the page to login page
			//echo  "<script type='text/javascript'>alert('your id or password is wrong');</script>";
			disconnect_db($link);
			$_SESSION['user']['id'] = -1;
			return -1;
		}
		else {
			disconnect_db($link);
			$_SESSION['user'] = $ret;
			return $ret['id'];
		}
	}
?>