var i = 0;
$('#addFaqInput').click(function(){
	var html = '';
	
     var rowIndex =  $('#add-faq-input-wrap').find('.row-item').length;
     i = (+rowIndex + +1);
     console.log('row-item ::'+i);
	html +='<div class="form-group row row-item" id="row'+i+'">';
		html +='<div class="col-lg-5 input-group ">';
			html +='<input placeholder="Add Question" type="text" name="faq_question[]" class="form-control"/>';
		html +='</div> ';
		html +='<div class="col-lg-5 input-group ">';
			html +='<textarea  name="faq_answer[]" id="kt-ckeditor-1"></textarea>';
		html +='</div> ';
		html +='<div class="col-lg-2">';
		html +='<button id="'+i+'" class=" btn btn-sm btn-danger btn_remove">X</button>';
		html +='</div> ';
	html +='</div>	';
	$('#add-faq-input-wrap').append(html);
});  
$( document ).delegate( ".btn_remove", "click", function() {
	var button_id = $(this).attr("id");   
        // console.log(button_id);
         $('#row'+button_id).remove();
});  

