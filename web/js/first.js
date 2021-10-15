<script>

	$.ajax({
                    url: '/web/game-mode/first',
                    type: 'POST',
                    //data: {id: id},
					success: function (result) {
					let obj = JSON.parse(result)
					 $('#main').text(obj.name)
					 $('#main').addClass(obj.colour)
					}
	})
					
</script>