$(document).ready(function(){
    $('.auth-login').on('click',function(){
        $('.modal').css("display","block");
        // console.log("hello");
    })
});

$(document).ready(function (e) {
    $('#image').change(function () {
        let reader = new FileReader();
        reader.onload = (e) => {

            $('#preview-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
    $('.fa-xmark').on('click',function(){
        $('.alert').hide();
    })
});
