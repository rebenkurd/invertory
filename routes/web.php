<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvertoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ReportController;


Route::get('logout', [UserController::class, 'Logout'])->name('logout');

Route::middleware(['auth','role:admin'])->group(function() {

    // user controller
    Route::controller(UserController::class)->group(function(){
        Route::get('/all/user', 'AllUser')->name('all.user');
        Route::get('/add/user', 'AddUser')->name('add.user');
        Route::post('/store/user', 'StoreUser')->name('store.user');
        Route::get('/edit/user/{id}', 'EditUser')->name('edit.user');
        Route::post('/update/user/{id}', 'UpdateUser')->name('update.user');
        Route::get('/delete/user/{id}', 'DeleteUser')->name('delete.user');
    });


    // Product controller
    Route::controller(ProductController::class)->group(function(){
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/store/product', 'StoreProduct')->name('store.product');
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
        Route::post('/update/product/{id}', 'UpdateProduct')->name('update.product');
        Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');
    });


    // Purchase controller
    Route::controller(PurchaseController::class)->group(function(){
        Route::get('/all/purchase', 'AllPurchase')->name('all.purchase');
        Route::get('/add/purchase', 'AddPurchase')->name('add.purchase');
        Route::get('/ajax/product/item/{id}', 'AjaxProductItem');
        Route::post('/store/purchase', 'StorePurchase')->name('store.purchase');
        Route::get('/edit/purchase/{id}', 'EditPurchase')->name('edit.purchase');
        Route::post('/update/purchase/{id}', 'UpdatePurchase')->name('update.purchase');
        Route::get('/delete/purchase/{id}', 'DeletePurchase')->name('delete.purchase');
        Route::get('/details/purchase/{id}', 'DetailsPurchase')->name('details.purchase');
        Route::post('/purchase/paynow', 'PurchasePayNow')->name('purchase.paynow');
        Route::get('/purchase/invoice/pdf/{id}', 'PurchaseInvoicePdf')->name('purchase.invoice.pdf');
        Route::get('/purchase/invoice/download/{id}', 'PurchaseInvoiceDownload')->name('purchase.invoice.download');
        Route::get('/purchase/invoice/print/{id}', 'PurchaseInvoicePrint')->name('purchase.invoice.print');
        Route::get('/purchase/return/{id}', 'PurchaseReturn')->name('purchase.return');
        Route::get('/return/purchase', 'ReturnPurchase')->name('return.purchase');
    });

    // Sale controller
    Route::controller(SaleController::class)->group(function(){
        Route::get('/all/sale', 'AllSale')->name('all.sale');
        Route::get('/add/sale', 'AddSale')->name('add.sale');
        Route::get('/ajax/product/item/{id}', 'AjaxProductItem');
        Route::post('/store/sale', 'StoreSale')->name('store.sale');
        Route::get('/edit/sale/{id}', 'EditSale')->name('edit.sale');
        Route::post('/update/sale/{id}', 'UpdateSale')->name('update.sale');
        Route::get('/delete/sale/{id}', 'DeleteSale')->name('delete.sale');
        Route::get('/details/sale/{id}', 'DetailsSale')->name('details.sale');
        Route::post('/sale/paynow', 'SalePayNow')->name('sale.paynow');
        Route::get('/sale/invoice/pdf/{id}', 'SaleInvoicePdf')->name('sale.invoice.pdf');
        Route::get('/sale/invoice/download/{id}', 'SaleInvoiceDownload')->name('sale.invoice.download');
        Route::get('/sale/invoice/print/{id}', 'SaleInvoicePrint')->name('sale.invoice.print');
        Route::get('/sale/return/{id}', 'SaleReturn')->name('sale.return');
        Route::get('/return/sale', 'ReturnSale')->name('return.sale');
    });

    // Supplier controller
    Route::controller(SupplierController::class)->group(function(){
        Route::get('/all/supplier', 'AllSupplier')->name('all.supplier');
        Route::get('/add/supplier', 'AddSupplier')->name('add.supplier');
        Route::post('/store/supplier', 'StoreSupplier')->name('store.supplier');
        Route::get('/edit/supplier/{id}', 'EditSupplier')->name('edit.supplier');
        Route::post('/update/supplier/{id}', 'UpdateSupplier')->name('update.supplier');
        Route::get('/delete/supplier/{id}', 'DeleteSupplier')->name('delete.supplier');
    });

    // Customer controller
    Route::controller(CustomerController::class)->group(function(){
        Route::get('/all/customer', 'AllCustomer')->name('all.customer');
        Route::get('/add/customer', 'AddCustomer')->name('add.customer');
        Route::post('/store/customer', 'StoreCustomer')->name('store.customer');
        Route::get('/edit/customer/{id}', 'EditCustomer')->name('edit.customer');
        Route::post('/update/customer/{id}', 'UpdateCustomer')->name('update.customer');
        Route::get('/delete/customer/{id}', 'DeleteCustomer')->name('delete.customer');
    });

    // Invertory controller
    Route::controller(InvertoryController::class)->group(function(){
        Route::get('/setting/invertory', 'SettingInvertory')->name('setting.invertory');
        Route::post('/update/invertory/setting/{id}', 'UpdateInvertorySetting')->name('update.invertory.setting');
    });

    // Report controller
    Route::controller(ReportController::class)->group(function(){
        Route::get('/sale/report', 'SaleReport')->name('sale.report');
        Route::post('/report/report_by_date', 'ReportByDate');
        Route::post('/report/sale/submit', 'ReportSaleSubmit')->name('report.sale.submit');
    });




});


Route::middleware(['auth','role:user'])->group(function() {

    // Product controller
    Route::controller(ProductController::class)->group(function(){
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/store/product', 'StoreProduct')->name('store.product');
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
        Route::post('/update/product/{id}', 'UpdateProduct')->name('update.product');
        Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');
    });

});






Route::get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
