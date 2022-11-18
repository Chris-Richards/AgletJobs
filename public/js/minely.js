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
        navigator.clipboard.writeText(window.location.href);
    });
});

$('.shareBtn').on('click', function() {

    var d = $(this).attr('job-id');
    // $('#myToast' + d).modal('show');
    // $("#myToast-" + d).show();
    navigator.clipboard.writeText("https://aglet.com.au/job/" + d);
});

$('.visible-check').change(function() {
    var id = this.id
    $("#" + this.id).prop('disabled', true)
        $.ajax({
            url: "/my-jobs/visible/" + this.id,
            type: 'GET',
            success: function(res) {
                console.log(res);
                $("#" + id).prop( "disabled", false );
            }
        });     
});