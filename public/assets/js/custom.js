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
      
});

$(document).on("input", ".number", function() {
  this.value = this.value.replace(/\D/g,'');
});
function getCsrfToken() {
    return $.trim($('meta[name="csrf-token"]').attr('content'));
}
function handleResponse(res) { 
    if (jQuery.type(res.status) == 'undefined') {
        if (jQuery.type(notice) == 'object') notice.remove();
        return true;
    } 
    if (res.status === 2) { 
        toastr.success(res.message, "SUCCESS");
        return true;
    } else if (res.status === 3) {
        toastr.error(res.message, "Oh No!"); 
        return true;
    } else if (res.status === 401) {
        location.reload();
    } else if (res.status === 422 || res.status === 1) {
        return handleFormErrors(res);
    } else if (res.status === 419) {         
        toastr.error(res.responseJSON.message, "Oh No!");
        return true;
    } else if (jQuery.inArray(res.status, [403, 404]) >= 0) {
        var msg = (res.status === 404) ? 'The record does not exist. If you are repeatedly getting this error contact system admin for more details.' : res.responseJSON.message;
         toastr.error(msg, "Oh No!");
        return true;
    }
}
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};