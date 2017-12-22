$(function(){

    $('.custom-file-input').on('change',function(){
        var fileName = $(this).val();
        $(this).next('.form-control-file').addClass("selected").html(fileName);
    })
    
});