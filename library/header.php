<?php
	session_start();
	define('ADMIN_SERVER', '/var/www/html/salata_web/public/');

	define('WEB_ADDRESS', 'http://salata.biz.tm/');
	$_SESSION['WEB_ADDRESS'] = WEB_ADDRESS;
	$_SESSION['ADMIN_SERVER'] = ADMIN_SERVER;
	include_once ADMIN_SERVER.'admin/library/library.php';
	if (!function_exists(curl_request))
		echo 'library.php is not included.';

	$menu = array('Login' => WEB_ADDRESS.'admin/login.php');
	// menu dummy info
	// $menu = array('HOME' => WEB_ADDRESS.'admin/home.php',
	// 			  'Web Content' => WEB_ADDRESS.'admin/web_content.php',
	// 			  'Edit Location' => WEB_ADDRESS.'admin/location_detail.php',
	// 			  'TEST' => array(
	// 			  					"one"=> "#",
	// 			  					"two"=> "#",
	// 			  					"three"=> "#",
	// 			  					"four"=> "#"
	// 			  				 )
	// 			 );
?>
<div ="my_library_loader">
	<head>
	<script src= "<?php echo WEB_ADDRESS?>admin/include/jquery-1.7.2.js"></script>
	<script src= "<?php echo WEB_ADDRESS?>admin/include/my_library.js"></script>
	<script type="text/javascript" src="<?php echo WEB_ADDRESS?>admin/include/ckeditor/ckeditor.js"></script>
	<link rel="stylesheet" href="<?php echo WEB_ADDRESS?>admin/include/tinydropdown.css" type="text/css" />
	<script type="text/javascript" src="<?php echo WEB_ADDRESS?>admin/include/tinydropdown.js"></script>
	</head>
</div>
<br /> <br />
<table bgcolor ='grey' width = '100%'>
<tr border=0 style="padding:0px 0px;">
	<td bgcolor='grey' width=140>
		<div class = 'header-logo'><img src='./image/salata-logo.png'width = 140 height = 80/></div>
	</td>
	<td>
		<div class="nav">
			<ul id="menu" class="menu">
				<?php
					// convert array to html so it will be displayed correctly
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
							echo " <li class=\"nodiv\"><a onclick=openurl('$v','my_main_body'); href='#'>$k</a></li>";
						}
					}
				?>

			</ul>
		</div>
	</td>
	<td bgcolor = 'grey'>
		&nbsp;
	</td>
</tr>
</table>
<link rel="stylesheet" href="./include/admin_style.css" type="text/css" />



