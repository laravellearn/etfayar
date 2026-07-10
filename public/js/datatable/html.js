"use strict";
let KTDatatablesDataSourceHtml = function () {

    let initTableUsers = function () {
        let table = $('#kt_datatable_users');

        // begin first table
        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },

        });

    };

    let initTableRequests = function () {
        let table = $('#kt_datatable_requests');

        // begin first table
        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },

        });

    };

    let initTableRoles = function () {
        let table = $('#kt_datatable_role');

        // begin first table
        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },

        });

    };

    let initTablePermissions = function () {
        let table = $('#kt_datatable_permissions');

        // begin first table
        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },

        });

    };

    let initTableAdmins = function () {
        let table = $('#kt_datatable_admins');

        // begin first table
        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },

        });

    };

    let initTableService = function () {
        let table = $('#kt_datatable_service');

        // begin first table
        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },

        });

    };

    let initTableDescription = function () {
        let table = $('#kt_datatable_description');

        // begin first table
        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });

    };

    let initTableDeliveryDriver = function () {
        let table = $('#kt_datatable_delivery_driver');

        // begin first table
        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });

    };

    let initTableCollectDriver = function () {
        let table = $('#kt_datatable_collect_driver');

        // begin first table
        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });

    };

    let initTableInvoice = function () {
        let table = $('#kt_datatable_invoice');

        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });

    };

    let initTableBanks = function () {
        let table = $('#kt_datatable_banks');

        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });

    };

    let initTableInformations = function () {
        let table = $('#kt_datatable_informations');

        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });

    };

    let initTableFireExtinguisherParts = function () {
        let table = $('#kt_datatable_fireExtinguisherParts');

        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });

    };

    let initTableWorkshop = function () {
        let table = $('#kt_datatable_workshop');

        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });

    };

    let initTableOfficeForms = function () {
        let table = $('#kt_datatable_officeForms');

        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });

    };

    let initTableOfficeRequests = function () {
        let table = $('#kt_datatable_officeRequests');

        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });

    };

    let initTableMyOfficeRequests = function () {
        let table = $('#kt_datatable_myOfficeRequests');

        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });

    };

    let initTableCreateOfficeRequests = function () {
        let table = $('#kt_datatable_createOfficeRequests');

        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });

    };

    let initTableAcquaintances = function () {
        let table = $('#kt_datatable_acquaintances');

        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: true,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });

    };

    let initTableChooseProducts = function () {
        let table = $('#kt_datatable_choose_products');

        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            select: false,
            stateSave: true,
            paging:false,
            ordering: false,
            responsive: true,
            autoWidth: false,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });

    };

    let initTableInsurances = function () {
        let table = $('#kt_datatable_insurances');

        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: false,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });

    };

    let initTableMessageReports = function () {
        let table = $('#kt_datatable_message_reports');

        table.DataTable({
            lengthMenu: [5, 10, 25, 50, 75, 100],
            displayLength: 5,
            iDisplayLength: 5,
            stateSave: true,
            ordering: false,
            responsive: true,
            autoWidth: false,
            autoHeight: false,
            direction: "rtl",
            language: {
                sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },


        });


    };


    return {

        //main function to initiate the module
        init: function () {
            initTableUsers();
            initTableRequests();
            initTableRoles();
            initTablePermissions();
            initTableService();
            initTableDescription();
            initTableAdmins();
            initTableDeliveryDriver();
            initTableCollectDriver();
            initTableInvoice();
            initTableBanks();
            initTableInformations();
            initTableFireExtinguisherParts();
            initTableWorkshop();
            initTableOfficeForms();
            initTableOfficeRequests();
            initTableMyOfficeRequests();
            initTableCreateOfficeRequests();
            initTableAcquaintances();
            initTableChooseProducts();
            initTableInsurances();
            initTableMessageReports();
        },

    };

}();

jQuery(document).ready(function () {
    KTDatatablesDataSourceHtml.init();

});
