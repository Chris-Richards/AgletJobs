function SearchLocation() {
    window.location.href = "/search/" + $("#location").val() + "";
}

function submitPayment() {
    $("#submit").prop('value', 'Loading..')
    $("#submit").attr('disabled', 'true')
    $("#publish-spinner").css('display', 'block');
    $("#payment-element").css('display', 'none');
}