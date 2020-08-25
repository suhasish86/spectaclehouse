(function($) {
    "use strict";

    if ($('table#table-materiallist').length) {
        //Material list
        var materiallistdatatable;
        if (materiallistdatatable) {
            materiallistdatatable.fnClearTable(0);
            materiallistdatatable.fnDestroy();
        }
        materiallistdatatable = $('table#table-materiallist').dataTable({
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
                url: host + "admin/ajax_materiallist", // json datasource
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
        $('table#table-materiallist').on('click', 'a[id^="publish-"]', function() {
            var materialslug = $(this).attr('id').replace('publish-', '');
            $.ajax({
                url: host + 'admin/publishmaterial/' + materialslug,
                type: "POST",
                dataType: 'html',
                data: {},
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    // console.log(responce);
                    responce = JSON.parse(responce);
                    popmessage(responce.status, responce.message);
                    $('table#table-materiallist').DataTable().ajax.reload();
                    return false;
                }
            });
        });

        //Remove
        $('table#table-materiallist').on('click', 'a[id^="delete-"]', function() {
            var materialslug = $(this).attr('id').replace('delete-', '');
            $.ajax({
                url: host + 'admin/deletematerial/' + materialslug,
                type: "POST",
                dataType: 'html',
                data: {},
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    // console.log(responce);
                    responce = JSON.parse(responce);
                    popmessage(responce.status, responce.message);
                    $('table#table-materiallist').DataTable().ajax.reload();
                    return false;
                }
            });
        });

        $('button#listadd').click(function() {
            var target = host + 'admin/' + product + '/creatematerial';
            window.location.href = target;
        });
    }

    if ($('form#creatematerialfrm').length) {

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
        //             formData.append("filepath", 'materialbanner');
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
        //     var slug = $('input#materialslug').val();
        //     var target = (slug != '') ? host + 'admin/deletematerialbanner/' + slug : host + 'admin/removeupload';
        //     $.ajax({
        //         url: target,
        //         type: "POST",
        //         dataType: 'html',
        //         data: {
        //             'path': 'materialbanner',
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
        $('input#materialname').activeFocus(error_class);
        $('input#browsertitle').activeFocus(error_class);
        $('input#metakeyword').activeFocus(error_class);
        $('input#metadescription').activeFocus(error_class);

        $('form#creatematerialfrm').submit(function(e) {
            e.preventDefault();
            res = $('input#materialname').notempty(error_class);
            res = res && $('input#browsertitle').notempty(error_class);
            res = res && $('input#metakeyword').notempty(error_class);
            res = res && $('input#metadescription').notempty(error_class);

            //Target & Redirect Url
            var slug = $('input#materialslug').val();
            var target = (slug == '') ? host + 'admin/savematerial' : host + 'admin/updatematerial/' + slug
            var redirect = host + 'admin/' + product + '/materiallist';

            if (res) {
                var arg = $("form#creatematerialfrm").serialize();
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