<script>	
	
	function addColourClass()
	{

	if ($('#show').length) {
	$($('.button')).each(function (){
      $(this).addClass($( this ).attr( "data-*" ));
		$('#show').remove();
    })
	} else {
	 $($('.button')).each(function (){
       $(this).removeClass($( this ).attr( "data-*" ));
	 })
	 var special = document.getElementById("special");
                   var elem = document.createElement('span');
					 elem.id = 'show';
					 special.appendChild(elem);
		$(document.createElement('span')).attr('id', 'show');
}
	}
	
	
 
	function revealTable()
 {
	 $("#table_id").removeAttr("hidden");
 }
	
	</script>