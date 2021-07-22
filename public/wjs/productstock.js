"use strict"; 
var KTDatatablesDataSourceAjaxServer = function() {

	var initTable1 = function() {
		var table = $('#productstock-datatable');

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
				url: APP_URL + '/admin/productstock_ajax_list',
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
	var _initProductstockForm = function () {
		FormValidation.formValidation(
			document.getElementById('productstock-form'),
			{
				fields: {
					name: {
						validators: {
							notEmpty: {
								message: 'Please enter product name.'
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
			_initProductstockForm();
		}
	};
}();
if($('#productstock-form').length){
	jQuery(document).ready(function() {
		KTFormControls.init();
	});
}if($('#productstock-datatable').length){
	jQuery(document).ready(function() {
		KTDatatablesDataSourceAjaxServer.init();
	});
} 
$( document ).delegate( "#cat_id", "change", function() {
	var catId = $(this).val();
	
	$.ajax({
            url: APP_URL + '/admin/get-sub-category',
            data: { 
            'cat_id':catId                
            },
            beforeSend: function() {                 
            },
            success: function(res) {  
            	var html = '';
            	
            	html += '<option value="0">Select Subcategory</option>';
            	if(res.success){
            		$.each( res.data, function( key, value ) {
				        html += '<option value="'+key+'">'+value+'</option>';
				    });
            	}
            	$('#subcat_id').html('');
            	$('#subcat_id').append(html);
            }
        });
}); 
$( document ).delegate( "#subcat_id", "change", function() {
	var subcat_id = $(this).val();
	var catId = $('#cat_id').val();
	/*membership-positions/edit*/
	$.ajax({
            url: APP_URL + '/admin/get-product',
            data: { 
	            'cat_id':catId,            
	            'subcat_id':subcat_id                
            },
            beforeSend: function() {                 
            },
            success: function(res) {  
            	var html = '';
            	
            	html += '<option value="0">Select Product</option>';
            	if(res.success){
            		$.each( res.data, function( key, value ) {
				        html += '<option value="'+key+'">'+value+'</option>';
				    });
            	}
            	$('#product_id').html('');
            	$('#product_id').append(html);
            }
        });
}); 
$( document ).delegate( "#product_id", "change", function() {
	var productId = $(this).val();  
	$.ajax({
            url: APP_URL + '/admin/get-price',
            data: {               
	            'productId':productId                
            },
            beforeSend: function() {                 
            },
            success: function(res) { 
            	if(res.success){
            		$('#product-price').val(res.price);
            	} 
            }
        });
}); 

