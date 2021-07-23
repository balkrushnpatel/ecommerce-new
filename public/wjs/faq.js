var i = 0; 
 summernot();
$('#addFaqInput').click(function(){
	var html = '';
	
     var rowIndex =  $('#add-faq-input-wrap').find('.row-item').length;
     i = (+rowIndex + +1); 
	html +='<div class="form-group row pt-5 row-item" id="row'+i+'">';
		html +='<div class="col-lg-5 input-group ">';
			html +='<input placeholder="Add Question" type="text" name="faq_question[]" class="form-control"/>';
		html +='</div> ';
		html +='<div class="col-lg-5 input-group">';
			html +='<textarea  name="faq_answer[]" class="form-control summernote"></textarea>';
		html +='</div> ';
		html +='<div class="col-lg-2">';
		html +='<button type="button" id="'+i+'" class=" btn btn-sm btn-danger faq_remove" data-id="0">X</button>';
		html +='</div> ';
	html +='</div>	'; 
	$('#add-faq-input-wrap').append(html); 
    summernot();
});  
$( document ).delegate( ".faq_remove", "click", function() {
	var button_id = $(this).attr("id"); 
	var faq_id=$(this).attr("data-id");
	if(faq_id != 0){
     $.ajax({
        url   : APP_URL + '/admin/faqRemove',
        type  :"GET",
        data  :{
                
        	     'id':faq_id ,   
        	    },
        cache :false,
        success:function(result){ 
        	
        }
      });
      
    }

    $('#row'+button_id).remove();
}); 

function summernot(){
    $('.summernote').summernote();
};