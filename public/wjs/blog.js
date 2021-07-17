"use strict"; 
var KTDatatablesDataSourceAjaxServer = function() {

	var initTable1 = function() {
		var table = $('#blog-datatable');

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
				url: APP_URL + '/admin/blog_ajax_list',
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
	var _initCategoryForm = function () {
		FormValidation.formValidation(
			document.getElementById('blog-form'),
			{
				fields: {
					name: {
						validators: {
							notEmpty: {
								message: 'Please enter  name.'
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
			_initCategoryForm();
		}
	};
}();
if($('#blog-form').length){
	jQuery(document).ready(function() {
		KTFormControls.init();
	});
}if($('#blog-datatable').length){
	jQuery(document).ready(function() {
		KTDatatablesDataSourceAjaxServer.init();
	});
}


