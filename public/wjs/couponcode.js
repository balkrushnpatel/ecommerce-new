"use strict"; 
var KTDatatablesDataSourceAjaxServer = function() {

	var initTable1 = function() {
		var table = $('#couponcode-datatable');

		var html = '[{"COLUMNS":[';
		$('th', this).each(function () {  
            html += '{ "data": "'+$(this).text().replace(" ", "")+'"},';
        });   
        html += ']}]';
        var columns = [];
        var dataObject = eval(html);
		table.DataTable({
			responsive: true,
			destroy: true,
			searchDelay: 500,
			processing: true,
			serverSide: true,
			columns: dataObject[0].COLUMNS,
			ajax: {
				url: APP_URL + '/couponcode_ajax_list',
				type: 'GET', 
			}, 
		});
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();  

// Class definition
var KTFormControls = function () {
	// Private functions
	var _initCouponcodeForm = function () {
		FormValidation.formValidation(
			document.getElementById('couponcode-form'),
			{
				fields: {
					code: {
						validators: {
							notEmpty: {
								message: 'Please enter couponcode .'
							}, 
						}
					}, 
					status: {
						validators: {
							choice: {
						      min:1,
						      message: 'Please select status.'
						    }
						}
					},
				},

				plugins: { //Learn more: https://formvalidation.io/guide/plugins
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
            		// Submit the form when all fields are valid
            		defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				}
			}
		);
	} 
	return {
		// public functions
		init: function() {
			_initCouponcodeForm();
		}
	};
}();
if($('#couponcode-form').length){
	jQuery(document).ready(function() {
		KTFormControls.init();
	});
}if($('#couponcode-datatable').length){
	jQuery(document).ready(function() {
		KTDatatablesDataSourceAjaxServer.init();
	});
}

$( document ).delegate( "#discount_on", "change", function() {
	var discountOn = $(this).val(); 
	$.ajax({
            url: APP_URL + '/get-category',
            data: { 
            'discount_on':discountOn                
            },
            beforeSend: function() {                 
            },
            success: function(res) {  
            	var html = '';
            	$('#discountTypeWrap').show();
            	if(discountOn == 2){
            		var Type = 'Category'
            		html += '<option value="0">Select Category</option>';
            	}else if(discountOn == 3){
            		var Type = 'Sub Category'
            		html += '<option value="0">Select Sub Category</option>';
            	}else if(discountOn == 4){
            		var Type = 'Product'
            		html += '<option value="0">Select Product</option>';
            	}else{
            		$('#discountTypeWrap').hide();
            	}
            	$('#discountType').html(Type);
            	if(res.success){
            		$.each( res.data, function( key, value ) {
				        html += '<option value="'+key+'">'+value+'</option>';
				    });
            	}
            	$('#cat_id').html('');
            	$('#cat_id').append(html);
            }
        });
}); 


