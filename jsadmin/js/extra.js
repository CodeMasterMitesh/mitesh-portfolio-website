$(document).ready(function(){
            $('.dropdown-menu').css("display","none");
        })  
$('#discountedprice').keyup(function(){ 
    var discountedprice = parseFloat($('#discountedprice').val());
             
    var price = parseFloat($('#price').val()); 
              
    var discount=parseInt(((price-discountedprice)/price)*100);
              
    $('.discount').val(discount);
}); 
$(document).ready(function(){
    
    url=$(location).attr('href').split('/').reverse();
    //console.log(url[0])
    $('a[href="'+url[0]+'"]').parent().parent().parent().addClass('open');
    $('a[href="'+url[0]+'"]').parent().parent().parent().find('a i.icon-angle-left').addClass('icon-angle-down');
    $('a[href="'+url[0]+'"]').parent().parent().parent().find('a i.icon-angle-left').removeClass('icon-angle-left');
    $('a[href="'+url[0]+'"]').parent().parent().parent().find('ul').show();
});
function loadLog(){       
    $.ajax({
        url: "ajax/getchats.php",
        cache: false,
        success: function(html){     
            var chatbox= $("#chat_panel");
               
        }
    });
}
setInterval (loadLog, 2500);  //Reload file every 2.5 seconds