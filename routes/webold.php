<?php

use App\Http\Controllers\AccountingGuideController;
use App\Http\Controllers\OpeningBalancesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvancesController;
use App\Http\Controllers\ArrangementController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\OrganizaionsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CostCenterController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\EasyjournalsController;
use App\Http\Controllers\journalsController;
use App\Http\Controllers\OfferPriceController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PurchasereturnsController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\ReportAllController;
use App\Http\Controllers\RoutAccountController;
use App\Http\Controllers\SinadatController;
use App\Http\Controllers\TreasuryController;
use App\Http\Controllers\StoreConversionController;
use App\Http\Controllers\VirtualAccountsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\ManufacturController;
use App\Http\Controllers\NadalController;
use App\Http\Controllers\OrderInvController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaintedController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\VolumeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SubsPacksController;
use App\Models\Order;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;





use App\Http\Controllers\NoticsController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\PenaltiesController;
use App\Http\Controllers\CastodiesController;
use App\Http\Controllers\OnlineShopController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\ProfileShopController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/pdf', function () {
//     // $mpdf = new \Mpdf\Mpdf();
//     // $mpdf->WriteHTML('<h1>Hello world!</h1>');
//     // $mpdf->Output();
//         $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
//         $mpdf->autoScriptToLang = true;
//         $mpdf->autoLangToFont = true;
//         $mpdf->autoArabic = true;

//         $mpdf->baseScript = 1;
//         $mpdf->autoVietnamese = true;

//         $mpdf->shrink_tables_to_fit =  1;
//         $mpdf->keep_table_proportions = true;

//         $mpdf->SetDisplayMode('fullpage');

//         $mpdf->list_indent_first_level = 0;
//         $mpdf->SetDirectionality('rtl');
//          $mpdf->WriteHTML(view('pdf.journals'));
//         $mpdf->Output();
//         // return view('pdf.journals');
// });







Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
         //...................................................................







        Route::group(['prefix' => 'Shop'], function() {
            Route::group(['middleware' => 'Shop.guest'], function(){

                Route::get('/login/{id}',[OnlineShopController::class, 'Login'])->name('Shop.login');
                Route::get('/Register/{id}',[OnlineShopController::class, 'Register'])->name('Shop.Register');
                Route::post('/Shopauth',[OnlineShopController::class, 'storeLogin'])->name('Shopauth');
                Route::post('/ShopRegister',[OnlineShopController::class, 'storeRegister'])->name('ShopRegister');
            });


            Route::group(['middleware' => 'Shop.auth'], function(){

                // Route::resource('OrderShops', App\Http\Controllers\OrderShepsController::class);
                // Route::resource('Customer', App\Http\Controllers\CustomerController::class);
                Route::get('/ShowTemporderOrder/{id}', [ProfileShopController::class, 'show'])->name('ShowTemporderOrder');
                Route::post('/SaveCustomerShop', [ProfileShopController::class, 'store'])->name('SaveCustomerShop');
                Route::post('/SavePasswordShop', [ProfileShopController::class, 'SavePasswordShop'])->name('SavePasswordShop');
                Route::get('/ProfileShop/{id}', [ProfileShopController::class, 'index'])->name('ProfileShop');
                Route::get('/Shoplogout/{id}', [ProfileShopController::class, 'logout'])->name('Shoplogout');
            });
        });



Route::post('/kitchensupdate',[App\Http\Controllers\KitchensController::class,'update'])->name('kitchensupdate');

Route::get('/org', function () {
    return view('admin.organizations.complete');
});
Route::get('/home',[HomeController::class,'index']);
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/clients',[HomeController::class,'clients'])->name('public.clients');
Route::get('/restaurant',[HomeController::class,'restaurant'])->name('public.restaurant');
Route::get('/Online/{id}',[HomeController::class,'products'])->name('public.products');
Route::get('/kitchen/{id}',[HomeController::class,'kitchen'])->name('public.k');
Route::get('/kitchen-items/{id}',[HomeController::class,'kitchenItems'])->name('kitchenItems');
Route::get('/branch/{id}',[App\Http\Controllers\HomeController::class,'branch'])->name('branch');
Route::get('/itemDone/{id}',[HomeController::class,'itemDone'])->name('public.itemDone');
Route::post('/organizations-store', [App\Http\Controllers\HomeController::class, 'organizationStore'])->name('organizationStore');
Route::post('/organization-update/{id}',[App\Http\Controllers\OrganizaionsController::class,'update'])->name('organizationUpdate');
Route::post('/tblsGroup-store', [App\Http\Controllers\TblsController::class, 'tblsGroup'])->name('tblsGroup.store');
Route::get('/Condition',[HomeController::class,'Condition'])->name('Condition');

Route::get('/table/{branch}/{id}',[App\Http\Controllers\ClientsController::class,'tableOrder'])->name('tableOrder');
Route::get('/driver/{branch}/{id}',[App\Http\Controllers\ClientsController::class,'driverOrder'])->name('driverOrder');
Route::post('/storeTableClient',[App\Http\Controllers\ClientsController::class,'storeTableClient'])->name('orders.storeTableClient');
Route::post('/storeTableClientCompany',[App\Http\Controllers\ClientsController::class,'storeTableClientCompany'])->name('orders.storeTableClientCompany');

Route::post('/customers-add',[App\Http\Controllers\CustomersController::class,'add'])->name('customers.add');

//Route::post('/paylinkhook',  [App\Http\Controllers\OrganizaionsController::class, 'reciveActivehook'])->name('partners.webhook');

Auth::routes();
// Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
Route::resource('organizations',OrganizaionsController::class);
Route::resource('branches',App\Http\Controllers\BranchesController::class);
Route::resource('banners',App\Http\Controllers\BannersController::class);
Route::resource('users', App\Http\Controllers\UsersController::class);
Route::resource('products', App\Http\Controllers\ProductsController::class);
Route::resource('prodcategories', App\Http\Controllers\ProdcategoriesController::class);
Route::resource('stocks', App\Http\Controllers\StocksController::class);
Route::resource('units', App\Http\Controllers\UnitsController::class);
Route::resource('orders', App\Http\Controllers\OrdersController::class);
Route::resource('sorders', App\Http\Controllers\SordersController::class);
Route::resource('credorders', App\Http\Controllers\CredordersController::class);
Route::resource('debitorders', App\Http\Controllers\DebitordersController::class);
Route::resource('customers', App\Http\Controllers\CustomersController::class);
Route::resource('suppliers', App\Http\Controllers\SuppliersController::class);
Route::resource('purchases', App\Http\Controllers\PurchasesController::class);
Route::resource('outcomes', App\Http\Controllers\OutcomesController::class);
Route::resource('invoices', App\Http\Controllers\InvoicesController::class);
Route::resource('outcomeCategories', App\Http\Controllers\OutcomecategoriesController::class);
Route::resource('roles', App\Http\Controllers\RolesController::class);
Route::resource('pagecategories', App\Http\Controllers\PagecategoriesController::class);
Route::resource('pages', App\Http\Controllers\PagesController::class);
Route::resource('drivethrus', App\Http\Controllers\DrivethrusController::class);
Route::resource('tbls', App\Http\Controllers\TblsController::class);
Route::resource('kitchens', App\Http\Controllers\KitchensController::class);
Route::resource('durations', App\Http\Controllers\DurationsController::class);
Route::resource('tickets', App\Http\Controllers\TicketsController::class);
Route::resource('employees', App\Http\Controllers\EmployeesController::class);

