"use strict"; 
var KTDatatablesDataSourceAjaxServer = function() {

	var initTable1 = function() {
		var table = $('#product-datatable');

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
				url: APP_URL + '/admin/product_ajax_list',
				type: 'GET', 
			}, 
		});
	};
	return {
		init: function() {
			initTable1();
		},
	};
}();   
var KTFormControls = function () {
	var _initProductForm = function () {
		FormValidation.formValidation(
			document.getElementById('product-form'),
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
			_initProductForm();
		}
	};
}();
if($('#product-form').length){
	jQuery(document).ready(function() {
		KTFormControls.init();
	});
}
if($('#product-datatable').length){
	jQuery(document).ready(function() {
		KTDatatablesDataSourceAjaxServer.init();
	});
}

$( document ).delegate( ".is_fectured", "change", function() {
	var id = $(this).val(); 
	var isFecture = '0';
	if($(this).prop("checked") == true){
		var isFecture = '1';
	}
	$.ajax({
        url: APP_URL + '/admin/product/set-fecture',
        data: { 
        	'id':id,
        	'isFecture':isFecture                
        },
        beforeSend: function() {                 
        },
        success: function(res) {  
        	handleResponse(res);
        }
    });
});

$( document ).delegate( ".is_status", "change", function() {
	var id = $(this).val(); 
	var isPublic = '0';
	if($(this).prop("checked") == true){
		var isPublic = '1';
	}
	$.ajax({
        url: APP_URL + '/admin/product/set-public',
        data: { 
        	'id':id,
        	'isPublic':isPublic                
        },
        beforeSend: function() {                 
        },
        success: function(res) {  
        	handleResponse(res);
        }
    });
});
$( document ).delegate( ".today_deal", "change", function() {
	var id = $(this).val(); 
	var todayDeal = '0';
	if($(this).prop("checked") == true){
		var todayDeal = '1';
	}
	$.ajax({
        url: APP_URL + '/admin/product/set-today_deal',
        data: { 
        	'id':id,
        	'today_deal':todayDeal                
        },
        beforeSend: function() {                 
        },
        success: function(res) {  
        	handleResponse(res);
        }
    });
});

var i = 0;
$('#addInput').click(function(){

	var html = '';
	
     var rowIndex =  $('#addition-input-wrap').find('.row-item').length;
     i = (+rowIndex + +1);
     console.log('row-item ::'+i);
	html +='<div class="form-group row row-item pb-3" id="row'+i+'">';
		html +='<div class="col-lg-5">';
			html +='<input type="text" placeholder="Input Title" class="form-control" name="input_title[]">';
		html +='</div> ';
		html +='<div class="col-lg-5">';
			html +='<select name="title_choice[]" class="form-control choice-title" data-row="'+i+'">';
			html +='<option value="">Select</option>';
			html +='<option value="text">Text Input</option>';
			html +='<option value="single">Single Dropdown</option>';
			html +='<option value="multi">Multiple Dropdown</option>';
			html +='<option value="checkbox">Checkbox</option>';
			html +='<option value="radio">Radio Button</option>';
			html +='</select>';
		html +='</div> ';
		html +='<div class="col-lg-2">';
		html +='<button id="'+i+'" class=" btn btn-sm btn-danger btn_remove">X</button>';
		html +='</div> ';
		html +='<div class="col-lg-12">';
			html +='<div id="chiled-row-'+i+'"></div> ';
		html +='</div>	';
	html +='</div>	';
	$('#addition-input-wrap').append(html);
});  
$( document ).delegate( ".btn_remove", "click", function() {
	var button_id = $(this).attr("id");   
    $('#row'+button_id).remove();
});  
$( document ).delegate( ".choice-title", "change", function() {
	var choice = $(this).val(); 
	var i = $(this).attr('data-row'); 
	var html = '';
	$('#chiled-row-'+i).html('');
	var placeholder = "Please enter ',' separate";
	if(choice != 'text'){ 
	    html +='<div class="row pb-3" id="row'+i+'">';
           html +='<div class="col-lg-6">';
    		   html += '<input type="text" placeholder="'+placeholder+'" class="form-control" name="option[]">';
    	   html +='</div>'; 
       	html +='</div>';            	
    }
   	$('#chiled-row-'+i).append(html); 
}); 

$( document ).delegate( "#datasave", "click", function() {
      var formdata = $("#addmore").serialize();
      $.ajax({
        url   : APP_URL + '/admin/product',
        type  :"POST",
        data  :{
                 "_token": "{{ csrf_token() }}",
        	     formdata,
        	    },
        cache :false,
        success:function(result){ 
          $("#addmore")[0].reset();
        }
      });
    });

var i = 0;
$('#addColorInput').click(function(){
	var html = '';
	
     var rowIndex =  $('#add-color-input-wrap').find('.row-item').length;
     i = (+rowIndex + +1);
     console.log('row-item ::'+i);
	html +='<div class="form-group row row-item" id="row'+i+'">';
		html +='<div class="col-lg-6 input-group colorpicker-component">';
			html +='<input placeholder="Choice color" type="text" name="input_color[]" class="form-control"/>';
		html +='</div> ';
		html +='<div class="col-lg-2">';
		html +='<button id="'+i+'" class=" btn btn-sm btn-danger btn_remove">X</button>';
		html +='</div> ';
	html +='</div>	';
	$('#add-color-input-wrap').append(html);
});  
$( document ).delegate( ".btn_remove", "click", function() {
	var button_id = $(this).attr("id");   
        // console.log(button_id);
         $('#row'+button_id).remove();
});  


$( document ).delegate( ".colorpicker-component", "click", function(e) {
			
	$('.colorpicker-component').colorpicker({}).on('colorpickerChange', function (e) { //change the bacground color of the main when the color changes  
        
    }) 
});

$( document ).delegate( "#cat_id", "change", function() {
	var catId = $(this).val();
	//console.log(catId);
	$.ajax({
            url: APP_URL + '/admin/get-sub-categories',
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
            url: APP_URL + '/admin/get-brand',
            data: { 
	            'cat_id':catId,            
	            'subcat_id':subcat_id                
            },
            beforeSend: function() {                 
            },
            success: function(res) {  
            	var html = '';
            	
            	html += '<option value="0">Select Brand</option>';
            	if(res.success){
            		$.each( res.data, function( key, value ) {
				        html += '<option value="'+key+'">'+value+'</option>';
				    });
            	}
            	$('#brand_id').html('');
            	$('#brand_id').append(html);
            }
        });
});
 

var KTBootstrapSwitch = function() { 
	var demos = function() { 
	 	$('[data-switch=true]').bootstrapSwitch();
	}; 
	return { 
		init: function() {
		 	demos();
		},
	};
}();

jQuery(document).ready(function() {
	KTBootstrapSwitch.init();
});