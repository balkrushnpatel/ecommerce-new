$(document).ready(function() {  
    $('.select2').select2();
	$('#confirmDelete').on('show.bs.modal', function (e) {
        $message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text($message);
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);

        // Pass form reference to modal for submission on yes/ok
        var form = $(e.relatedTarget).closest('form');

        //$(this).find('.modal-footer #confirm').data('form', form);
        $(this).find('.modal-footer #confirm').data('form',form);
  	});
   $('#confirmActive').on('show.bs.modal', function (e) {
        $message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text($message);
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);

        // Pass form reference to modal for submission on yes/ok
        var form = $(e.relatedTarget).closest('form');

        //$(this).find('.modal-footer #confirm').data('form', form);
        $(this).find('.modal-footer #confirm').data('form',form);
  	});

    $(document).on("click", ".confirmDeposit", function () {
        var payment_id = $(this).data('id');
        $(".modal-body #payment_id").val( payment_id );
    });
    $('#confirmDeposit').on('show.bs.modal', function (e) {});

    $(document).on("click", ".confirmReconciliation", function () {
        var payment_id = $(this).data('id');
        $(".modal-body #payment_id").val( payment_id );
    });
    $('#confirmReconciliation').on('show.bs.modal', function (e) {});
	$('#confirmDelete').find('.modal-footer #confirm').on('click', function(){ 
        $(this).data('form').submit();
    }); 
    $('#confirmActive').find('.modal-footer #confirm').on('click', function(){
        $(this).data('form').submit();
    });   
    $('.select2').select2(); 
    $(document).on('input','.number',function(){
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
   /* $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        startDate :new Date().getDate(),
    });*/

    $('.datepicker').datepicker({
        rtl: KTUtil.isRTL(),
        autoclose: true,
        todayHighlight: true,
        format: "dd-mm-yyyy",
        orientation: "bottom left", 
        clearBtn: true,
        startDate:new Date()
    });
    $('.prevdate').datepicker({
        rtl: KTUtil.isRTL(),
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom left", 
        clearBtn: true,
        format: "dd-mm-yyyy",
        endDate:new Date()
    });
    
    // get selected region Majlis
    if($('#region_id').length){
        var regionId = $('#region_id').val();
        if(regionId){
            getMajlis(regionId);
        }
    }

    $('#region_id').select2().on('change', function(e) {  
        var regionId = $(this).val();
        getMajlis(regionId);
    });

    function getMajlis(id) {
        if(id == '') id=0;
        $.ajax({
            url: APP_URL + '/ajax/majlis/'+ id,
            data: {
                 
            },
            beforeSend: function() {
                 
            },
            success: function(res) {
                //$(reDiv).html(res), $(reDiv +' select').select2(); 
                var optionHtml = '<option value="">Select Majlis</option>';
                var majlisId = $('#majlisId').val();
                $.each( res.data, function( key, value ) {
                    var optionSelected = '';
                    if(majlisId == key){
                        optionSelected = 'selected';
                    }
                    optionHtml +='<option value="'+key+'" '+optionSelected+'>'+value+'</option>';
                });
                $('#majlis_id').html(optionHtml), $('#majlis_id').select2();
            }
        });
       
    }

    $('#add_payment_book_id').on('change', function(e) {
        var book_id = $(this).val();
        getReceipt(book_id);
    });

    function getReceipt(id) {
        if(id == '') id=0;
        $.ajax({
            url: APP_URL + '/ajax/receipt_no/'+ id,
            data: {

            },
            beforeSend: function() {

            },
            success: function(res) {
                var optionHtml = '<option value="">Select Receipt No</option>';
                $.each( res.data, function( key, value ) {
                    optionHtml +='<option value="'+key+'">'+value+'</option>';
                });
                $('#book_receipt_id').html(optionHtml);
            }
        }); 
    } 
});

$(document).on("input", ".number", function() {
  this.value = this.value.replace(/\D/g,'');
});
function getCsrfToken() {
    return $.trim($('meta[name="csrf-token"]').attr('content'));
}