Route::get('/orders-test',[App\Http\Controllers\OrdersController::class,'ordersTest'])->name('orders.test');
Route::get('/debitorders/create/{id}',[App\Http\Controllers\DebitordersController::class,'create'])->name('debitorders/create');
Route::get('/credorders/create/{id}',[App\Http\Controllers\CredordersController::class,'create'])->name('credorders/create');

Route::get('/orders-today',[App\Http\Controllers\OrdersController::class,'ordersToday'])->name('orders.today');
Route::get('/today-show/{id}',[App\Http\Controllers\OrdersController::class,'showToday'])->name('today.show');


Route::get('/today-orders',[App\Http\Controllers\OrdersController::class,'todayOrders'])->name('today.orders');
Route::post('/ChangeTable',[App\Http\Controllers\OrdersController::class,'ChangeTable'])->name('ChangeTable');

Route::get('/payment-response',[App\Http\Controllers\HomeController::class,'paymentResponse'])->name('payment.response');

Route::put('users/password',  [App\Http\Controllers\UsersController::class, 'passwordUpdate'])->name('users.password');

Route::get('payment-partners',  [App\Http\Controllers\OrganizaionsController::class, 'linkPayment'])->name('payment.partners');
Route::post('payment-storeBasic',  [App\Http\Controllers\OrganizaionsController::class, 'storeBasic'])->name('payment.storeBasic');
Route::post('payment-storeOTP',  [App\Http\Controllers\OrganizaionsController::class, 'storeOTP'])->name('payment.storeOTP');
Route::post('payment-storeBank',  [App\Http\Controllers\OrganizaionsController::class, 'storeBank'])->name('payment.storeBank');

Route::get('/productsCopy/{id}',[ProductsController::class,'productsCopy'])->name('productsCopy');

Route::get('payment-confirmNafath',  [App\Http\Controllers\OrganizaionsController::class, 'confirmNafath'])->name('payment.confirmNafath');
Route::get('payment-storeNafath',  [App\Http\Controllers\OrganizaionsController::class, 'storeNafath'])->name('payment.storeNafath');

Route::get('/createDuration/{amount}',[App\Http\Controllers\DurationsController::class,'createDuration'])->name('createDuration');
Route::get('/DurationUser/{amount}',[App\Http\Controllers\DurationsController::class,'DurationUser'])->name('DurationUser');

Route::get('/createDurationNadel',[App\Http\Controllers\DurationsController::class,'createDurationNadel'])->name('createDurationNadel');

Route::get('/endDurationNadel/{id}',[App\Http\Controllers\DurationsController::class,'endDurationNadel'])->name('endDurationNadel');

Route::get('/endDuration/{id}',[App\Http\Controllers\DurationsController::class,'endDuration'])->name('endDuration');
Route::get('/detailsDuration/{id}',[App\Http\Controllers\DurationsController::class,'detailsDuration'])->name('duration.details');

Route::get('/productsBarcode/{id}',[App\Http\Controllers\ProductsController::class,'productsBarcode'])->name('products.barcode');
Route::get('/prodByName',[App\Http\Controllers\ProductsController::class,'getAllProds']);

Route::get('/rolesPages/{id}',[App\Http\Controllers\RolesController::class,'rolesPages'])->name('roles.pages');
Route::post('/permissions/{id}',[App\Http\Controllers\PermissionsController::class,'store'])->name('permissions.store');
Route::get('/purchases/confirm/{id}',[App\Http\Controllers\PurchasesController::class,'confirm'])->name('purchases.confirm');
Route::post('/purchases/store_enon_profit',[App\Http\Controllers\PurchasesController::class,'store_enon_profit'])->name('purchases.store_enon_profit');
Route::get('purchases/getBarcode/{id}',[App\Http\Controllers\PurchasesController::class,'getBarcodepurches']);
Route::post('/purchases/updateedit/{id}',[App\Http\Controllers\PurchasesController::class,'update'])->name('purchases.updateedit');
Route::get('/purchases/showprint/{id}',[App\Http\Controllers\PurchasesController::class,'showprint'])->name('purchases.showprint');

Route::get('/reports-sales',[App\Http\Controllers\ReportsController::class,'sales'])->name('reports.sales');
Route::get('/reports-durations',[App\Http\Controllers\ReportsController::class,'durations'])->name('reports.durations');
Route::get('/reports-products',[App\Http\Controllers\ReportsController::class,'products'])->name('reports.products');


Route::get('/createReceive/{id?}',[App\Http\Controllers\InvoicesController::class,'createReceive'])->name('invoices.createReceive');
Route::get('/createDeliver/{id?}',[App\Http\Controllers\InvoicesController::class,'createDeliver'])->name('invoices.createDeliver');
Route::get('/createInvoice/{id}',[App\Http\Controllers\PurchasesController::class,'createInvoice'])->name('invoices.createInvoice');


Route::get('/indexReceive',[App\Http\Controllers\InvoicesController::class,'indexReceive'])->name('invoices.indexReceive');
Route::get('/indexDeliver',[App\Http\Controllers\InvoicesController::class,'indexDeliver'])->name('invoices.indexDeliver');

Route::get('/stock-drop',[App\Http\Controllers\StocksController::class,'drop'])->name('stocks.drop');

Route::get('/stocks-print/{id}',[App\Http\Controllers\ReportsController::class,'productdetails'])->name('stocks.print');
Route::post('/customers-add',[App\Http\Controllers\CustomersController::class,'add'])->name('customers.add');

Route::post('/extras-store',[App\Http\Controllers\ProductsController::class,'extrasStore'])->name('extras.store');

Route::get('/extras-index/{id}',[App\Http\Controllers\ProductsController::class,'extrasindex'])->name('extras.index');
Route::get('/extras.StockSum/{id}',[ProductsController::class,'getBarcode'])->name('extras.StockSum');



Route::post('/orders-store',[App\Http\Controllers\OrdersController::class,'storeRest'])->name('orders.storeRest');

Route::get('/products-hide/{id}',[App\Http\Controllers\ProductsController::class,'hide'])->name('products.hide');
Route::get('/products-unhide/{id}',[App\Http\Controllers\ProductsController::class,'unhide'])->name('products.unhide');

Route::post('/StoreProdect',[App\Http\Controllers\ProductsController::class,'StoreProdect'])->name('products.StoreProdect');
Route::post('/UpdateProdect/{id}',[App\Http\Controllers\ProductsController::class,'UpdateProdect'])->name('products.UpdateProdect');

Route::post('/saveCatProdect',[App\Http\Controllers\ProdcategoriesController::class,'saveCatProdect'])->name('saveCatProdect');
Route::post('/saveKitchanProdect',[App\Http\Controllers\KitchensController::class,'saveKitchanProdect'])->name('saveKitchanProdect');

Route::get('/Account-autocomplete-search', [AccountingGuideController::class, 'getPurProds']);














Route::get('/delete-user/{id}',[App\Http\Controllers\UsersController::class,'destroy']);
Route::get('/delete-product/{id}',[App\Http\Controllers\ProductsController::class,'destroy']);
Route::get('/delete-customer/{id}',[App\Http\Controllers\CustomersController::class,'destroy']);
Route::get('/delete-supplier/{id}',[App\Http\Controllers\SuppliersController::class,'destroy']);
Route::get('/delete-role/{id}',[App\Http\Controllers\RolesController::class,'destroy']);
Route::get('/delete-page/{id}',[App\Http\Controllers\PagesController::class,'destroy']);
Route::get('/delete-unit/{id}',[App\Http\Controllers\UnitsController::class,'destroy']);
Route::get('/delete-tbl/{id}',[App\Http\Controllers\TblsController::class,'destroy']);

