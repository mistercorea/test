<?php
	session_start();
	include './library/library.php';
	$id = $_POST['id'];
	$pwd = $_POST['pwd'];
	// print_r($_POST);

	if (isset($_POST['id']))
	{
			login($id,$pwd);
	}

	if ($_SESSION['user']['id'] > 0)
	{
		echo '<script type="text/javascript">';
		echo "var dropdown=new TINY.dropdown.init('dropdown', {id:'menu', active:'menuhover'});";

		//replace menu function parsing array into double array.

		$site = 'http://salata.biz.tm/webmenu/getadminmenu';
		$ret = curl_request($site,'output',array('ids'=>$_SESSION['user']['admin_menu']));
		// $ret = curl_request($site);
		$str = array();
		$menu_url = WEB_ADDRESS.'admin2/library/drawmenu.php';
			echo "openurl('$menu_url','menu', {'menu' :{";
		$numItems = count($ret);
		$i = 1;
		for ($x = 1; $x < sizeof($ret); $x++ )
		{
			$i++;
			$endret = count($ret[$x]);
			$y =0;
			foreach ($ret[$x] as $k => $v)
			{
				if (isset($v))
				{
					echo "'$k' : '".WEB_ADDRESS."$v'";
					if (  $x >1 && ++$y === $endret-1)
						echo '}';
					if($i !== $numItems) {
		    			echo ",";
		    		}
				}
				else echo "'$k' : {";
			}
			$y =0;
			if($i === $numItems)
		    	echo "}";
		}
			echo '});';
		echo "openurl('".WEB_ADDRESS."/admin2/home.php','my_main_body');";
		echo '</script>';
	}
	else
	{
		echo "<input type='text' id = 'id' value = 'User Name' onfocus = \"if (this.value == 'User Name') this.value=''\"
				onblur=\"if (this.value =='') this.value = 'User Name'\"/><br />
				<input type='password' id = 'pwd' value = 'ZZZZ' onfocus = \"this.value=''\"
				onblur=\"if (this.value =='') this.value = 'ZZZZ'\"/>
				<input type = 'button' value = 'Submit' onclick = \"login($('#id').val(),$('#pwd').val());\" />";
		if (isset($_POST['id']))
		{
			echo '<script type="text/javascript">';
			echo 'alert ("login failed")';
			echo '</script>';
		}
	}
?>