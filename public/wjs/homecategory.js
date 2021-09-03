"use strict"; 
var KTDatatablesDataSourceAjaxServer = function() {

	var initTable1 = function() {
		var table = $('#homecategory-datatable');

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
				url: APP_URL + '/admin/homecategory_ajax_list',
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
	var _initSubcategoryForm = function () {
		FormValidation.formValidation(
			document.getElementById('homecategory-form'),
			{
				fields: {
					name: {
						validators: {
							notEmpty: {
								message: 'Please enter subcategory name.'
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
			_initSubcategoryForm();
		}
	};
}();
if($('#homecategory-form').length){
	jQuery(document).ready(function() {
		KTFormControls.init();
	});
}if($('#homecategory-datatable').length){
	jQuery(document).ready(function() {
		KTDatatablesDataSourceAjaxServer.init();
	});
}

$( document ).delegate( ".select1", "change", function() {
    //alert($(this).val());
    if($('.select1').find(' option[value='+$(this).val()+']:selected').length>1){
                             
            alert('option is already selected');
            $(this).val($(this).find("option:first").val()); 
            $(this).select2();
        }

});

 var expenditureRow = $('#expenditure-fields .row-item').length;  
	$( "table" ).delegate( "td", "click", function() {
	  $( this ).toggleClass( "chosen" );
	});
$( document ).delegate( ".more-btn", "click", function() {
    var e = $("#form").html(); 
	var salesSerRow = $('#home-category .row-item').length;
	
    var salesServHtml = addMore('home-category',salesSerRow); 
    $("#home-category").append(salesServHtml);  
    $('.select2').select2();
});

$( document ).delegate( ".delete-btn-select", "click", function() { 
	var rowId = $(this).attr('data-row'); 
	var dataid = $(this).attr('data-id'); 
	if(dataid){
		$.ajax({
            url : APP_URL + '/admin/home-category/delete',
            type : 'GET',
            data : {'id':dataid},
            dataType:'JSON',
            success :function(response){
            }
        });
	} 
	$('#home-category-row-'+rowId).remove(); 
	reindexItem('home-category');
	expenditureRow = (+expenditureRow + -1);	 
})


function addMore(formTarget,rowIndex){
	var memberDefaultHtml = $('#'+formTarget).find('.row-item').last().clone(); 
	rowIndex = $('#'+formTarget).find('.row-item').length;
	memberDefaultHtml.find('.delete-btn-select').attr('data-row',rowIndex).show();
	memberDefaultHtml.find('.delete-btn-select').attr('data-id',0).css({'display':'block'}); 
	memberDefaultHtml.attr('id',formTarget+'-row-'+rowIndex); 
	memberDefaultHtml.find('input[name]').each(function(){
		var name,id;
		name = $(this).attr('name');
	     id = $(this).attr('id').split("-");
	    name = name.replace(/\[[0-9]+\]/g, '['+rowIndex+']'); 
	    $(this).attr('name',name).val('');   
	    $(this).attr('id',id[0]+"-"+rowIndex);  
    	$(this).attr('data-item',rowIndex); 
	}); 
	memberDefaultHtml.find('select[name]').each(function(){
		var name,id;		
		name = $(this).attr('name');
	     id = $(this).attr('id').split("-");
	    name = name.replace(/\[[0-9]+\]/g, '['+rowIndex+']'); 
	    $(this).attr('name',name).val('');   
	    $(this).attr('id',id[0]+"-"+rowIndex);  
    	$(this).attr('data-item',rowIndex);  
	}); 
	memberDefaultHtml.find('.error').each(function(){
		var id;  
		id = $(this).attr('id').split("-");
		$(this).attr('id',id[0]+"-"+rowIndex);
	}); 

	memberDefaultHtml.find(".select2-container").remove();
	memberDefaultHtml.removeClass("select2-hidden-accessible"); 
	memberDefaultHtml.find(".select2").select2();
	memberDefaultHtml.find(".select2-container").css({'width':'100%'});

	return memberDefaultHtml;
}
function reindexItem(formTarget){ 	  
  	$('#'+formTarget).find('.row-item').each(function(index,item){	  		
  		var memberDefaultHtml = item; 
  		$(memberDefaultHtml).find('.delete-btn-select').attr('data-row',index);
  		$(memberDefaultHtml).attr('id',formTarget+'-row-'+index);
		// input box
		$(memberDefaultHtml).find('input[name]').each(function(){
			var name,id;
			var name = $(this).attr('name');
		     id = $(this).attr('id').split("-");
		    name = name.replace(/\[[0-9]+\]/g, '['+index+']'); 
		   	 $(this).attr('name',name);   
		    $(this).attr('id',id[0]+"-"+index);  
	    	$(this).attr('data-item',index); 
		}); 
		$(memberDefaultHtml).find('select[name]').each(function(){
			var name,id;
			var name = $(this).attr('name');
		     id = $(this).attr('id').split("-");
		    name = name.replace(/\[[0-9]+\]/g, '['+index+']'); 
		   	 $(this).attr('name',name);   
		    $(this).attr('id',id[0]+"-"+index);  
	    	$(this).attr('data-item',index); 
		}); 
  	});
  	setTimeout(function(){ 
		//setTotalCost();
	}, 10);
  	  
} 