Route::post('/tableorder/{id}',[App\Http\Controllers\TblsController::class,'tableorder']);


Route::get('/purchases-delete/{id}',[App\Http\Controllers\PurchasesController::class,'destroy']);

Route::get('/delete-productcategory/{id}',[App\Http\Controllers\ProdcategoriesController::class,'destroy']);
Route::get('/delete-banner/{id}',[App\Http\Controllers\BannersController::class,'destroy']);
Route::get('/getBarcode/{id}',[App\Http\Controllers\OrdersController::class,'getBarcode']);
Route::get('/getExtras/{id}',[App\Http\Controllers\OrdersController::class,'getExtras']);
Route::get('/check-order/{id}',[App\Http\Controllers\OrdersController::class,'checkOrder']);
Route::get('/sorders-confirm/{id}',[App\Http\Controllers\SordersController::class,'confirm'])->name('sorders.confirm');


Route::get('/public/index/{id}',[App\Http\Controllers\ClientsController::class,'index'])->name('public.index');
Route::get('/public/contact/{id}',[App\Http\Controllers\ClientsController::class,'contact'])->name('public.contact');
Route::get('/group/{id}', [ClientsController::class,'group'])->name('public.group');
Route::get('/itemDetails/{id}/{org}', [ClientsController::class,'itemDetails'])->name('itemDetails');
Route::get('/public/categoryDetails/{id}/{org}', [ClientsController::class,'categoryDetails'])->name('public.categoryDetails');
Route::get('/basket/{qnty}/{id}/{name}/{exSum}', [ClientsController::class,'addToBasket']);

Route::get('/clear-basket', [ClientsController::class,'clearBasket']);
//Route::post('customers/store',  [ClientsController::class, 'storeCustomer'])->name('customers.store');
Route::post('order/store',  [ClientsController::class, 'storeOrder'])->name('storeOrder');
Route::get('/checkouts/{id}', [ClientsController::class,'checkouts'])->name('checkouts');
Route::get('/RemoveTasket/{id}/{Org}', [ClientsController::class,'removeFromBasket'])->name('public.Remove');
Route::get('/public/categories/{Org}', [ClientsController::class,'categories'])->name('public.categories');
Route::get('/public/login', [ClientsController::class,'login'])->name('public.login');

Route::group(['middleware' => ['auth']], function() {
Route::get('/public/profile', [HomeController::class,'profile'])->name('public.profile');
});

Route::post('/setPeriod',[App\Http\Controllers\AdminController::class,'setPeriod'])->name('setPeriod');
Route::get('/admin-merchents',[App\Http\Controllers\AdminController::class,'merchents'])->name('admin.merchents');
// });

Route::get('/arabic', [HomeController::class,'arabic'])->name('arabic');
Route::get('/english', [HomeController::class,'english'])->name('english');




Route::post('/purchases.SearchAccount/{id}',[PurchasesController::class,'SearchAccount'])->name('purchases.SearchAccount');

Route::post('/products.UpdateAll/{id}',[ProductsController::class,'update'])->name('products.UpdateAll');





//Purchasereturns
// Route::get('/Purchasereturns.index', [PurchasereturnsController::class,'index'])->name('Purchasereturns.index');
// Route::get('/Purchasereturns.create', [PurchasereturnsController::class,'create'])->name('Purchasereturns.create');
// Route::post('/Purchasereturns.store', [PurchasereturnsController::class,'store'])->name('Purchasereturns.store');
// Route::post('/Purchasereturns.serach',[PurchasereturnsController::class,'serach'])->name('Purchasereturns.serach');
// Route::get('/Purchasereturns.show/{id}', [PurchasereturnsController::class,'show'])->name('Purchasereturns.show');

//edit Offer Price




Route::get('/Order.Complete/{id}', [OrdersController::class,'Complete'])->name('Order.Complete');
Route::get('/Order.AjaxToday', [OrdersController::class,'AjaxOrderToday'])->name('Order.AjaxToday');



// Route::get('/SalesReturns.index', [OrdersController::class,'SalesReturnsIndex'])->name('SalesReturns.index');
// Route::get('/SalesReturns.create', [OrdersController::class,'SalesReturnsCreate'])->name('SalesReturns.create');
// Route::get('/SalesReturns.show/{id}', [OrdersController::class,'SalesReturnsShow'])->name('SalesReturns.show');
// Route::post('/OfferPrice.store', [OrdersController::class,'store'])->name('OfferPrice.store');
// Route::post('/OfferPrice.serach',[OrdersController::class,'serach'])->name('OfferPrice.serach');



//OrdersController invice
Route::get('/OrderInvoices.index', [OrderInvController::class,'index'])->name('OrderInvoices.index');
Route::get('/OrderInvoices.create', [OrderInvController::class,'create'])->name('OrderInvoices.create');
Route::post('/OrderInvoices.store', [OrderInvController::class,'store'])->name('OrderInvoices.store');
Route::get('/OrderInvoices.show/{id}', [OrderInvController::class,'show'])->name('OrderInvoices.show');
Route::get('/OrderInvoices.edit/{id}', [OrderInvController::class,'edit'])->name('OrderInvoices.edit');
Route::get('/OrderInvoices.confirm/{id}', [OrderInvController::class,'confirm'])->name('OrderInvoices.confirm');
Route::post('/OrderInvoices.update/{id}', [OrderInvController::class,'update'])->name('OrderInvoices.update');

Route::get('/OrderInvoices.showInv/{id}', [OrderInvController::class,'showInv'])->name('OrderInvoices.showInv');



Route::post('/OrderInvoices.saveChange', [OrderInvController::class,'saveChange'])->name('OrderInvoices.saveChange');
Route::get('/OrderInvoices.ShowChang/{id}', [OrderInvController::class,'ShowChang'])->name('OrderInvoices.ShowChang');
Route::get('/OrderInvoices.Showinvo/{id}', [OrderInvController::class,'showInfo'])->name('OrderInvoices.Showinvo');
Route::get('/OrderInvoices.Recovery/{id}', [OrderInvController::class,'Recovery'])->name('OrderInvoices.Recovery');



Route::get('/OfferPrice.show/{id}', [OfferPriceController::class,'OfferPriceShow'])->name('OfferPrice.show');
Route::get('/OfferPrice.index', [OfferPriceController::class,'OfferPriceIndex'])->name('OfferPrice.index');
Route::get('/OfferPrice.create', [OfferPriceController::class,'OfferPriceCreate'])->name('OfferPrice.create');
Route::get('/OfferPrice.edit/{id}', [OfferPriceController::class,'OfferPriceedit'])->name('OfferPrice.edit');
Route::get('/OfferPrice.Convert/{id}', [OfferPriceController::class,'OfferPriceeConvert'])->name('OfferPrice.Convert');
Route::post('/OfferPrice.StoreOfferPrice', [OfferPriceController::class,'store'])->name('OfferPrice.StoreOfferPrice');
Route::post('/OfferPrice.Store/{id}', [OfferPriceController::class,'OfferPriceeStore'])->name('OfferPrice.Store');
Route::post('/OfferPrice.update/{id}', [OfferPriceController::class,'update'])->name('OfferPrice.update');
Route::get('/OfferPrice.delete/{id}',[OfferPriceController::class,'OfferPricedestroy'])->name('OfferPrice.delete');















