(function($) {
    "use strict";

    if ($('table#table-gallerylist').length) {
        //Category list
        var categorylistdatatable;
        if (categorylistdatatable) {
            categorylistdatatable.fnClearTable(0);
            categorylistdatatable.fnDestroy();
        }
        categorylistdatatable = $('table#table-gallerylist').dataTable({
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
                url: host + "admin/ajax_gallerylist", // json datasource
                type: "post", // method  , by default get
                "data": function(params) {
                    params.inventoryid = inventoryid;
                },
                error: function() { // error handling
                    console.log('Error: serverside. ');
                }
            },
        });

        $(window).resize();

        //Publish
        $('table#table-gallerylist').on('click', 'a[id^="publish-"]', function() {
            var galleryid = $(this).attr('id').replace('publish-', '');
            $.ajax({
                url: host + 'admin/publishgallery/' + galleryid,
                type: "POST",
                dataType: 'html',
                data: {},
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    // console.log(responce);
                    responce = JSON.parse(responce);
                    popmessage(responce.status, responce.message);
                    $('table#table-gallerylist').DataTable().ajax.reload();
                    return false;
                }
            });
        });

        //Remove
        $('table#table-gallerylist').on('click', 'a[id^="delete-"]', function() {
            var galleryid = $(this).attr('id').replace('delete-', '');
            $.ajax({
                url: host + 'admin/deletegallery/' + galleryid,
                type: "POST",
                dataType: 'html',
                data: {},
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    // console.log(responce);
                    responce = JSON.parse(responce);
                    popmessage(responce.status, responce.message);
                    $('table#table-gallerylist').DataTable().ajax.reload();
                    return false;
                }
            });
        });

        $('button#listadd').click(function() {
            $('div#galleryModal').modal('show');
        });

        $('button#listback').click(function() {
            var target = host + 'admin/' + productslug + '/inventorylist';
            window.location.href = target;
        });
    }

    if ($('form#addgalleryfrm').length) {

        //Dropzone
        Dropzone.autoDiscover = false;
        var acceptedFileTypes = "image/*";
        var fileList = new Array;
        var i = 0;
        $("div#galleryUploader").dropzone({
            url: host + 'admin/upload',
            addRemoveLinks: true,
            acceptedFiles: acceptedFileTypes,
            init: function() {

                this.on("removedfile", function(file) {
                    // console.log(file);
                    __removeUpload(file.name);
                });
                this.on("sending", function(file, xhr, formData) {
                    formData.append("filepath", 'gallery/' + genre);
                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                });
            },
            success: function(file, response) {
                // console.log(response);
                fileList[file.name] = response.name;
                __updateImageInput(response.name);
            },
            error: function(file, response) {
                file.previewElement.classList.add("dz-error");
            }
        });

        var __updateImageInput = function(file) {
            var imgs = [];
            var exist = $('input#gallery_image').val();
            if (exist != '') {
                imgs = exist.split(', ');
            }
            imgs.push(file);
            var input = imgs.join(', ');
            $('input#gallery_image').val(input);
        };

        var __removeUpload = function(file) {
            var target = host + 'admin/removeupload';
            $.ajax({
                url: target,
                type: "POST",
                dataType: 'html',
                data: {
                    'path': 'gallery/' + genre,
                    'file': fileList[file]
                },
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    // console.log(responce);
                    delete fileList[file];
                    return false;
                }
            });
        };

        var res = false;


        $('form#addgalleryfrm').submit(function(e) {
            e.preventDefault();
            res = $('input#inventoryid').notempty(error_class);
            res = res && $('input#productid').notempty(error_class);

            var arg = {
                'genre': genre,
                'productid': productid,
                'inventoryid': inventoryid,
                'images': $('input#gallery_image').val()
            };

            if (res) {
                $.ajax({
                    url: host + 'admin/uploadgallery',
                    type: "POST",
                    dataType: 'html',
                    data: arg,
                    timeout: 20000,
                    cache: false,
                    success: function(responce) {
                        console.log(responce);
                        responce = JSON.parse(responce);
                        popmessage(responce.status, responce.message);
                        setTimeout(function() {
                            $('div#galleryModal').modal('hide');
                            $('table#table-gallerylist').DataTable().ajax.reload();
                        }, 2000);
                        return false;
                    }
                });
            }
        });

    }



})(jQuery);