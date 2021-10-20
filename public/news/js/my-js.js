$(document).ready(function () {
    $.get($('#box-gold').data('url'), function (data) {
        $('#box-gold').html(data);
    }, 'html');

    $.get($('#box-coin').data('url'), function (data) {
        $('#box-coin').html(data);
    }, 'html');

    let  category = $('ul li .category_article').parent().prev();
    // console.log(category)
    category.addClass('active');

    // delete message after 4s
    let messageSuccess = $('.alert-info');
    let messageError = $('.alert-danger');
   
    setTimeout(function(){
        messageSuccess.hide('slow', function(){ messageSuccess.remove();});
        messageError.hide('slow', function(){ messageError.remove();});
    },4000);



    //VALIDATE FORM CONTACT

    var $contactForm   = $('#contact-form');
    if($contactForm.length){
        $contactForm.validate({
            rules:{
                username:{
                    required:true,
                    minlength: 5
                },
                email:{
                    required:true,
                    email: true
                },
                phone:{
                    required:true,
                    number: true
                },
                contact:{
                    required:true,
                    minlength: 5
                }
            },
            messages:{
                username:{
                    required:'Hãy nhập họ và tên!',
                    minlength:'Họ và tên phải có ít nhất 5 ký tự!',
                },
                email:{
                    required:'Hãy nhập địa chỉ email!',
                    email:'Ví dụ : abcd@gmail.com',
                },
                phone:{
                    required:'Hãy nhập số điện thoại!',
                    number:'Số điện thoại phải là số!',
                },
                contact:{
                    required:'Hãy nhập nội dung liên lạc!',
                    minlength:'Nội dung liên lạc phải có ít nhất 5 ký tự!'
                },
            }
        })
    }

    //LOCAL STORAGE


    let userName = $('input[name="username"]');
    let email    = $('input[name="email"]');
    let phone = $('input[name="phone"]');
    let CONTACT_INFO = 'CONTACT_INFO';

    let userInfo = loadLocalStorage(CONTACT_INFO);

    if(userInfo){
        userName.val(userInfo.username);
        email.val( userInfo.email);
        phone.val( userInfo.phone);
    }

    
    $('.btn-contact').click(function (){
       let info = {
            username : userName.val(),
            email : email.val(),
            phone : phone.val(),
       };
       localStorage.setItem(CONTACT_INFO , JSON.stringify(info))
    })

    function loadLocalStorage(key){
        let value = localStorage.getItem(key);
        if(value){
            if (value) {
                value = JSON.parse(value);
              }
              return value;
        }
    }
});
