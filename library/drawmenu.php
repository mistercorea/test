<?php
/*
 *	Receive menu as array
 *  run foreach loop and write html
 *
 *  to use it use ajax call with post data
 */
		$menu = $_POST['menu'];
		$str = '';
		foreach ($menu as $k => $v)
		{
			if (is_array($v))
			{
				$str .= "<li><a href=\"#\">$k</a>";
				$str .= '<ul>';
				foreach ($v as $key=>$value)
				{
					$str .= " <li class=\"nodiv\"><a onclick=openurl('$value','my_main_body'); href='#'>$key</a></li>";
				}
				$str .= '</ul></li>';
			}
			else
			{
				$str .= " <li class=\"nodiv\"><a onclick=openurl('$v','my_main_body'); href='#'>$k</a></li>";
			}
		}
		$str .= '<script type="text/javascript">';
		$str .= 'var dropdown=new TINY.dropdown.init("dropdown", {id:\'menu\', active:\'menuhover\'});';
		$str .= '</script>';
		echo $str;
?>
