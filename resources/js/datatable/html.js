"use strict";
let KTDatatablesDataSourceHtml = function () {

    let initTableRoles = function () {
        let table = $('#kt_datatable_role');

        // begin first table
        table.DataTable({
            language: {
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },
            responsive: true,
            direction: "rtl",
            columnDefs: [
                /* {
                     targets: -1,
                     title: 'عملیات',
                     orderable: false,
                     render: function (data, type, full, meta) {
                         return '\
                             <a href="/user/roles/edit/" class="btn btn-sm btn-clean btn-icon" title="Edit details">\
                                 <i class="la la-edit"></i>\
                             </a>\
                         ';
                     },
                 },*/
                {
                    width: '75px',
                    targets: 3,
                    render: function (data, type, full, meta) {
                        var status = {
                            1: {'title': 'فعال', 'class': ' label-light-success'},
                            2: {'title': 'غیر فعال', 'class': ' label-light-danger'},
                            3: {'title': 'لغو شده', 'class': ' label-light-primary'},
                            4: {'title': 'موفق', 'class': ' label-light-success'},
                            5: {'title': 'اطلاعات', 'class': ' label-light-info'},
                            6: {'title': 'اخطار', 'class': ' label-light-danger'},
                            7: {'title': 'هشدار', 'class': ' label-light-warning'},
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                    },
                }
            ],
        });

    };

    let initTablePermissions = function () {
        let table = $('#kt_datatable_permissions');

        // begin first table
        table.DataTable({
            language: {
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },
            responsive: true,
            direction: "rtl",
            columnDefs: [

                {
                    width: '75px',
                    targets: 3,
                    render: function (data, type, full, meta) {
                        let status = {
                            1: {'title': 'فعال', 'class': ' label-light-success'},
                            2: {'title': 'غیر فعال', ' class': ' label-light-danger'},
                            3: {'title': 'لغو شده', 'class': ' label-light-primary'},
                            4: {'title': 'موفق', 'class': ' label-light-success'},
                            5: {'title': 'اطلاعات', 'class': ' label-light-info'},
                            6: {'title': 'اخطار', 'class': ' label-light-danger'},
                            7: {'title': 'هشدار', 'class': ' label-light-warning'},
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                    },
                }
            ],
        });

    };

    let initTableUsers = function () {
        let table = $('#kt_datatable_users');

        // begin first table
        table.DataTable({
            language: {
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },
            responsive: true,
            direction: "rtl",
            columnDefs: [

                {
                    width: '75px',
                    targets: 4,
                    render: function (data, type, full, meta) {
                        let status = {
                            1: {'title': 'فعال', 'class': ' label-light-success'},
                            2: {'title': 'غیر فعال', 'class': ' label-light-danger'},
                            3: {'title': 'لغو شده', 'class': ' label-light-primary'},
                            4: {'title': 'موفق', 'class': ' label-light-success'},
                            5: {'title': 'اطلاعات', 'class': ' label-light-info'},
                            6: {'title': 'اخطار', 'class': ' label-light-danger'},
                            7: {'title': 'هشدار', 'class': ' label-light-warning'},
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                    },
                }
            ],
        });

    };

    let initTableService = function () {
        let table = $('#kt_datatable_service');

        // begin first table
        table.DataTable({
            language: {
                paginate: {
                    previous: "قبلی",
                    next: "بعدی",
                }
            },
            responsive: true,
            direction: "rtl",
            columnDefs: [
                {
                    width: '75px',
                    targets: 1,
                    render: function (data, type, full, meta) {
                        var status = {
                            0: {'title': 'غیر فعال', 'class': ' label-light-danger'},
                            1: {'title': 'فعال', 'class': ' label-light-success'},
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                    },
                }
            ],
        });

    };


    return {

        //main function to initiate the module
        init: function () {
            initTableRoles();
            initTablePermissions();
            initTableUsers();
            initTableService();
        },

    };

}();

jQuery(document).ready(function () {
    //KTUtil.isRTL();
    KTDatatablesDataSourceHtml.init();
});
