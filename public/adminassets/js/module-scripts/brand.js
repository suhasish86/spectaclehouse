(function($) {
    "use strict";

    if ($('table#table-brandlist').length) {
        //Brand list
        var brandlistdatatable;
        if (brandlistdatatable) {
            brandlistdatatable.fnClearTable(0);
            brandlistdatatable.fnDestroy();
        }
        brandlistdatatable = $('table#table-brandlist').dataTable({
            "bProcessing": false,
            "bLengthChange": true,
            "bStateSave": true,
            "bInfo": true,
            "bPaginate": true,
            "bFilter": true,
            'iDisplayLength': 10,
            "sPaginationType": "full_numbers",
            "dom": 'T<"clear">lfrtip',
            "bSortable": false,
            "ordering": true,
            "serverSide": true,
            "ajax": {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: host + "admin/ajax_brandlist", // json datasource
                type: "post", // method  , by default get
                "data": function(params) {
                    params.product = product;
                },
                error: function() { // error handling
                    console.log('Error: serverside. ');
                }
            },
        });

        $(window).resize();

        //Publish
        $('table#table-brandlist').on('click', 'a[id^="publish-"]', function() {
            var brandslug = $(this).attr('id').replace('publish-', '');
            $.ajax({
                url: host + 'admin/publishbrand/' + brandslug,
                type: "POST",
                dataType: 'html',
                data: {},
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    // console.log(responce);
                    responce = JSON.parse(responce);
                    popmessage(responce.status, responce.message);
                    $('table#table-brandlist').DataTable().ajax.reload();
                    return false;
                }
            });
        });

        //Remove
        $('table#table-brandlist').on('click', 'a[id^="delete-"]', function() {
            var brandslug = $(this).attr('id').replace('delete-', '');
            $.ajax({
                url: host + 'admin/deletebrand/' + brandslug,
                type: "POST",
                dataType: 'html',
                data: {},
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    // console.log(responce);
                    responce = JSON.parse(responce);
                    popmessage(responce.status, responce.message);
                    $('table#table-brandlist').DataTable().ajax.reload();
                    return false;
                }
            });
        });

        $('button#listadd').click(function() {
            var target = host + 'admin/' + product + '/createbrand';
            window.location.href = target;
        });
    }

    if ($('form#createbrandfrm').length) {

        //Dropzone
        // Dropzone.autoDiscover = false;
        // var acceptedFileTypes = "image/*";
        // var fileList = new Array;
        // var i = 0;
        // $("div#bannerUploader").dropzone({
        //     url: host + 'admin/upload',
        //     addRemoveLinks: true,
        //     maxFiles: 1,
        //     init: function() {
        //         //Load previous image
        //         var banner = {
        //             name: $("div#bannerUploader").attr('data-file'),
        //             size: $("div#bannerUploader").attr('data-size'),
        //             path: $("div#bannerUploader").attr('data-link')
        //         }

        //         if (banner.name != null && banner.size > 0) {
        //             this.options.addedfile.call(this, banner);
        //             this.options.thumbnail.call(this, banner, banner.path);
        //             this.files[0] = banner;
        //         }

        //         this.on("addedfile", function(file) {
        //             if (this.files.length > 1) {
        //                 this.removeFile(this.files[0]);
        //             }
        //         });

        //         this.on("removedfile", function(file) {
        //             // console.log(file);
        //             __removeUpload(file.name);
        //         });
        //         this.on("sending", function(file, xhr, formData) {
        //             formData.append("filepath", 'brandbanner');
        //             formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        //         });
        //     },
        //     success: function(file, response) {
        //         console.log(response);
        //         $('input#banner').val(response.name);
        //     },
        //     error: function(file, response) {
        //         file.previewElement.classList.add("dz-error");
        //     }
        // });

        // var __removeUpload = function(file) {
        //     var slug = $('input#brandslug').val();
        //     var target = (slug != '') ? host + 'admin/deletebrandbanner/' + slug : host + 'admin/removeupload';
        //     $.ajax({
        //         url: target,
        //         type: "POST",
        //         dataType: 'html',
        //         data: {
        //             'path': 'brandbanner',
        //             'file': file
        //         },
        //         timeout: 20000,
        //         cache: false,
        //         success: function(responce) {
        //             // console.log(responce);
        //             return false;
        //         }
        //     });
        // };

        var res = false;

        //Focus script
        $('input#brandname').activeFocus(error_class);
        $('input#browsertitle').activeFocus(error_class);
        $('input#metakeyword').activeFocus(error_class);
        $('input#metadescription').activeFocus(error_class);

        $('form#createbrandfrm').submit(function(e) {
            e.preventDefault();
            res = $('input#brandname').notempty(error_class);
            res = res && $('input#browsertitle').notempty(error_class);
            res = res && $('input#metakeyword').notempty(error_class);
            res = res && $('input#metadescription').notempty(error_class);

            //Target & Redirect Url
            var slug = $('input#brandslug').val();
            var target = (slug == '') ? host + 'admin/savebrand' : host + 'admin/updatebrand/' + slug
            var redirect = host + 'admin/' + product + '/brandlist';

            if (res) {
                var arg = $("form#createbrandfrm").serialize();
                console.log(arg);
                $.ajax({
                    url: target,
                    type: "POST",
                    dataType: 'html',
                    data: arg,
                    timeout: 20000,
                    cache: false,
                    success: function(responce) {
                        // console.log(responce);
                        responce = JSON.parse(responce);
                        popmessage(responce.status, responce.message);
                        setTimeout('window.location.href="' + redirect + '";', 2000);
                        return false;
                    }
                });
            }
        });

    }



})(jQuery);