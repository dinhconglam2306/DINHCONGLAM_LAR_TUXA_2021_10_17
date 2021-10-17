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
