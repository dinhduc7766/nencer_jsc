/**
 * Using jQuery here
 */
$(document).ready(function () {
    /**
     * Using jQuery validate
     * 
     * Validation for Login form
     */
    $('#login_form').validate({
        rules: {
            'email': {
                'required': true
            },
            'password': {
                'required': true,
                'minlength': 3
            }
        },
        messages: {
            'email': {
                'required': 'Bạn hãy nhập email!'
            },
            'password': {
                'required': 'Bạn hãy nhập mật khẩu!',
                'minlength': ' Mật khẩu phải nhiều hơn 3 ký tự.'
            }
        },
        submitHandler: function (form) {
            // Submit data to server
            form.submit();
        }
    });

    /**
     * Using jQuery validate
     * 
     * Validation for create receipts form
     */
    $('#form_create_receipts').validate({
        rules: {
            'receipt_name': {
                'required': true,
                'minlength': 3,
                'maxlength': 255
            },
            'delivery_date': {
                'required': true
            },
            'image': {
                'required': true,
                'accept': "image/jpg, image/jpeg"
            }
        },
        messages: {
            'receipt_name': {
                'required': 'Bạn hãy nhập tên đơn hàng.',
                'minlength': 'Tên đơn hàng phải lớn hơn 3 ký tự.',
                'maxlength': 'Tên đơn hàng không vượt quá 255 ký tự.'
            },
            'delivery_date': {
                'required': 'Hãy chọn ngày giao hàng dự kiến'
            },
            'image': {
                'required': 'Bạn hãy tải hình ảnh hoá đơn.',
                'accept': 'Định dạng hình ảnh hoá đơn không đúng.'
            }
        },
        submitHandler: function (form) {
            // Submit data to server
            form.submit();
        }
    });

    /**
     * Using jQuery validate
     * 
     * Validation for create receipts form
     */
    $('#storage-form').validate({
        rules: {
            'name': {
                'required': true,
            },
            'cost': {
                'required': true
            }
        },
        messages: {
            'name': {
                'required': ' Bạn hãy nhập tên kho.',
            },
            'cost': {
                'required': 'Kho phải có giá duy trì.'
            }
        },
        submitHandler: function (form) {
            // Submit data to server
            form.submit();
        }
    });
    /**
     * Using jQuery validate.
     * 
     * Validation for create employee.
     */
    $('#employee_create_form').validate({
        rules: {
            'email': {
                'required': true,
                'maxlength': 29
            },
            'password': {
                'required': true,
                'minlength': 8,
                'maxlength': 29
            }
        },
        messages: {
            'email': {
                'required': ' Bạn hãy nhập email.',
                'maxlength': 'Email không quá 29 ký tự.'
            },
            'password': {
                'required': 'Bạn hãy nhập mật khẩu cho người này.',
                'minlength': 'Mật khẩu phải trên 8 ký tự.',
                'maxlength': 'Mật khẩu không quá 29 ký tự.'
            }
        },
        submitHandler: function (form) {
            // Submit data to server
            form.submit();
        }
    });
    /**
     * Using jQuery validate.
     * 
     * Validation for edited employee.
     */
    $('#employee_edit_form').validate({
        rules: {
            'password': {
                'required': true,
                'minlength': 8,
                'maxlength': 29
            }
        },
        messages: {
            'password': {
                'required': 'Bạn hãy nhập mật khẩu cho người này.',
                'minlength': 'Mật khẩu phải trên 8 ký tự.',
                'maxlength': 'Mật khẩu không quá 29 ký tự.'
            }
        },
        submitHandler: function (form) {
            // Submit data to server
            form.submit();
        }
    });
})