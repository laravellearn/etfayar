// Class definition
let KTFormControls = function () {
    // Private functions
    let _initAddUserForm = function () {
        FormValidation.formValidation(
            // Select2
            document.getElementById('add_user_form'), {
                fields: {
                    name2: {
                        validators: {
                            notEmpty: {
                                message: 'The username is required'
                            },
                            /*remote: {
                                message: 'The username is already taken',
                                method: 'GET',
                                url: '...',
                            },*/
                        }
                    },
                    email: {
                        validators: {
                            emailAddress: {
                                message: "مقدار یک آدرس ایمیل معتبر نیست"
                            }
                        }
                    },

                    website: {
                        validators: {
                            uri: {
                                message: "آدرس وب سایت معتبر نیست."
                            }
                        }
                    },

                    address: {
                        validators: {
                            notEmpty: {
                                message: "آدرس لازم است."
                            }
                        }
                    },


                    'mobile': {
                        validators: {

                            stringLength: {
                                min: 11,
                                max: 11,
                                message: "تعداد عددهای تلفن همراه باید 11 عدد باشد."
                            },
                            digits: {
                                message: "مقادیر وارد شده باید عددی باشند."
                            },
                            regexp: {
                                regexp: '09.*',
                                message: "شماره موبایل باید با 09 شروع شود"
                            }, remote: {
                                message: 'این شماره موبایل قبلا ثبت شده است',
                                method: 'GET',
                                url: '/api/check',
                            },
                        }
                    },
                    'mobile_additional': {
                        validators: {
                            stringLength: {
                                min: 11,
                                max: 11,
                                message: "تعداد عددهای تلفن همراه باید 11 عدد باشد."
                            },
                            digits: {
                                message: "مقادیر وارد شده باید عددی باشند."
                            },
                            regexp: {
                                regexp: '09.*',
                                message: "شماره موبایل باید با 09 شروع شود"
                            }, remote: {
                                message: 'این شماره موبایل قبلا ثبت شده است',
                                method: 'GET',
                                url: '/api/check',
                            },
                        }
                    }/*, input: {
                        selector: '[class="form-control mobile"]',
                        validators: {
                            notEmpty: {
                                message: 'تلفن همراه لازم است.'
                            },
                            stringLength: {
                                min: 11,
                                max: 11,
                                message: "تعداد عددهای تلفن همراه باید 11 عدد باشد."
                            },
                            digits: {
                                message: "مقادیر وارد شده باید عددی باشند."
                            },
                            regexp: {
                                regexp: '09.*',
                                message: "شماره موبایل باید با 09 شروع شود"
                            }, remote: {
                                message: 'این شماره موبایل قبلا ثبت شده است',
                                method: 'GET',
                                url: '/api/check',
                            },
                        }
                    }*/, 'group_mobile': {
                        selector: '.mobile',
                        validators: {

                            stringLength: {
                                min: 11,
                                max: 11,
                                message: "تعداد عددهای تلفن همراه باید 11 عدد باشد."
                            },
                            digits: {
                                message: "مقادیر وارد شده باید عددی باشند."
                            },
                            regexp: {
                                regexp: '09.*',
                                message: "شماره موبایل باید با 09 شروع شود"
                            }, remote: {
                                message: 'این شماره موبایل قبلا ثبت شده است',
                                method: 'GET',
                                url: '/api/check',
                            },
                        }
                    },


                    city_id2: {
                        validators: {
                            notEmpty: {
                                message: 'انتخاب شهر لازم است'
                            }
                        }
                    },

                    digits: {
                        validators: {
                            notEmpty: {
                                message: 'ارقام لازم است'
                            },
                            digits: {
                                message: "مقدار یک رقم معتبر نیست"
                            }
                        }
                    },

                    creditcard: {
                        validators: {
                            notEmpty: {
                                message: "شماره کارت اعتباری لازم است"
                            },
                            creditCard: {
                                message: "شماره کارت اعتباری معتبر نیست"
                            }
                        }
                    },

                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'شماره تلفن ایالات متحده مورد نیاز است'
                            },
                            phone: {
                                country: 'US',
                                message: "این مقدار شماره تلفن معتبر ایالات متحده نیست"
                            }
                        }
                    },

                    option: {
                        validators: {
                            notEmpty: {
                                message: 'لطفا یک گزینه را انتخاب کنید'
                            }
                        }
                    },
                    'city_id': {
                        validators: {
                            notEmpty: {
                                message: 'لطفا یک گزینه را انتخاب کنید'
                            }
                        }
                    },

                    options: {
                        validators: {
                            choice: {
                                min: 2,
                                max: 5,
                                message: "لطفا حداقل 2 و حداکثر 5 گزینه را انتخاب کنید"
                            }
                        }
                    },

                    memo: {
                        validators: {
                            notEmpty: {
                                message: "لطفا متن یادداشت را وارد کنید"
                            },
                            stringLength: {
                                min: 50,
                                max: 100,
                                message: "لطفاً یک فهرست را در محدوده متن 50 و 100 وارد کنید"
                            }
                        }
                    },

                    checkbox: {
                        validators: {
                            choice: {
                                min: 1,
                                message: "لطفا با مهربانی این را بررسی کنید"
                            }
                        }
                    },

                    'services[]': {
                        validators: {
                            choice: {
                                min: 1,
                                message: "لطفا حداقل 1 گزینه را انتخاب کنید"
                            }
                        }
                    },

                    radios: {
                        validators: {
                            choice: {
                                min: 1,
                                message: "لطفا با مهربانی این را بررسی کنید"
                            }
                        }
                    },
                },

                plugins: { //Learn more: https://formvalidation.io/guide/plugins
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                }
            }
        );
    };

    console.log(_initAddUserForm);

    return {
        // public functions
        init: function () {
            _initAddUserForm();
        }
    };

}();

jQuery(document).ready(function () {
    KTFormControls.init();
});
