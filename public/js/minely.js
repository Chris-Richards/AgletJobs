function SearchLocation() {
    window.location.href = "/search/" + $("#location").val() + "";
}

function submitPayment() {
    $("#submit").prop('value', 'Loading..')
    $("#submit").attr('disabled', 'true')
    $("#publish-spinner").css('display', 'block');
    $("#payment-element").css('display', 'none');
}

$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myToast").toast("show");
        navigator.clipboard.writeText(window.location.href);
    });
});

$('.shareBtn').on('click', function() {

    var d = $(this).attr('job-id');
    $("#myToast-" + d).toast("show");
    navigator.clipboard.writeText("https://aglet.com.au/job/" + d);
});