jQuery.validator.addMethod("noSpace", function(value, element) {
    return value == '' || value.trim().length != 0;
}, "No space please and don't leave it empty");
jQuery.validator.addMethod("customEmail", function(value, element) {
    return this.optional(element) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
}, "Please enter valid email address!");
jQuery.validator.addMethod("customPhone", function(value, element) {
    return this.optional(element) || /^[0-9]*$/.test(value);
}, "Please enter valid phone!");
$.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
}, "Letters, numbers, and underscores only please");
$.validator.addMethod('filesize', function(value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
});
$.validator.addMethod('customPassword', function(value, element) {
    return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(value);
}, "Please enter valid password!");
var $loginForm = $('#login-form');
if ($loginForm.length) {
    $loginForm.validate({
        rules: {
            email: {
                required: true,
                customEmail: true
            },
            password: {
                required: true,
                customPassword: true
            },
        },
        messages: {
            email: {
                required: 'Please enter email!',
                email: 'Please enter valid email!'
            },
            password: {
                required: 'Please enter password!',
                password: 'Please enter valid password!'
            },
        },
    });
}
var $changeForm = $('#change-form');
if ($changeForm.length) {
    $changeForm.validate({
        rules: {
            password: {
                required: true,
                customPassword: true
            },
            password_confirmation: {
                required: true,
                equalTo: '#password'
            }
        },
        messages: {
            password: {
                required: 'Please enter password!',
                password: 'Please enter valid password!'
            },
            password_confirmation: {
                required: 'Please enter password confirm!',
                equalTo: 'Please enter same password!'
            },
        },
    });
}
var $addForm = $('#add-user-form');
if ($addForm.length) {
    $addForm.validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                customEmail: true
            },
            password: {
                required: true,
                customPassword: true
            },

            phone: {
                required: true,
                customPhone: true
            },
            address: {
                required: true
            },
            gender: {
                required: true
            }
        },
        messages: {
            name: {
                required: 'Please enter username!'
            },
            email: {
                required: 'Please enter email!',
                email: 'Please enter valid email!'
            },
            password: {
                required: 'Please enter password!',
                password: 'Please enter valid password!'
            },
            phone: {
                required: 'Please enter phone!',
                customPhone: "Please enter valid phone!"
            },
            address: {
                required: 'Please enter address!'
            },
            gender: {
                required: 'Please select address!'
            }
        },
    });
}
var $editForm = $('#edit-user-form');
if ($editForm.length) {
    $editForm.validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                customEmail: true
            },
            phone: {
                required: true,
                customPhone: true
            },
            address: {
                required: true
            },
            gender: {
                required: true
            }
        },
        messages: {
            name: {
                required: 'Please enter username!'
            },
            email: {
                required: 'Please enter email!',
                email: 'Please enter valid email!'
            },
            phone: {
                required: 'Please enter phone!',
                customPhone: "Please enter valid phone!"
            },
            address: {
                required: 'Please enter address!'
            },
            gender: {
                required: 'Please select address!'
            }
        },
    });
}
var $editForm = $('#edit-order-form');
if ($editForm.length) {
    $editForm.validate({
        rules: {
            phone: {
                required: true,
                customPhone: true
            },
            address: {
                required: true
            },
        },
        messages: {
            phone: {
                required: 'Please enter phone!',
                customPhone: "Please enter valid phone!"
            },
            address: {
                required: 'Please enter address!'
            },
        },
    });
}
var $addProductForm = $('#addProduct');
if ($addProductForm.length) {
    $addProductForm.validate({
        rules: {
            product_name: {
                required: true
            },
            product_slug: {
                required: true
            },
            product_desc: {
                required: true
            },
            product_detail: {
                required: true
            },
            product_price: {
                required: true,
                customPhone: true
            },
            product_cate: {
                required: true
            },
            product_thumb: {
                required: true,
                filesize: 1048576,
            },
            product_images: {
                required: true,
            },
        },
        messages: {
            product_name: {
                required: 'Please enter product name!'
            },
            product_slug: {
                required: 'Please enter product slug!'
            },
            product_desc: {
                required: 'Please enter description!',
            },
            product_detail: {
                required: 'Please enter product detail!'
            },
            product_price: {
                required: 'Please enter product price!',
                customPhone: "Please enter valid price!"
            },
            product_cate: {
                required: 'Please select category!'
            },
            product_thumb: {
                required: 'Please select thumbnail!',
            },
            product_images: {
                required: 'Please select images!'
            },
        },

    });
}
var $editProductForm = $('#editProduct');
if ($editProductForm.length) {
    $editProductForm.validate({
        rules: {
            product_name: {
                required: true
            },
            product_slug: {
                required: true
            },
            product_desc: {
                required: true
            },
            product_detail: {
                required: true
            },
            product_price: {
                required: true,
                customPhone: true
            },
            product_cate: {
                required: true
            },
            product_thumb: {
                filesize: 1048576,
            },
            product_images: {
                filesize: 1048576,
            },
        },
        messages: {
            product_name: {
                required: 'Please enter product name!'
            },
            product_slug: {
                required: 'Please enter product slug!'
            },
            product_desc: {
                required: 'Please enter description!',
            },
            product_detail: {
                required: 'Please enter product detail!'
            },
            product_price: {
                required: 'Please enter product price!',
                customPhone: "Please enter valid price!"
            },
            product_cate: {
                required: 'Please select category!'
            },
            product_thumb: {
                extension: 'File must be JPEG, JPG or PNG'
            },
            product_images: {
                required: 'Please select images!'
            },
        },

    });
}
var $registerForm = $('#register-form');
if ($registerForm.length) {
    $registerForm.validate({
        rules: {
            username: {
                required: true,
            },
            email: {
                required: true,
                customEmail: true
            },
            password: {
                required: true,
                customPassword: true
            },
            passwordConfirm: {
                required: true,
                equalTo: '#password'
            }
        },
        messages: {
            username: {
                required: 'Please enter username!'
            },
            email: {
                required: 'Please enter email!',
                email: 'Please enter valid email!'
            },
            password: {
                required: 'Please enter password!',
                password: 'Please enter valid password!'
            },
            passwordConfirm: {
                required: 'Please enter password confirm!',
                equalTo: 'Please enter same password!'
            },
        },
    });
}
var $infoForm = $('#info-form');
if ($infoForm.length) {
    $infoForm.validate({
        rules: {
            username: {
                required: true,
            },
            email: {
                required: true,
                customEmail: true
            },
            phone: {
                required: true,
                customPhone: true
            },
            address: {
                required: true
            },
            gender: {
                required: true
            }
        },
        messages: {
            username: {
                required: 'Please enter username!'
            },
            email: {
                required: 'Please enter email!',
                email: 'Please enter valid email!'
            },
            phone: {
                required: 'Please enter phone!',
                customPhone: "Please enter valid phone!"
            },
            address: {
                required: 'Please enter address!'
            },
            gender: {
                required: 'Please select address!'
            }
        },
    });
}
var $checkoutForm = $('#checkout-form');
if ($checkoutForm.length) {
    $checkoutForm.validate({
        rules: {

            phone: {
                required: true,
                customPhone: true
            },
            address: {
                required: true
            },

        },
        messages: {

            phone: {
                required: 'Please enter phone!',
                customPhone: "Please enter valid phone!"
            },
            address: {
                required: 'Please enter address!'
            },

        },
    });
}
var $addCatForm = $('#add-cat-form');
if ($addCatForm.length) {
    $addCatForm.validate({
        rules: {
            name: {
                required: true
            },
            cate_slug: {
                required: true
            },

        },
        messages: {
            name: {
                required: 'Please enter category!'
            },
            cate_slug: {
                required: 'Please enter slug!'
            },

        },
    });
}
var $editCatForm = $('#edit-cat-form');
if ($editCatForm.length) {
    $editCatForm.validate({
        rules: {
            name: {
                required: true
            },

        },
        messages: {
            name: {
                required: 'Please enter category!'
            },

        },
    });
}
var $addOrder = $('#add-order');
if ($addOrder.length) {
    $addOrder.validate({
        rules: {
            username: {
                required: true,
            },
            email: {
                required: true,
                customEmail: true
            },
            phone: {
                required: true,
                customPhone: true
            },
            address: {
                required: true
            },

        },
        messages: {
            username: {
                required: 'Please enter username!'
            },
            email: {
                required: 'Please enter email!',
                email: 'Please enter valid email!'
            },
            phone: {
                required: 'Please enter phone!',
                customPhone: "Please enter valid phone!"
            },
            address: {
                required: 'Please enter address!'
            },

        },
    });
}
