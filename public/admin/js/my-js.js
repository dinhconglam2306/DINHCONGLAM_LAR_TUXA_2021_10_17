$(document).ready(function () {
    let $btnSearch = $("button#btn-search");
    let $btnClearSearch = $("button#btn-clear-search");

    let $inputSearchField = $("input[name  = search_field]");
    let $inputSearchValue = $("input[name  = search_value]");
    let $selectChangeAttr = $("select[name = select_change_attr]");

    $("a.select-field").click(function (e) {
        e.preventDefault();

        let field = $(this).data("field");
        let fieldName = $(this).html();
        $("button.btn-active-field").html(
            fieldName + ' <span class="caret"></span>'
        );
        $inputSearchField.val(field);
    });

    $btnSearch.click(function () {
        var pathname = window.location.pathname;
        let params = ["filter_status"];
        let searchParams = new URLSearchParams(window.location.search); // ?filter_status=active

        let link = "";
        $.each(params, function (key, param) {
            // filter_status
            if (searchParams.has(param)) {
                link += param + "=" + searchParams.get(param) + "&"; // filter_status=active
            }
        });

        let search_field = $inputSearchField.val();
        let search_value = $inputSearchValue.val();

        if (search_value.replace(/\s/g, "") == "") {
            alert("Nhập vào giá trị cần tìm !!");
        } else {
            window.location.href =
                pathname +
                "?" +
                link +
                "search_field=" +
                search_field +
                "&search_value=" +
                search_value;
        }
    });

    $btnClearSearch.click(function () {
        var pathname = window.location.pathname;
        let searchParams = new URLSearchParams(window.location.search);

        params = ["filter_status"];

        let link = "";
        $.each(params, function (key, param) {
            if (searchParams.has(param)) {
                link += param + "=" + searchParams.get(param) + "&";
            }
        });

        window.location.href = pathname + "?" + link.slice(0, -1);
    });

    $(".btn-delete").on("click", function () {
        if (!confirm("Bạn có chắc muốn xóa phần tử?")) return false;
    });

    $(".status-ajax").on("click", function () {
        let url = $(this).data("url");
        let btn = $(this);
        let currentClass = btn.data("class");
        callAjaxtypeButton(btn,url,'status',currentClass);
    });

    $(".ordering-ajax").on("change", function () {
        let value = $(this).val();
        let btn = $(this);
        let url = $(this).data("url");
        url = url.replace('value_new',value);
        // window.location.href = url;
        callAjaxtypeButton(btn,url,'ordering');
    });

    $(".is-home-ajax").on("click", function () {
        let url = $(this).data("url");
        let btn = $(this);
        let currentClass = btn.data("class");
        callAjaxtypeButton(btn,url,'is-home',currentClass)
    });

    $selectChangeAttr.on("change", function () {
        let btn = $(this);
        let selectValue = $(this).val();
        let url = $(this).data("url");
        url = url.replace("value_new", selectValue);
        callAjaxtypeButton(btn,url,'select')
    });

    // Click vào chọn ảnh thì mở file maneger
    $('#lfm').filemanager('image');

    // delete message after 2s
    let messageSuccess = $('.alert-info');
    let messageError = $('.alert-danger');
    
   
    setTimeout(function(){
        messageSuccess.hide('slow', function(){ messageSuccess.remove();});
        messageError.hide('slow', function(){ messageError.remove();});
    },3000);



    function callAjaxtypeButton(btn,url,type,currentClass = null){
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                console.log(response);
               switch (type) {
                    case 'status':
                        btn.removeClass(currentClass);
                        btn.addClass(response.statusObj.class);
                        btn.html(response.statusObj.name);
                        btn.data("url", response.link);
                        btn.data("class", response.statusObj.class);
                        btn.notify("Cập nhật thành công", {
                            position: "top center",
                            className: "success",
                        });
                    break;
                    case 'is-home':
                        btn.removeClass(currentClass);
                        btn.addClass(response.isHomeObj.class);
                        btn.html(response.isHomeObj.name);
                        btn.data("url", response.link);
                        btn.data("class", response.isHomeObj.class);
                        btn.notify("Cập nhật thành công", {
                            position: "top center",
                            className: "success",
                        });
                    break;
                    case 'select':
                        btn.notify(response.message, {
                            position: "top center",
                            className: "success",
                        });
                    break;
                    case 'ordering':
                        if(response){
                            btn.notify(response.message, {
                              position: "top center",
                              className: "success",
                          });
                          $(".modified-"+ response.id).html(response.modified)
                        }
                    break;
               }
            },
        });
    }
});