// Sinadat Controller
Route::get('/Sinadat.indexReceive', [SinadatController::class,'indexReceive'])->name('Sinadat.indexReceive');
Route::get('/Sinadat.createReceive', [SinadatController::class,'createReceive'])->name('Sinadat.createReceive');
Route::get('/Sinadat.show/{id}', [SinadatController::class,'show'])->name('Sinadat.show');
Route::get('/Sinadat.edit/{id}', [SinadatController::class,'edit'])->name('Sinadat.edit');
Route::post('/Sinadat.update/{id}', [SinadatController::class,'update'])->name('Sinadat.update');
Route::get('/Sinadat.indexDeliver', [SinadatController::class,'indexDeliver'])->name('Sinadat.indexDeliver');
Route::get('/Sinadat.createDeliver', [SinadatController::class,'createDeliver'])->name('Sinadat.createDeliver');
Route::post('/Sinadat.store', [SinadatController::class,'store'])->name('Sinadat.store');















//Accounting guide
Route::get('/Nadal.index', [NadalController::class,'index'])->name('Nadal.index');
Route::get('/Nadal.create', [NadalController::class,'create'])->name('Nadal.create');
Route::post('/Nadal.store', [NadalController::class,'store'])->name('Nadal.store');
Route::get('/Nadal.today',[NadalController::class,'today'])->name('Nadal.today');
Route::get('/Nadal.update/{id}/{type}',[NadalController::class,'update'])->name('Nadal.update');
Route::get('/Nadal.delete/{id}',[NadalController::class,'destroy'])->name('Nadal.delete');
Route::get('/Nadal.show/{id}',[NadalController::class,'show'])->name('Nadal.show');
Route::get('/Nadal.edit/{id}',[NadalController::class,'edit'])->name('Nadal.edit');
Route::post('/Nadal.updatenadel/{id}',[NadalController::class,'updatenadel'])->name('Nadal.updatenadel');











//Accounting guide
Route::get('/AccountingGuide.index', [AccountingGuideController::class,'index'])->name('AccountingGuide.index');
Route::get('/AccountingGuide.create', [AccountingGuideController::class,'create'])->name('AccountingGuide.create');
Route::post('/AccountingGuide.store', [AccountingGuideController::class,'store'])->name('AccountingGuide.store');
Route::get('/AccountingGuide.edit/{id}',[AccountingGuideController::class,'edit'])->name('AccountingGuide.edit');
Route::post('/AccountingGuide.update/{id}',[AccountingGuideController::class,'update'])->name('AccountingGuide.update');
Route::get('/AccountingGuide.delete/{id}',[AccountingGuideController::class,'destroy'])->name('AccountingGuide.delete');
Route::get('/AccountingGuide.show',[AccountingGuideController::class,'show'])->name('AccountingGuide.show');
Route::post('/AccountingGuide.AccountFather/{id}',[AccountingGuideController::class,'AccountFather'])->name('AccountingGuide.AccountFather');
Route::get('/AccountingGuide.Account/{id}',[AccountingGuideController::class,'Account'])->name('AccountingGuide.Account');




//depotStore
Route::get('/depotStore.index', [DepotController::class,'index'])->name('depotStore.index');
Route::get('/depotStore.create', [DepotController::class,'create'])->name('depotStore.create');
Route::post('/depotStore.store', [DepotController::class,'store'])->name('depotStore.store');
Route::get('/depotStore.edit/{id}',[DepotController::class,'edit'])->name('depotStore.edit');
Route::post('/depotStore.update/{id}',[DepotController::class,'update'])->name('depotStore.update');
Route::get('/depotStore.delete/{id}',[DepotController::class,'destroy'])->name('depotStore.delete');
Route::get('/depotStore.show/{id}',[DepotController::class,'show'])->name('depotStore.show');

Route::get('/StockDepot.index',[DepotController::class,'StockDepot'])->name('StockDepot.index');
Route::get('/StockDepot.create',[DepotController::class,'StockDepotcreate'])->name('StockDepot.create');
Route::post('/StockDepot.store', [DepotController::class,'StockDepotstore'])->name('StockDepot.store');
Route::get('/StockDepot.show/{id}',[DepotController::class,'StockDepotshow'])->name('StockDepot.show');
Route::get('/StockDepot/getBarcode/{id}',[DepotController::class,'getBarcode'])->name('StockDepot.getBarcode');

// bank
Route::get('/Bank.index', [BankController::class,'index'])->name('Bank.index');
Route::get('/Bank.create', [BankController::class,'create'])->name('Bank.create');
Route::post('/Bank.store', [BankController::class,'store'])->name('Bank.store');
Route::get('/Bank.edit/{id}',[BankController::class,'edit'])->name('Bank.edit');
Route::post('/Bank.update/{id}',[BankController::class,'update'])->name('Bank.update');
Route::get('/Bank.delete/{id}',[BankController::class,'destroy'])->name('Bank.delete');
Route::get('/Bank.show',[BankController::class,'show'])->name('Bank.show');
Route::post('/Bank.AccountFather/{id}',[BankController::class,'AccountFather'])->name('Bank.AccountFather');

// Treasury
Route::get('/Treasury.index', [TreasuryController::class,'index'])->name('Treasury.index');
Route::get('/Treasury.create', [TreasuryController::class,'create'])->name('Treasury.create');
Route::post('/Treasury.store', [TreasuryController::class,'store'])->name('Treasury.store');
Route::get('/Treasury.edit/{id}',[TreasuryController::class,'edit'])->name('Treasury.edit');
Route::post('/Treasury.update/{id}',[TreasuryController::class,'update'])->name('Treasury.update');
Route::get('/Treasury.delete/{id}',[TreasuryController::class,'destroy'])->name('Treasury.delete');
Route::get('/Treasury.show',[TreasuryController::class,'show'])->name('Treasury.show');
Route::post('/Treasury.AccountFather/{id}',[TreasuryController::class,'AccountFather'])->name('Treasury.AccountFather');

// Route::post('/ajax', function () {
//     $msg = "This is a simple message.";
//     return response()->json(array('msg'=> $msg), 200);
// })->name('ajax');


//journals
Route::get('/journals.index', [journalsController::class,'index'])->name('journals.index');
Route::get('/journals.create', [journalsController::class,'create'])->name('journals.create');
Route::post('/journals.store', [journalsController::class,'store'])->name('journals.store');
Route::get('/journals.edit/{id}',[journalsController::class,'edit'])->name('journals.edit');
Route::post('/journals.update/{id}',[journalsController::class,'update'])->name('journals.update');
Route::get('/journals.delete/{id}',[journalsController::class,'destroy'])->name('journals.delete');
Route::get('/journals.show/{id}',[journalsController::class,'show'])->name('journals.show');
Route::post('/journals.SearchAccount',[journalsController::class,'SearchAccount'])->name('journals.SearchAccount');
Route::get('/journals.pdf/{id}', [journalsController::class,'pdf'])->name('journals.pdf');


