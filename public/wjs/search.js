$("#headerSearch").autocomplete({
	
			source: function(request, response) {
				var catId = $("#category").val();
				$.ajax({
					url: APP_URL + '/headersearch',
					dataType: "json",
					data: {
						term : request.term,
						catId:catId,
					},
					success: function(data) {
						response(data);
					}
				});
			},
			select: function( event, ui ) {
				$('. btn-search').trigger('click');
			}
        });