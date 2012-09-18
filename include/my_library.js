function openurl(url,div_id,array)
{
	// alert(url);
	$.post(url, array,
		function(data){
			$("#"+div_id).html(data);
		});
};