//Easy journals
Route::get('/Easyjournals.index', [EasyjournalsController::class,'index'])->name('Easyjournals.index');
Route::get('/Easyjournals.create/{id}', [EasyjournalsController::class,'create'])->name('Easyjournals.create');
Route::post('/Easyjournals.store', [EasyjournalsController::class,'store'])->name('Easyjournals.store');
Route::get('/Easyjournals.edit/{id}',[EasyjournalsController::class,'edit'])->name('Easyjournals.edit');
Route::post('/Easyjournals.update/{id}',[EasyjournalsController::class,'update'])->name('Easyjournals.update');
Route::get('/Easyjournals.delete/{id}',[EasyjournalsController::class,'destroy'])->name('Easyjournals.delete');
Route::get('/Easyjournals.show',[EasyjournalsController::class,'show'])->name('Easyjournals.show');
Route::post('/Easyjournals.SearchAccount',[EasyjournalsController::class,'SearchAccount'])->name('Easyjournals.SearchAccount');

//  costcenters
Route::get('/costcenters.index', [CostCenterController::class,'index'])->name('costcenters.index');
Route::get('/costcenters.create', [CostCenterController::class,'create'])->name('costcenters.create');
Route::post('/costcenters.store', [CostCenterController::class,'store'])->name('costcenters.store');
Route::get('/costcenters.edit/{id}',[CostCenterController::class,'edit'])->name('costcenters.edit');
Route::post('/costcenters.update/{id}',[CostCenterController::class,'update'])->name('costcenters.update');
Route::get('/costcenters.delete/{id}',[CostCenterController::class,'destroy'])->name('costcenters.delete');
Route::get('/costcenters.show',[CostCenterController::class,'show'])->name('costcenters.show');
Route::post('/costcenters.AccountFather/{id}',[CostCenterController::class,'AccountFather'])->name('costcenters.AccountFather');





//  costcenters
Route::get('/OpeningBalances.index', [OpeningBalancesController::class,'index'])->name('OpeningBalances.index');
Route::get('/OpeningBalances.create', [OpeningBalancesController::class,'create'])->name('OpeningBalances.create');
Route::post('/OpeningBalances.store', [OpeningBalancesController::class,'store'])->name('OpeningBalances.store');
Route::get('/OpeningBalances.edit/{id}',[OpeningBalancesController::class,'edit'])->name('OpeningBalances.edit');
Route::post('/OpeningBalances.update/{id}',[OpeningBalancesController::class,'update'])->name('OpeningBalances.update');
Route::get('/OpeningBalances.delete/{id}',[OpeningBalancesController::class,'destroy'])->name('OpeningBalances.delete');
Route::get('/OpeningBalances.show'       ,[OpeningBalancesController::class,'show'])->name('OpeningBalances.show');
Route::post('/OpeningBalances.AccountFather/{id}',[OpeningBalancesController::class,'AccountFather'])->name('OpeningBalances.AccountFather');
Route::post('/OpeningBalances.serach',[OpeningBalancesController::class,'serach'])->name('RoutAccount.serach');


//  Rout Account
Route::get('/RoutAccount.index', [RoutAccountController::class,'index'])->name('RoutAccount.index');
Route::get('/RoutAccount.create', [RoutAccountController::class,'create'])->name('RoutAccount.create');
Route::post('/RoutAccount.store', [RoutAccountController::class,'store'])->name('RoutAccount.store');
Route::get('/RoutAccount.edit/{id}',[RoutAccountController::class,'edit'])->name('RoutAccount.edit');
Route::post('/RoutAccount.update/{id}',[RoutAccountController::class,'update'])->name('RoutAccount.update');
Route::get('/RoutAccount.delete/{id}',[RoutAccountController::class,'destroy'])->name('RoutAccount.delete');
Route::get('/RoutAccount.show'       ,[RoutAccountController::class,'show'])->name('RoutAccount.show');
Route::post('/RoutAccount.AccountFather/{id}',[RoutAccountController::class,'AccountFather'])->name('RoutAccount.AccountFather');



//  StoreConversion
Route::get('/StoreConversion.index', [StoreConversionController::class,'index'])->name('StoreConversion.index');
Route::get('/StoreConversion.create', [StoreConversionController::class,'create'])->name('StoreConversion.create');
Route::post('/StoreConversion.store', [StoreConversionController::class,'store'])->name('StoreConversion.store');
Route::get('/StoreConversion.edit/{id}',[StoreConversionController::class,'edit'])->name('StoreConversion.edit');
Route::post('/StoreConversion.update/{id}',[StoreConversionController::class,'update'])->name('StoreConversion.update');
Route::get('/StoreConversion.delete/{id}',[StoreConversionController::class,'destroy'])->name('StoreConversion.delete');
Route::get('/StoreConversion.show/{id}' ,[StoreConversionController::class,'show'])->name('StoreConversion.show');
Route::get('/StoreConversion.StockSum/{id}',[StoreConversionController::class,'getBarcode'])->name('StoreConversion.StockSum');


Route::get('/Intransfers.index', [StoreConversionController::class,'indextransfers'])->name('Intransfers.index');
Route::get('/Intransfers.create/{id}', [StoreConversionController::class,'createTransfers'])->name('Intransfers.create');
Route::post('/Intransfers.store', [StoreConversionController::class,'storeIntransfers'])->name('Intransfers.store');
Route::get('/Intransfers.edit/{id}',[StoreConversionController::class,'edit'])->name('Intransfers.edit');
Route::post('/Intransfers.update/{id}',[StoreConversionController::class,'update'])->name('Intransfers.update');
Route::get('/Intransfers.delete/{id}',[StoreConversionController::class,'destroy'])->name('Intransfers.delete');
Route::get('/Intransfers.show/{id}' ,[StoreConversionController::class,'showIntransfers'])->name('Intransfers.show');
Route::get('/Intransfers.StockSum/{id}',[StoreConversionController::class,'getBarcodeIntransfers'])->name('Intransfers.StockSum');





//Virtua lAccounts
Route::get('/VirtualAccounts.show/{id}', [VirtualAccountsController::class,'show'])->name('VirtualAccounts.show');
Route::post('/VirtualAccounts.store'   ,    [VirtualAccountsController::class,'store'])->name('VirtualAccounts.store');
Route::get('/VirtualAccounts.index'   ,    [VirtualAccountsController::class,'index'])->name('VirtualAccounts.index');
//  Repot All  Systems
Route::get('/ReportAll.index', [ReportAllController::class,'index'])->name('ReportAll.index');
Route::get('/ReportAll.Repotcustomers', [ReportAllController::class,'Repotcustomers'])->name('ReportAll.Repotcustomers');
Route::get('/ReportAll.Repotcredorders', [ReportAllController::class,'Repotcredorders'])->name('ReportAll.Repotcredorders');
Route::get('/ReportAll.Repotoutcomes', [ReportAllController::class,'Repotoutcomes'])->name('ReportAll.Repotoutcomes');
Route::get('/ReportAll.Repotsuppliers', [ReportAllController::class,'Repotsuppliers'])->name('ReportAll.Repotsuppliers');
Route::get('/ReportAll.Repotpurchases', [ReportAllController::class,'Repotpurchases'])->name('ReportAll.Repotpurchases');
Route::get('/ReportAll.Repotdebitorder', [ReportAllController::class,'Repotdebitorder'])->name('ReportAll.Repotdebitorder');

