(function($) {
    "use strict";

    if ($('table#table-productlist').length) {
        //Product list
        var productlistdatatable;
        if (productlistdatatable) {
            productlistdatatable.fnClearTable(0);
            productlistdatatable.fnDestroy();
        }
        productlistdatatable = $('table#table-productlist').dataTable({
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
                url: host + "admin/ajax_productlist", // json datasource
                type: "post", // method  , by default get
                "data": function(params) {
                    params.genre = genre;
                },
                error: function() { // error handling
                    console.log('Error: serverside. ');
                }
            },
        });

        $(window).resize();

        //Publish
        $('table#table-productlist').on('click', 'a[id^="publish-"]', function() {
            var productslug = $(this).attr('id').replace('publish-', '');
            $.ajax({
                url: host + 'admin/publishproduct/' + productslug,
                type: "POST",
                dataType: 'html',
                data: {},
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    // console.log(responce);
                    responce = JSON.parse(responce);
                    popmessage(responce.status, responce.message);
                    $('table#table-productlist').DataTable().ajax.reload();
                    return false;
                }
            });
        });

        //Remove
        $('table#table-productlist').on('click', 'a[id^="delete-"]', function() {
            var productslug = $(this).attr('id').replace('delete-', '');
            $.ajax({
                url: host + 'admin/deleteproduct/' + productslug,
                type: "POST",
                dataType: 'html',
                data: {},
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    // console.log(responce);
                    responce = JSON.parse(responce);
                    popmessage(responce.status, responce.message);
                    $('table#table-productlist').DataTable().ajax.reload();
                    return false;
                }
            });
        });

        $('button#listadd').click(function() {
            var target = host + 'admin/' + genre + '/createproduct';
            window.location.href = target;
        });

        //Inventory Section

        $('table#table-productlist').on('click', 'a[id^="inventory-"]', function() {
            var productid = $(this).attr('id').replace('inventory-', '');
            $('input#productid').val(productid);
            $('div#inventoryModal').modal('show');
        });

        //Color add/remove
        $('form#createinventory').on('click', 'button#coloradd', function() {
            var elem = $(this);
            var colorcount = elem.attr('data-color-count');
            var cloneColor = $('div.colorsection:first')[0].outerHTML;

            var cloneColor = '<div class="form-example-int form-horizental colorsection" id="colordiv-1">';
            cloneColor += '     <div class="form-group">';
            cloneColor += '         <div class="row">';
            cloneColor += '             <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">';
            cloneColor += '                 <label class="hrzn-fm" id="colorLabel">Product Colour</label>';
            cloneColor += '             </div>';
            cloneColor += '             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-9">';
            cloneColor += '                 <div class="nk-int-st">';
            cloneColor += '                     <input type="text" name="colorcode[]" id="colorcode-1" class="form-control input-sm color-picker" placeholder="Product Colour" value="">';
            cloneColor += '                 </div>';
            cloneColor += '             </div>';
            cloneColor += '             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">';
            cloneColor += '                 <div class="nk-int-st">';
            cloneColor += '                     <button type="button" id="coloradd" data-color-count="1" class="btn"><i class="notika-icon notika-plus-symbol"></i></button>';
            cloneColor += '                 </div>';
            cloneColor += '             </div>';
            cloneColor += '         </div>';
            cloneColor += '     </div>';
            cloneColor += '   </div>';


            var label = $('label#colorLabel')[0].outerHTML;

            colorcount = parseInt(colorcount) + 1;
            elem.attr('data-color-count', colorcount);
            cloneColor = cloneColor.replace(label, '');
            cloneColor = cloneColor.replace('colordiv-1', 'colordiv-' + colorcount);
            cloneColor = cloneColor.replace('colorcode-1', 'colorcode-' + colorcount);
            cloneColor = cloneColor.replace('coloradd', 'colorremove-' + colorcount);
            cloneColor = cloneColor.replace('data-color-count="1"', 'data-color-count="' + colorcount + '"');
            cloneColor = cloneColor.replace('<i class="notika-icon notika-plus-symbol"></i>', '<i class="notika-icon notika-minus-symbol"></i>');
            // console.log(cloneColor);
            $('div.colorsection:last').after(cloneColor);
            $('form#createinventory').find('input#colorcode-' + colorcount).spectrum({
                preferredFormat: "hex",
                showInput: true,
                showPalette: true,
            });
            $('form#createinventory').find('input#colorcode-' + colorcount).val('');
        });

        $('form#createinventory').on('click', 'button[id^="colorremove-"]', function() {
            var serial = $(this).attr('id').replace('colorremove-', '');
            $('form#createinventory').find('div#colordiv-' + serial).remove();
        });

        $(".color-picker")[0] && $(".color-picker").each(function() {
            $(this).spectrum({
                preferredFormat: "hex",
                showInput: true,
                showPalette: true,
            });
        });

        //Size add/remove
        $('form#createinventory').on('click', 'button#sizeadd', function() {
            var elem = $(this);
            var sizecount = elem.attr('data-size-count');
            var cloneSize = $('div.sizesection:first')[0].outerHTML;
            var label = $('label#sizeLabel')[0].outerHTML;

            sizecount = parseInt(sizecount) + 1;
            elem.attr('data-size-count', sizecount);
            cloneSize = cloneSize.replace(label, '');
            cloneSize = cloneSize.replace('sizediv-1', 'sizediv-' + sizecount);
            cloneSize = cloneSize.replace('size-1', 'size-' + sizecount);
            cloneSize = cloneSize.replace('sizeadd', 'sizeremove-' + sizecount);
            cloneSize = cloneSize.replace('data-size-count="1"', 'data-size-count="' + sizecount + '"');
            cloneSize = cloneSize.replace('<i class="notika-icon notika-plus-symbol"></i>', '<i class="notika-icon notika-minus-symbol"></i>');
            // console.log(cloneSize);
            $('div.sizesection:last').after(cloneSize);
            $('form#createinventory').find('input#size-' + sizecount).val('');
        });

        $('form#createinventory').on('click', 'button[id^="sizeremove-"]', function() {
            var serial = $(this).attr('id').replace('sizeremove-', '');
            $('form#createinventory').find('div#sizediv-' + serial).remove();
        });

        if ($('form#createinventory').length) {
            //Focus script
            $('form#createinventory').find('input[id^="size-"]').activeFocus(error_class);
            $('form#createinventory').submit(function(e) {
                e.preventDefault();

                var res = true;
                $('form#createinventory').find('input[id^="size-"]').each(function() {
                    res = res && $(this).notempty(error_class);
                });


                if (res) {
                    var arg = $("form#createinventory").serialize();
                    // console.log(arg);
                    $.ajax({
                        url: host + 'admin/inventory/build',
                        type: "POST",
                        dataType: 'html',
                        data: arg,
                        timeout: 20000,
                        cache: false,
                        success: function(responce) {
                            // console.log(responce);
                            responce = JSON.parse(responce);
                            $('input#productid').val('');
                            $('div#inventoryModal').modal('hide');
                            popmessage(responce.status, responce.message);
                            $('table#table-productlist').DataTable().ajax.reload();
                            return false;
                        }
                    });
                }
                return false;
            });

        }
    }

    if ($('form#createproductfrm').length) {


        //Dropzone
        Dropzone.autoDiscover = false;
        var acceptedFileTypes = "image/*";
        var fileList = new Array;
        var i = 0;
        $("div#imageUploader").dropzone({
            url: host + 'admin/upload',
            acceptedFiles: acceptedFileTypes,
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
                    formData.append("filepath", 'productimage/' + genre);
                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                });
            },
            success: function(file, response) {
                console.log(response);
                fileList[file.name] = response.name;
                $('input#productimage').val(response.name);
            },
            error: function(file, response) {
                file.previewElement.classList.add("dz-error");
            }
        });

        var __removeUpload = function(file) {
            var slug = $('input#productslug').val();
            if (file in fileList) {
                var target = host + 'admin/removeupload';
                var data = {
                    'path': 'productimage/' + genre,
                    'file': fileList[file]
                };
            } else {
                var target = host + 'admin/deleteproductimage/' + slug;
                var data = {
                    'path': 'productimage/' + genre,
                    'file': file
                };
            }
            $.ajax({
                url: target,
                type: "POST",
                dataType: 'html',
                data: data,
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
        })

        //Specification add/remove
        $('form#createproductfrm').on('click', 'button#specsadd', function() {
            var elem = $(this);
            var specscount = elem.attr('data-specs-count');
            var cloneSpec = $('div.specsection:first')[0].outerHTML;
            var label = $('label#specLabel')[0].outerHTML;

            specscount = parseInt(specscount) + 1;
            elem.attr('data-specs-count', specscount);
            cloneSpec = cloneSpec.replace(label, '');
            cloneSpec = cloneSpec.replace('specdiv-1', 'specdiv-' + specscount);
            cloneSpec = cloneSpec.replace('specname-1', 'specname-' + specscount);
            cloneSpec = cloneSpec.replace('specification-1', 'specification-' + specscount);
            cloneSpec = cloneSpec.replace('specsadd', 'specremove-' + specscount);
            cloneSpec = cloneSpec.replace('data-specs-count="1"', 'data-specs-count="' + specscount + '"');
            cloneSpec = cloneSpec.replace('<i class="notika-icon notika-plus-symbol"></i>', '<i class="notika-icon notika-minus-symbol"></i>');
            // console.log(cloneSpec);
            $('div.specsection:last').after(cloneSpec);
            $('form#createproductfrm').find('input#specname-' + specscount).val('');
            $('form#createproductfrm').find('input#specification-' + specscount).val('');
        });

        $('form#createproductfrm').on('click', 'button[id^="specremove-"]', function() {
            var serial = $(this).attr('id').replace('specremove-', '');
            $('form#createproductfrm').find('div#specdiv-' + serial).remove();
        });




        var res = false;

        //Focus script
        $('input#productname').activeFocus(error_class);
        $('input#productsku').activeFocus(error_class);
        $('input#browsertitle').activeFocus(error_class);
        $('input#metakeyword').activeFocus(error_class);
        $('input#metadescription').activeFocus(error_class);

        $('form#createproductfrm').find('input[id^="specname-"]').each(function() {
            var id = $(this).attr('id').replace('specname-', '');
            $('input#specname-' + id).activeFocus(error_class);
            $('input#specification-' + id).activeFocus(error_class);
        });

        $('select#productcategory').activeFocus(error_class);
        $('select#productbrand').activeFocus(error_class);
        $('select#productstyle').activeFocus(error_class);

        $('input#productprice').activeFocus(error_class);
        $('input#productdiscount').activeFocus(error_class);
        $('input#productdiscountby').activeFocus(error_class);


        $('form#createproductfrm').submit(function(e) {
            e.preventDefault();

            res = $('input#productname').notempty(error_class);
            res = res && $('input#productsku').notempty(error_class);
            res = res && $('input#browsertitle').notempty(error_class);
            res = res && $('input#metakeyword').notempty(error_class);
            res = res && $('input#metadescription').notempty(error_class);

            $('form#createproductfrm').find('input[id^="specname-"]').each(function() {
                var id = $(this).attr('id').replace('specname-', '');
                res = res && $('input#specname-' + id).notempty(error_class);
                res = res && $('input#specification-' + id).notempty(error_class);
            });

            res = res && $('select#productcategory').notempty(error_class);
            res = res && $('select#productbrand').notempty(error_class);
            res = res && $('select#productstyle').notempty(error_class);

            res = res && $('input#productprice').notempty(error_class);
            // res = res && $('input#productdiscount').notempty(error_class);
            // res = res && $('input#productdiscountby').notempty(error_class);

            //Target & Redirect Url
            var slug = $('input#productslug').val();
            var target = (slug == '') ? host + 'admin/saveproduct' : host + 'admin/updateproduct/' + slug
            var redirect = host + 'admin/' + genre + '/productlist';

            if (res) {
                var arg = $("form#createproductfrm").serialize();
                // console.log(arg);
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
            return false;
        });

    }



})(jQuery);