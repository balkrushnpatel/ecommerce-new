$( document ).delegate( ".header-setting", "change", function() {
    var name=$(this).attr('name');
	var isEnable = '0';
	if($(this).prop("checked") == true){
		var isEnable = '1';
	}
	$.ajax({
        url: APP_URL + '/admin/setting/headersetting',
        data: { 
        	'isEnable':isEnable,  
            'name':name             
        },
        beforeSend: function() {                 
        },
        success: function(res) {  
        	handleResponse(res);
        }
    });
});