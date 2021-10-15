<script>

	$.ajax({
                    url: '/web/game-mode/current',
                    type: 'POST',
                    data: {id: id},
					success: function (result) {
					let ob = JSON.parse(result)
					 $('#main').text(ob.name)
					 $('#main').addClass(ob.colour)
					}
	})
					
</script>