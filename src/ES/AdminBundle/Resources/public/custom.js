


function printLogo(){

    $('.small_loader').show();

    var url= base_url + "app/print";
    var result = post_ajax(url,data);
    var details = result;
    $('.small_loader').hide();
    $('.print_res').show();
    if(details.success == false){
        $('.print_res').html("<p class='error '>"+ details.message +"</p>");
        setTimeout(function(){$('.print_res').hide(); }, 1500);

    }else{
        $('.print_res').html("<p class='success '>"+ details.message +"</p>");
        setTimeout(function(){$('.print_res').hide(),$('#print')[0].reset(); }, 1500);
        window.setTimeout(function() {
            window.location.href = base_url + 'app/confirmed/'+details.reservation;
        }, 5000);
    }

}