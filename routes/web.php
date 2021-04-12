<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', 'HomeController@index');



Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

// All admin routes


Route::name('admin.')->prefix('admin/')->namespace('Admin')->group(function () {

    Route::get('/login', 'AdminController@showlogin')->name('login');
    Route::post('/authorize', 'AdminController@authenticate')->name('authorize');

    Route::middleware(['adminlogin'])->group(function(){
        Route::get('/', 'AdminController@index')->name('dashboard');
        Route::resource('social', 'SocialController');

        //Upload
        Route::post('/upload', 'UploadController@upload')->name('upload');
        Route::post('/removeupload', 'UploadController@remove')->name('removeupload');

        //Page manager
        Route::get('/pagelist', 'PageController@index')->name('pagelist');
        Route::get('/createpage', 'PageController@create')->name('createpage');
        Route::get('/editpage/{page}', 'PageController@edit')->name('editpage');

        Route::post('/ajax_pagelist', 'PageController@pageList')->name('ajax_pagelist');
        Route::post('/savepage', 'PageController@store')->name('savepage');
        Route::post('/updatepage/{page}', 'PageController@update')->name('updatepage');
        Route::post('/publishpage/{page}', 'PageController@publish')->name('publishpage');
        Route::post('/deletepage/{page}', 'PageController@destroy')->name('deletepage');
        Route::post('/deletepagebanner/{page}', 'PageController@removebanner')->name('deletebanner');

        //Category manager
        Route::get('/categorylist', 'CategoryController@index')->name('categorylist');
        Route::get('/createcategory', 'CategoryController@create')->name('createcategory');
        Route::get('/editcategory/{category}', 'CategoryController@edit')->name('editcategory');

        Route::post('/ajax_categorylist', 'CategoryController@categoryList')->name('ajax_categorylist');
        Route::post('/savecategory', 'CategoryController@store')->name('savecategory');
        Route::post('/updatecategory/{category}', 'CategoryController@update')->name('updatecategory');
        Route::post('/publishcategory/{category}', 'CategoryController@publish')->name('publishcategory');
        Route::post('/deletecategory/{category}', 'CategoryController@destroy')->name('deletecategory');
        Route::post('/deletecategorybanner/{category}', 'CategoryController@removebanner')->name('deletecategorybanner');

        //Brands manager
        Route::get('/{brandproduct}/brandlist', 'BrandController@index')->name('brandlist');
        Route::get('/{brandproduct}/createbrand', 'BrandController@create')->name('createbrand');
        Route::get('/{brandproduct}/editbrand/{brand}', 'BrandController@edit')->name('editbrand');

        Route::post('/ajax_brandlist', 'BrandController@brandList')->name('ajax_brandlist');
        Route::post('/savebrand', 'BrandController@store')->name('savebrand');
        Route::post('/updatebrand/{brand}', 'BrandController@update')->name('updatebrand');
        Route::post('/publishbrand/{brand}', 'BrandController@publish')->name('publishbrand');
        Route::post('/deletebrand/{brand}', 'BrandController@destroy')->name('deletebrand');
        Route::post('/deletebrandbanner/{brand}', 'BrandController@removebanner')->name('deletebrandbanner');

        //Materials manager
        Route::get('/{materialproduct}/materiallist', 'MaterialController@index')->name('materiallist');
        Route::get('/{materialproduct}/creatematerial', 'MaterialController@create')->name('creatematerial');
        Route::get('/{materialproduct}/editmaterial/{material}', 'MaterialController@edit')->name('editmaterial');

        Route::post('/ajax_materiallist', 'MaterialController@materialList')->name('ajax_materiallist');
        Route::post('/savematerial', 'MaterialController@store')->name('savematerial');
        Route::post('/updatematerial/{material}', 'MaterialController@update')->name('updatematerial');
        Route::post('/publishmaterial/{material}', 'MaterialController@publish')->name('publishmaterial');
        Route::post('/deletematerial/{material}', 'MaterialController@destroy')->name('deletematerial');
        Route::post('/deletematerialbanner/{material}', 'MaterialController@removebanner')->name('deletematerialbanner');

        //Styles manager
        Route::get('/{styleproduct}/stylelist', 'StyleController@index')->name('stylelist');
        Route::get('/{styleproduct}/createstyle', 'StyleController@create')->name('createstyle');
        Route::get('/{styleproduct}/editstyle/{style}', 'StyleController@edit')->name('editstyle');

        Route::post('/ajax_stylelist', 'StyleController@styleList')->name('ajax_stylelist');
        Route::post('/savestyle', 'StyleController@store')->name('savestyle');
        Route::post('/updatestyle/{style}', 'StyleController@update')->name('updatestyle');
        Route::post('/publishstyle/{style}', 'StyleController@publish')->name('publishstyle');
        Route::post('/deletestyle/{style}', 'StyleController@destroy')->name('deletestyle');
        Route::post('/deletestylebanner/{style}', 'StyleController@removebanner')->name('deletestylebanner');

        //Products manager
        Route::get('/product/inventory/{product}', 'ProductController@show')->name('productinventory');
        Route::get('/{genre}/productlist', 'ProductController@index')->name('productlist');
        Route::get('/{genre}/createproduct', 'ProductController@create')->name('createproduct');
        Route::get('/{genre}/editproduct/{product}', 'ProductController@edit')->name('editproduct');

        Route::post('/ajax_productlist', 'ProductController@productList')->name('ajax_productlist');
        Route::post('/saveproduct', 'ProductController@store')->name('saveproduct');
        Route::post('/updateproduct/{product}', 'ProductController@update')->name('updateproduct');
        Route::post('/publishproduct/{product}', 'ProductController@publish')->name('publishproduct');
        Route::post('/deleteproduct/{product}', 'ProductController@destroy')->name('deleteproduct');
        Route::post('/deleteproductimage/{product}', 'ProductController@removeimage')->name('deleteproductimage');

        //Facility manager
        Route::get('/facilitylist/{facilitytype}', 'FacilityController@index')->name('facilitylist');
        Route::get('/createfacility/{facilitytype}', 'FacilityController@create')->name('createfacility');
        Route::get('/editfacility/{facilitytype}/{facility}', 'FacilityController@edit')->name('editfacility');

        Route::post('/ajax_facilitylist', 'FacilityController@facilityList')->name('ajax_facilitylist');
        Route::post('/savefacility', 'FacilityController@store')->name('savefacility');
        Route::post('/updatefacility/{facility}', 'FacilityController@update')->name('updatefacility');
        Route::post('/publishfacility/{facility}', 'FacilityController@publish')->name('publishfacility');
        Route::post('/deletefacility/{facility}', 'FacilityController@destroy')->name('deletefacility');
        Route::post('/deletefacilitybanner/{facility}', 'FacilityController@removebanner')->name('deletefacilitybanner');

        //Product Inventory
        Route::get('/{productslug}/inventorylist', 'InventoryController@index')->name('inventorylist');
        Route::get('/createinventory/{productid}', 'InventoryController@create')->name('createinventory');
        Route::get('/editinventory/{inventoryid}', 'InventoryController@edit')->name('editinventory');

        Route::post('/saveinventory', 'InventoryController@store')->name('saveinventory');
        Route::post('/updateinventory/{inventoryid}', 'InventoryController@update')->name('updateinventory');
        Route::post('/publishinventory/{inventoryid}', 'InventoryController@publish')->name('publishinventory');
        Route::post('/deleteinventory/{inventoryid}', 'InventoryController@destroy')->name('deleteinventory');

        Route::post('/inventory/build', 'InventoryController@build')->name('ajax_createinventory');
        Route::post('/ajax_inventorylist', 'InventoryController@inventoryList')->name('ajax_inventoryList');

        //Product Gallery
        Route::get('/productgallery/{inventoryid}', 'ProductGalleryController@index')->name('gallerylist');

        Route::post('/publishgallery/{galleryid}', 'ProductGalleryController@publish')->name('publishgallery');
        Route::post('/deletegallery/{galleryid}', 'ProductGalleryController@destroy')->name('deletegallery');
        Route::post('/uploadgallery', 'ProductGalleryController@store')->name('ajax_galleryupload');
        Route::post('/ajax_gallerylist', 'ProductGalleryController@productGalleryList')->name('ajax_galleryList');


    });

});