Route::get('/ReportAll.prodcategories', [ReportAllController::class,'prodcategories'])->name('ReportAll.prodcategories');
Route::get('/ReportAll.AccountingGuide', [ReportAllController::class,'AccountingGuide'])->name('ReportAll.AccountingGuide');
Route::get('/ReportAll.Repotjournals', [ReportAllController::class,'Repotjournals'])->name('ReportAll.Repotjournals');
Route::get('/ReportAll.RepotBalances', [ReportAllController::class,'RepotBalances'])->name('ReportAll.RepotBalances');
Route::get('/ReportAll.RepotBank', [ReportAllController::class,'RepotBank'])->name('ReportAll.RepotBank');
Route::get('/ReportAll.RepotTreasury', [ReportAllController::class,'RepotTreasury'])->name('ReportAll.RepotTreasury');
Route::get('/ReportAll.TaxReturns/{id}', [ReportAllController::class,'TaxReturns'])->name('ReportAll.TaxReturns');
Route::get('/ReportAll.Balancesheet', [ReportAllController::class,'Balancesheet'])->name('ReportAll.Balancesheet');
Route::get('/ReportAll.incomelist', [ReportAllController::class,'incomelist'])->name('ReportAll.incomelist');
Route::get('/ReportAll.TrialBalance', [ReportAllController::class,'TrialBalance'])->name('ReportAll.TrialBalance');
Route::get('/ReportAll.Ledger', [ReportAllController::class,'Ledger'])->name('ReportAll.Ledger');
Route::post('/ReportAll.Accountsummary', [ReportAllController::class,'Accountsummary'])->name('ReportAll.Accountsummary');
Route::post('/ReportAll.TaxReturnsAjax', [ReportAllController::class,'TaxReturnsAjax'])->name('ReportAll.TaxReturnsAjax');
Route::post('/ReportAll.LedgerAccount', [ReportAllController::class,'LedgerAccount'])->name('ReportAll.LedgerAccount');
Route::get('/ReportAll.ReportALLproducts', [ReportAllController::class,'ReportALLproducts'])->name('ReportAll.ReportALLproducts');
Route::get('/ReportAll.ReportSandatReceive', [ReportAllController::class,'ReportSandatReceive'])->name('ReportAll.ReportSandatReceive');
Route::get('/ReportAll.ReportSandatDeliver', [ReportAllController::class,'ReportSandatDeliver'])->name('ReportAll.ReportSandatDeliver');
Route::post('/ReportAll.Damagedproducts', [ReportAllController::class,'Damagedproducts'])->name('ReportAll.Damagedproducts');
Route::get('/ReportAll.Manufactur', [ReportAllController::class,'Manufactur'])->name('ReportAll.Manufactur');
Route::get('/ReportAll.salesfatorah', [ReportAllController::class,'salesfatorah'])->name('ReportAll.salesfatorah');
Route::get('/ReportAll.Arrangement', [ReportAllController::class,'Arrangement'])->name('ReportAll.Arrangement');



Route::post('/ReportAll.OpenStoreRoeport',       [ReportAllController::class,'OpenStoreRoeport'])->name('ReportAll.OpenStoreRoeport');
Route::post('/ReportAll.StoreConversionRoeport', [ReportAllController::class,'StoreConversionRoeport'])->name('ReportAll.StoreConversionRoeport');
Route::get('/ReportAll.CustomerbalanceRoeport', [ReportAllController::class,'CustomerbalanceRoeport'])->name('ReportAll.CustomerbalanceRoeport');
Route::get('/ReportAll.suppliersbalanceRoeport', [ReportAllController::class,'suppliersbalanceRoeport'])->name('ReportAll.suppliersbalanceRoeport');
Route::post('/ReportAll.Purchproduct', [ReportAllController::class,'Purchproduct'])->name('ReportAll.Purchproduct');
Route::post('/ReportAll.TodayOrder',       [ReportAllController::class,'TodayOrder'])->name('ReportAll.TodayOrder');
Route::post('/ReportAll.MonthOrder',       [ReportAllController::class,'MonthOrder'])->name('ReportAll.MonthOrder');
Route::post('/ReportAll.Valuation',       [ReportAllController::class,'Valuation'])->name('ReportAll.Valuation');
Route::get('/ReportAll.CashierSales',       [ReportAllController::class,'CashierSales'])->name('ReportAll.CashierSales');
Route::get('/ReportAll.NadelSales',       [ReportAllController::class,'NadelSales'])->name('ReportAll.NadelSales');

Route::get('/ReportAll.MoreSalesProdect',       [ReportAllController::class,'MoreSalesProdect'])->name('ReportAll.MoreSalesProdect');
Route::get('/ReportAll.lessSalesProdect',       [ReportAllController::class,'lessSalesProdect'])->name('ReportAll.lessSalesProdect');
Route::get('/ReportAll.Profitability',       [ReportAllController::class,'Profitability'])->name('ReportAll.Profitability');
Route::get('/ReportAll.OpeningStore',       [ReportAllController::class,'OpeningStore'])->name('ReportAll.OpeningStore');
Route::get('/ReportAll.PriceProdect',       [ReportAllController::class,'PriceProdect'])->name('ReportAll.PriceProdect');
Route::get('/ReportAll.durationsSales',       [ReportAllController::class,'durationsSales'])->name('ReportAll.durationsSales');

Route::post('/ReportAll.HangeStore', [ReportAllController::class,'HangeStore'])->name('ReportAll.HangeStore');
Route::post('/ReportAll.ProdectSale', [ReportAllController::class,'ProdectSale'])->name('ReportAll.ProdectSale');
Route::get('/ReportAll.TableReport', [ReportAllController::class,'TableReport'])->name('ReportAll.TableReport');
Route::get('/ReportAll.Reportproducts/{id}/{store}', [ReportAllController::class,'Reportproducts'])->name('ReportAll.Reportproducts');
Route::get('/ReportAll.ShowTableReport/{id}', [ReportAllController::class,'ShowTableReport'])->name('ReportAll.ShowTableReport');
Route::get('/ReportAll.ShowInvoices/{id}', [ReportAllController::class,'ShowInvoices'])->name('ReportAll.ShowInvoices');
Route::get('/ReportAll.showpredectdetail/{id}', [ReportAllController::class,'showpredectdetail'])->name('ReportAll.showpredectdetail');
Route::get('/ReportAll.processprdect/{id}',     [ReportAllController::class,'processprdect'])->name('ReportAll.processprdect');
Route::get('/ReportAll.supplierShow/{id}',       [ReportAllController::class,'supplierShow'])->name('ReportAll.supplierShow');
Route::get('/ReportAll.ShowdurationsSales/{id}',       [ReportAllController::class,'ShowdurationsSales'])->name('ReportAll.ShowdurationsSales');








Route::put('/updateInfo/{id}/{type}', [EmployeesController::class,'updateInfo'])->name('employees.updateInfo');



// Profile  Company
Route::get('/Profile/{id}', [ProfileController::class,'Profile'])->name('Profile');
Route::get('/ProfileInfCompany.index', [ProfileController::class,'index'])->name('ProfileInfCompany.index');
Route::get('/ProfileInfCompany.ContactIndex', [ProfileController::class,'ContactIndex'])->name('ProfileInfCompany.ContactIndex');
Route::get('/ProfileInfCompany.ServicesIndex', [ProfileController::class,'ServicesIndex'])->name('ProfileInfCompany.ServicesIndex');
Route::get('/ProfileInfCompany.ServicesCreate', [ProfileController::class,'ServicesCreate'])->name('ProfileInfCompany.ServicesCreate');
Route::put('/ProfileInfCompany.ServicesStore', [ProfileController::class,'ServicesStore'])->name('ProfileInfCompany.ServicesStore');
Route::get('/ProfileInfCompany.ServicesDelete/{id}', [ProfileController::class,'ServicesDelete'])->name('ProfileInfCompany.ServicesDelete');
Route::get('/ProfileInfCompany.ServicesEdite/{id}', [ProfileController::class,'ServicesEdite'])->name('ProfileInfCompany.ServicesEdite');
Route::put('/ProfileInfCompany.Servicesupdate/{id}', [ProfileController::class,'Servicesupdate'])->name('ProfileInfCompany.Servicesupdate');

