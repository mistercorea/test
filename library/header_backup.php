<?php
	// session_start();
	define('ADMIN_SERVER', '/var/www/html/salata_web/public/');
	// echo ADMIN_SERVER.'/admin/library/library.php';
	// include_once ADMIN_SERVER.'admin/library/simple_html_dom.php';

	define('WEB_ADDRESS', 'http://salata.biz.tm/');

	// $_SESSION['ADMIN_SERVER'] = ADMIN_SERVER;
	// $_SESSION['WEB_ADDRESS'] = WEB_ADDRESS;

	include_once ADMIN_SERVER.'admin/library/library.php';
	if (!function_exists(curl_request))
		echo 'library.php is not included.';

	// $menu = array('menu' => WEB_ADDRESS.admin/);
	$menu = array('HOME' => WEB_ADDRESS.'admin/home.php',
				  'Web Content' => WEB_ADDRESS.'admin/web_content.php',
				  'Edit Location' => WEB_ADDRESS.'admin/location_detail.php',
				  'TEST' => array(
				  					"one"=> "#",
				  					"two"=> "#",
				  					"three"=> "#",
				  					"four"=> "#"
				  				 )
				 );
?>
<div ="my_library_loader">
	<head>
	<script src= "<?php echo WEB_ADDRESS?>admin/include/jquery-1.7.2.js"></script>
	<script src= "<?php echo WEB_ADDRESS?>admin/include/my_library.js"></script>
	<script type="text/javascript" src="<?php echo WEB_ADDRESS?>admin/include/ckeditor/ckeditor.js"></script>
	<link rel="stylesheet" href="<?php echo WEB_ADDRESS?>admin/include/tinydropdown.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo WEB_ADDRESS?>admin/include/admin_style.css" type="text/css" />
	<script type="text/javascript" src="<?php echo WEB_ADDRESS?>admin/include/tinydropdown.js"></script>
	
	</head>
</div>
<table border=0 width="100%" cellpadding="0" cellspacing="0">
<tr border=0 style="padding:0px 0px;">
	<td>
		<div class="nav">
			<ul id="menu" class="menu">
				<?php
					foreach ($menu as $k => $v)
					{
						if (is_array($v))
						{
							echo "<li><a href=\"#\">$k</a>";
							echo '<ul>';
							foreach ($v as $key=>$value)
							{
								echo "<li><a href=\"$value\">$key</a></li>";
							}
							echo '</ul></li>';
						}
						else
						{
							// echo " <li class=\"nodiv\"><a href=\"$v\">$k</a></li>";
							echo " <li class=\"nodiv\"><a onclick=openurl('$v','my_main_body'); href='#'>$k</a></li>";
						}
					}
				?>

			</ul>
		</div>
	</td>
	<td bgcolor=gray width=100%>

	</td>
</tr>
</table>

<!-- <link rel="stylesheet" href="http://107.20.137.173/chris/css/basic.css" type="text/css" /> -->
<script type="text/javascript">
var dropdown=new TINY.dropdown.init("dropdown", {id:'menu', active:'menuhover'});

openurl('<?php echo WEB_ADDRESS."/admin/home.php";?>','my_main_body');


// this code will change the menu on the admin page. need to be self generated from php and replace  it
// after login.
// openurl('<?php echo WEB_ADDRESS."/admin/library/drawmenu.php";?>','menu',
// 	{'menu' :{
// 		'home': 'http://salata.biz.tm/admin',
// 				'b' : '2',
// 				'c' : {
// 						"4": "#",
// 						"5": "#",
// 						"6": "#",
// 						"7": "#"
// 					   }
// 				}
// 		}
// );
//end of demo




<?php
$site = 'http://salata.biz.tm/webmenu/getadminmenu';
$ret = curl_request($site);
$str = array();
// print_r($ret);
$menu_url = WEB_ADDRESS.'admin/library/drawmenu.php';
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

?>
		}
);


</script>


