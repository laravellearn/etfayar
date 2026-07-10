function showLoading() {
    $.LoadingOverlay("show");
}

function hideLoading() {
    $.LoadingOverlay("hide");
}

function showSuccessToast(title, msg) {
    toastr.success(msg, title, {
        rtl: true,
        positionClass: 'toast-top-left'
    });
}

function showFailToast(title, msg) {
    toastr.error(msg, title, {
        rtl: true,
        positionClass: 'toast-top-left'
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#blah")
                .attr('src', e.target.result)
                .width(150)
                .height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function logi($msg) {
    console.log($msg)
}

function deleteDialog(title, content, actionUrl) {
    $.alert({

        title: title,
        content: content,
        rtl: true,
        closeIcon: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-blue',
                action: function () {
                    //$.alert('حذف شد.');
                    window.location.href = actionUrl
                    showSuccessToast("حذف", "حذف با موفقیت انجام شد.")
                }
            },
            cancel: {
                text: 'انصراف',
                action: function () {
                }
            }
        }
    });
}

function changeDialog(title, content, actionUrl) {
    $.alert({

        title: title,
        content: content,
        rtl: true,
        closeIcon: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-blue',
                action: function () {
                    window.location.href = actionUrl
                    //showSuccessToast("انجام شد", "تغییر با موفقیت انجام شد.")
                }
            },
            cancel: {
                text: 'انصراف',
                action: function () {
                }
            }
        }
    });
}

function makeid(length) {
    var result = '';
    //var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    //var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() *
            charactersLength));
    }
    return result;
}

let tagArr = document.getElementsByTagName("input");
for (let i = 0; i < tagArr.length; i++) {
    tagArr[i].autocomplete = 'off';
}


function fir(el) {
    let elementValue = el.options[el.selectedIndex].value;
    let elementQuantity = el.options[el.selectedIndex].dataset.quantity;
    let elementParent = el.parentElement.parentElement.parentElement;
    let countElement = elementParent.getElementsByClassName("count_element")[0];
    //countElement.value=elementValue;
    countElement.setAttribute("max", elementQuantity);
    if (countElement.value > elementQuantity) {
        countElement.value = elementQuantity;
    }
    console.log(countElement);
}