Route::get('/ProfileInfCompany.edit/{id}', [ProfileController::class,'edit'])->name('ProfileInfCompany.edit');
Route::get('/ProfileInfCompany.ContactEdit/{id}', [ProfileController::class,'ContactEdit'])->name('ProfileInfCompany.ContactEdit');
Route::put('/ProfileInfCompany.update/{id}', [ProfileController::class,'update'])->name('ProfileInfCompany.update');
Route::put('/ProfileInfCompany.Contactupdate/{id}', [ProfileController::class,'Contactupdate'])->name('ProfileInfCompany.Contactupdate');








//  Tainted store
Route::get('/Tainted.index',         [TaintedController::class,'index'])->name('Tainted.index');
Route::get('/Tainted.createTainted', [TaintedController::class,'createTainted'])->name('Tainted.createTainted');
Route::post('/Tainted.store',      [TaintedController::class,'store'])->name('Tainted.store');
Route::get('/Tainted.edit/{id}',   [TaintedController::class,'edit'])->name('Tainted.edit');
Route::post('/Tainted.update/{id}',[TaintedController::class,'update'])->name('Tainted.update');
Route::get('/Tainted.delete/{id}',[TaintedController::class,'destroy'])->name('Tainted.delete');
Route::get('/Tainted.show/{id}' ,[TaintedController::class,'show'])->name('Tainted.show');
Route::get('/Tainted.StockSum/{id}',[TaintedController::class,'getBarcode'])->name('Tainted.StockSum');



//  Tainted store
Route::get('/Arrangement.index',         [ArrangementController::class,'index'])->name('Arrangement.index');
Route::get('/Arrangement.create',       [ArrangementController::class,'create'])->name('Arrangement.create');
Route::post('/Arrangement.store',      [ArrangementController::class,'store'])->name('Arrangement.store');
Route::get('/Arrangement.edit/{id}',   [ArrangementController::class,'edit'])->name('Arrangement.edit');
Route::post('/Arrangement.update/{id}',[ArrangementController::class,'update'])->name('Arrangement.update');
Route::get('/Arrangement.delete/{id}',[ArrangementController::class,'destroy'])->name('Arrangement.delete');
Route::get('/Arrangement.show/{id}' ,[ArrangementController::class,'show'])->name('Arrangement.show');
Route::get('/Arrangement.StockSum/{id}',[ArrangementController::class,'getBarcode'])->name('Arrangement.StockSum');


//  Volume
Route::get('/Volume.index', [VolumeController::class,'index'])->name('Volume.index');
Route::get('/Volume.create', [VolumeController::class,'create'])->name('Volume.create');
Route::post('/Volume.store', [VolumeController::class,'store'])->name('Volume.store');
Route::get('/Volume.edit/{id}',[VolumeController::class,'edit'])->name('Volume.edit');
Route::post('/Volume.update/{id}',[VolumeController::class,'update'])->name('Volume.update');
Route::get('/Volume.delete/{id}',[VolumeController::class,'destroy'])->name('Volume.delete');
Route::get('/Volume.show/{id}' ,[VolumeController::class,'show'])->name('Volume.show');
Route::get('/Volume.StockSum/{id}',[VolumeController::class,'getBarcode'])->name('Volume.StockSum');



Route::get('/Manufactur.index', [ManufacturController::class,'index'])->name('Manufactur.index');
Route::get('/Manufactur.create', [ManufacturController::class,'create'])->name('Manufactur.create');
Route::post('/Manufactur.store', [ManufacturController::class,'store'])->name('Manufactur.store');
Route::get('/Manufactur.edit/{id}',[ManufacturController::class,'edit'])->name('Manufactur.edit');
Route::post('/Manufactur.update/{id}',[ManufacturController::class,'update'])->name('Manufactur.update');
Route::get('/Manufactur.delete/{id}',[ManufacturController::class,'destroy'])->name('Manufactur.delete');
Route::get('/Manufactur.show/{id}' ,[ManufacturController::class,'show'])->name('Manufactur.show');
Route::get('/Manufactur.confirm/{id}' ,[ManufacturController::class,'confirm'])->name('Manufactur.confirm');

Route::get('/Manufactur.StockSum/{id}',[ManufacturController::class,'getBarcode'])->name('Manufactur.StockSum');



//pakages

Route::get('/orgsubs',[SubsPacksController::class,'index'])->name('subsPakages.index');

Route::get('/packages',[SubsPacksController::class,'packages'])->name('subsPakages.packages');
Route::get('/packDetails/{id}',[SubsPacksController::class,'packDetails'])->name('subsPakages.packDetails');


Route::get('/delete-kitchen/{id}', [App\Http\Controllers\KitchensController::class,'destroy'])->name('employees.deleteAllown');


Route::post('/addComment', [TicketsController::class,'storeComment'])->name('tickets.storeComment');



/*------------------------------------HR MANAGMENT --------------------------------*/

Route::get('/employees', [EmployeesController::class,'index'])->name('employees.index');
Route::get('/departments', [EmployeesController::class,'departments'])->name('employees.departments');
Route::get('/jobs', [EmployeesController::class,'jobs'])->name('employees.jobs');
Route::get('/allowances', [EmployeesController::class,'allowances'])->name('employees.allowances');
Route::get('/salaries', [EmployeesController::class,'salaries'])->name('employees.salaries');
Route::get('/payrolls', [EmployeesController::class,'payrolls'])->name('employees.payrolls');
Route::get('/payrollsbymonth/{month}', [EmployeesController::class,'payrollsbymonth'])->name('employees.payrollsbymonth');
Route::get('/documents', [EmployeesController::class,'documents'])->name('employees.documents');
Route::get('/documents/{id}', [EmployeesController::class,'documentsByID'])->name('employees.documentsByID');
Route::get('/contracts', [EmployeesController::class,'contracts'])->name('employees.contracts');
Route::get('/contractElron/{id}', [EmployeesController::class,'electroniccontracts'])->name('electroniccontracts');
Route::get('/RemovecontractElron/{id}', [EmployeesController::class,'RemovecontractElron'])->name('RemovecontractElron');
Route::post('/savecontractElron', [EmployeesController::class,'savecontractElron'])->name('savecontractElron');

Route::get('/savecontractElronpdf/{id}', [EmployeesController::class,'savecontractElronpdf'])->name('savecontractElronpdf');
Route::get('/custodies', [EmployeesController::class,'custodies'])->name('employees.custodies');

Route::get('/subs', [EmployeesController::class,'subs'])->name('employees.subs');
Route::get('/showPage/{month}', [EmployeesController::class,'showPage2'])->name('employees.showPage');
Route::get('/showSalary/{id}', [EmployeesController::class,'showSalary'])->name('employees.showSalary');
Route::get('/editSalary/{id}', [EmployeesController::class,'editSalary'])->name('employees.editSalary');



