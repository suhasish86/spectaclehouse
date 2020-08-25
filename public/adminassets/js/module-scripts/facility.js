(function($) {
    "use strict";

    if ($('table#table-facilitylist').length) {
        //Facility list
        var facilitylistdatatable;
        if (facilitylistdatatable) {
            facilitylistdatatable.fnClearTable(0);
            facilitylistdatatable.fnDestroy();
        }
        facilitylistdatatable = $('table#table-facilitylist').dataTable({
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
                url: host + "admin/ajax_facilitylist", // json datasource
                type: "post", // method  , by default get
                "data": function(params) {
                    //extra params
                    params.type = facilitytype;
                },
                error: function() { // error handling
                    console.log('Error: serverside. ');
                }
            },
        });

        $(window).resize();

        //Publish
        $('table#table-facilitylist').on('click', 'a[id^="publish-"]', function() {
            var facilityslug = $(this).attr('id').replace('publish-', '');
            $.ajax({
                url: host + 'admin/publishfacility/' + facilityslug,
                type: "POST",
                dataType: 'html',
                data: {},
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    // console.log(responce);
                    responce = JSON.parse(responce);
                    popmessage(responce.status, responce.message);
                    $('table#table-facilitylist').DataTable().ajax.reload();
                    return false;
                }
            });
        });

        //Remove
        $('table#table-facilitylist').on('click', 'a[id^="delete-"]', function() {
            var facilityslug = $(this).attr('id').replace('delete-', '');
            $.ajax({
                url: host + 'admin/deletefacility/' + facilityslug,
                type: "POST",
                dataType: 'html',
                data: {},
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    // console.log(responce);
                    responce = JSON.parse(responce);
                    popmessage(responce.status, responce.message);
                    $('table#table-facilitylist').DataTable().ajax.reload();
                    return false;
                }
            });
        });

        $('button#listadd').click(function() {
            var target = host + 'admin/createfacility/' + facilitytype;
            window.location.href = target;
        });
    }

    if ($('form#createfacilityfrm').length) {

        //Dropzone
        Dropzone.autoDiscover = false;
        var acceptedFileTypes = "image/*";
        var fileList = new Array;
        var i = 0;
        $("div#imageUploader").dropzone({
            url: host + 'admin/upload',
            addRemoveLinks: true,
            maxFiles: 1,
            init: function() {
                //Load previous image
                var image = {
                    name: $("div#imageUploader").attr('data-file'),
                    size: $("div#imageUploader").attr('data-size'),
                    path: $("div#imageUploader").attr('data-link')
                }

                if (image.name != null && image.size > 0) {
                    this.options.addedfile.call(this, image);
                    this.options.thumbnail.call(this, image, image.path);
                    this.files[0] = image;
                }

                this.on("addedfile", function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });

                this.on("removedfile", function(file) {
                    // console.log(file);
                    __removeUpload(file.name);
                });
                this.on("sending", function(file, xhr, formData) {
                    formData.append("filepath", 'facilityimage');
                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                });
            },
            success: function(file, response) {
                console.log(response);
                $('input#image').val(response.name);
            },
            error: function(file, response) {
                file.previewElement.classList.add("dz-error");
            }
        });

        var __removeUpload = function(file) {
            var slug = $('input#facilityslug').val();
            var target = (slug != '') ? host + 'admin/deletefacilityimage/' + slug : host + 'admin/removeupload';
            $.ajax({
                url: target,
                type: "POST",
                dataType: 'html',
                data: {
                    'path': 'facilityimage',
                    'file': file
                },
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    // console.log(responce);
                    return false;
                }
            });
        };

        $("#description").summernote({
            height: 150
        });

        var res = false;

        //Focus script
        $('input#facilityname').activeFocus(error_class);
        $('input#browsertitle').activeFocus(error_class);
        $('input#metakeyword').activeFocus(error_class);
        $('input#metadescription').activeFocus(error_class);

        $('form#createfacilityfrm').submit(function(e) {
            e.preventDefault();
            res = $('input#facilityname').notempty(error_class);
            res = res && $('input#browsertitle').notempty(error_class);
            res = res && $('input#metakeyword').notempty(error_class);
            res = res && $('input#metadescription').notempty(error_class);

            //Target & Redirect Url
            var slug = $('input#facilityslug').val();
            var target = (slug == '') ? host + 'admin/savefacility' : host + 'admin/updatefacility/' + slug
            var redirect = host + 'admin/facilitylist/' + facilitytype;

            if (res) {
                var arg = $("form#createfacilityfrm").serialize();
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