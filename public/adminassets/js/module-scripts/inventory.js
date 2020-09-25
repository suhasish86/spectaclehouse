(function($) {
    "use strict";

    if ($('table#table-inventorylist').length) {
        //Product list
        var inventorylistdatatable;
        if (inventorylistdatatable) {
            inventorylistdatatable.fnClearTable(0);
            inventorylistdatatable.fnDestroy();
        }
        inventorylistdatatable = $('table#table-inventorylist').dataTable({
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
                url: host + "admin/ajax_inventorylist", // json datasource
                type: "post", // method  , by default get
                "data": function(params) {
                    params.productid = productid;
                },
                error: function() { // error handling
                    console.log('Error: serverside. ');
                }
            },
        });

        $(window).resize();

        //Publish
        $('table#table-inventorylist').on('click', 'a[id^="publish-"]', function() {
            var inventoryid = $(this).attr('id').replace('publish-', '');
            $.ajax({
                url: host + 'admin/publishinventory/' + inventoryid,
                type: "POST",
                dataType: 'html',
                data: {},
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    // console.log(responce);
                    responce = JSON.parse(responce);
                    popmessage(responce.status, responce.message);
                    $('table#table-inventorylist').DataTable().ajax.reload();
                    return false;
                }
            });
        });

        //Gallery
        $('table#table-inventorylist').on('click', 'a[id^="gallery-"]', function() {
            var inventoryid = $(this).attr('id').replace('gallery-', '');
            var target = host + 'admin/productgallery/' + inventoryid;
            window.location.href = target;
        });

        //Remove
        $('table#table-inventorylist').on('click', 'a[id^="delete-"]', function() {
            var inventoryid = $(this).attr('id').replace('delete-', '');
            $.ajax({
                url: host + 'admin/deleteinventory/' + inventoryid,
                type: "POST",
                dataType: 'html',
                data: {},
                timeout: 20000,
                cache: false,
                success: function(responce) {
                    // console.log(responce);
                    responce = JSON.parse(responce);
                    popmessage(responce.status, responce.message);
                    $('table#table-inventorylist').DataTable().ajax.reload();
                    return false;
                }
            });
        });

        $('button#listadd').click(function() {
            var target = host + 'admin/createinventory/' + productid;
            window.location.href = target;
        });

        $('button#listback').click(function() {
            var target = host + 'admin/' + genre + '/productlist';
            window.location.href = target;
        });


    }

    if ($('form#createinventoryfrm').length) {

        var color = $('input#colorcode').val();
        $('input#colorcode').spectrum({
            preferredFormat: "hex",
            showInput: true,
            showPalette: true,
            color: color
        });


        var res = false;

        //Focus script
        $('input#colorcode').activeFocus(error_class);
        $('input#size').activeFocus(error_class);
        $('input#stock').activeFocus(error_class);


        $('form#createinventoryfrm').submit(function(e) {
            e.preventDefault();

            res = $('input#colorcode').notempty(error_class);
            res = res && $('input#size').notempty(error_class);
            res = res && $('input#stock').notempty(error_class);


            //Target & Redirect Url
            var inventoryid = $('input#inventoryid').val();
            var target = (parseInt(inventoryid) == 0) ? host + 'admin/saveinventory' : host + 'admin/updateinventory/' + inventoryid
            var redirect = host + 'admin/' + productslug + '/inventorylist';

            if (res) {
                var arg = $("form#createinventoryfrm").serialize();
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