Route::get('/createSalary/{id}', [EmployeesController::class,'createSalary'])->name('employees.addSalary');
Route::get('/createCustody/{id}', [EmployeesController::class,'createCustody'])->name('employees.addCustody');
Route::get('/newCustody/{id}', [EmployeesController::class,'newCustody'])->name('employees.newCustody');
Route::get('/newPayroll/{id}', [EmployeesController::class,'newPayroll'])->name('employees.newPayroll');
Route::get('/newSubs/{id}', [EmployeesController::class,'addSubs'])->name('employees.addSubs');

Route::post('/addDepart', [EmployeesController::class,'storeDep'])->name('employees.storeDep');
Route::post('/addJob', [EmployeesController::class,'storeJob'])->name('employees.storeJob');
Route::post('/addAllow', [EmployeesController::class,'storeAllow'])->name('employees.storeAllow');
Route::post('/addSalary', [EmployeesController::class,'storeSalary'])->name('employees.storeSalary');
Route::post('/addDoc', [EmployeesController::class,'storeDoc'])->name('employees.storeDoc');
Route::post('/addContract', [EmployeesController::class,'storeContract'])->name('employees.storeContract');
Route::post('/storeCustody', [EmployeesController::class,'storeCustody'])->name('employees.storeCustody');
Route::get('/deleteItem/{id}/{type}', [EmployeesController::class,'destroy'])->name('employees.deleteAllown');



Route::put('/updateInfo/{id}/{type}', [EmployeesController::class,'updateInfo'])->name('employees.updateInfo');

//attendance
//Route::get('/empAttendance',[SubsPacksController::class,'empAttendance'])->name('attendance.getUnits');
Route::get('/empAttendance', [AttendanceController::class,'empAttendance'])->name('attendance.empAttendance');
Route::get('/Attendances', [AttendanceController::class,'index'])->name('attendance.index');
Route::get('/shifts', [EmployeesController::class,'shifts'])->name('attendance.shifts');
Route::get('/createShift', [EmployeesController::class,'createShift'])->name('attendance.createShift');

Route::get('/storeAttendance/{lat}/{long}/{type}', [AttendanceController::class,'storeAttendance'])->name('attendance.storeAttendance');
Route::get('/storeHourAttendance/{lat}/{long}', [AttendanceController::class,'storeHourAttendance'])->name('attendance.storeHourAttendance');



Route::post('/storeShift', [EmployeesController::class,'storeShift'])->name('attendance.storeShift');

Route::post('/attByDate', [AttendanceController::class,'ByDate'])->name('attendance.ByDate');

Route::post('/storeEmp', [UsersController::class,'storeEmp'])->name('users.storeEmp');

Route::get('/createEmpUser/{id}', [UsersController::class,'createEmpUser'])->name('Users.createEmpUser');

/// Holidays

Route::resource('holydays',HolidaysController::class);
Route::get('/empHoliday', [HolidaysController::class,'empIndex'])->name('holydays.empIndex');

Route::get('/prod-autocomplete-search', [ProductsController::class, 'getProds']);

Route::get('/comp-autocomplete-search', [ProductsController::class, 'getCompProds']);
Route::get('/pur-autocomplete-search', [ProductsController::class, 'getPurProds']);


Route::resource('advances',AdvancesController::class);
Route::get('/empAdvance', [AdvancesController::class,'empIndex'])->name('advances.empIndex');



Route::get('/empDetails/{id}', [EmployeesController::class,'getByID'])->name('employees.getByID');

Route::get('/absencesRequest', [AttendanceController::class,'absenceRequests'])->name('absenceRequests.index');

Route::get('/empAbsence', [AttendanceController::class,'empAbsence'])->name('absenceRequests.empAbsence');

Route::get('/empHourAttendance', [AttendanceController::class,'empHourAttendance'])->name('attendance.empHourAttendance');




Route::resource('notices',NoticsController::class);
Route::resource('castodies',CastodiesController::class);
Route::get('/empNotic', [NoticsController::class,'empIndex'])->name('notics.empIndex');
Route::resource('assetses',AssetsController::class);
Route::resource('penalties',PenaltiesController::class);

Route::get('/moveableCustByID/{id}', [CastodiesController::class,'moveableCustByID'])->name('custodies.moveableCustodByID');


Route::get('/emp-autocomplete-search', [EmployeesController::class, 'getEmployee']);



Route::get('/cars', [AssetsController::class,'cars'])->name('cars.index');

Route::get('/types', [AssetsController::class,'types'])->name('assetses.types');


Route::post('/addAssetType', [AssetsController::class,'storeType'])->name('assetses.storeType');
Route::post('/addCar', [AssetsController::class,'storeCar'])->name('assetses.storeCar');

Route::post('/noticByDate', [NoticsController::class,'ByDate'])->name('notics.ByDate');
Route::get('/noticstypes', [NoticsController::class,'types'])->name('notics.types');
Route::post('/addnotType', [NoticsController::class,'storeType'])->name('notics.storeType');
Route::get('/upNotStatus/{id}/{status}', [NoticsController::class,'updateStatus'])->name('notics.updateStatus');

Route::get('/holitypes', [HolidaysController::class,'types'])->name('holydays.types');
Route::post('/addHolType', [HolidaysController::class,'storeType'])->name('holydays.storeType');

Route::get('/deleteHoliday/{id}',[HolidaysController::class,'destroy']);
Route::get('/updateHoliStatus/{id}/{status}',[HolidaysController::class,'updateHoliStatus']);
Route::post('/holidayByDate/{type}', [HolidaysController::class,'ByDate'])->name('holydays.ByDate');

Route::post('/getAssModels/{id}', [AssetsController::class,'getAssModels'])->name('assetses.getAssModels');
Route::post('/castodiesToEmp', [CastodiesController::class,'ToEmp'])->name('castodies.ToEmp');
Route::get('/custodies/{id}', [CastodiesController::class,'custodiesByID'])->name('castodies.custodiesByID');
Route::post('/AssetToEmp', [CastodiesController::class,'AssetToEmp'])->name('castodies.AssetToEmp');

Route::post('/return', [CastodiesController::class,'return'])->name('castodies.return');


Route::post('/empAbsence', [AttendanceController::class,'storeAbsence'])->name('absences.storeAbsence');
Route::get('/updateAbsStatus/{id}/{status}',[AttendanceController::class,'updateAbsStatus']);
Route::post('/absenceByDate/{type}', [AttendanceController::class,'AbsByDate'])->name('absences.ByDate');

//Route::post('/empAbsence', [AdvancesController::class,'storeAbsence'])->name('absences.storeAbsence');
Route::get('/updateAdvStatus/{id}/{status}',[AdvancesController::class,'updateAdvStatus']);
Route::get('/updateCustodStatus/{id}/{status}',[CastodiesController::class,'updateStatus']);
Route::post('/acceptReturn',[CastodiesController::class,'acceptReturn'])->name('castodies.acceptReturn');

Route::get('/custReturnRequests',[CastodiesController::class,'custReturnReq'])->name('castodies.custReturnReq');
Route::get('/empcustReturnRequests',[CastodiesController::class,'empcustRequests'])->name('castodies.empcustRequests');



//Route::get('/carsCastody', [AssetsController::class,'carsCastody'])->name('assetses.carsCastody');
Route::get('/allmoveable', [CastodiesController::class,'movableCastodies'])->name('castodies.movableCastodies');

Route::post('/acceptRecive',[CastodiesController::class,'acceptRecive'])->name('castodies.acceptRecive');
//oute::post('/toEmpAcceptRecive',[CastodiesController::class,'toEmpAcceptRecive'])->name('castodies.toEmpAcceptRecive');





});
