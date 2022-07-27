<?php

use Illuminate\Support\Facades\Route;
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
Auth::routes();

/*Index page*/
Route::get('/', function () {
    return view('home');
});


/*Index page*/
Route::get('/home', function () {
    return view('home');
});
/*get products */
Route::post('/getAllProductsRoute', 'OrdersController@getAllProductsData');

/**place order*/
Route::get('/placeorder/{ProductId}', function ($ProductId) {
    return view('placeorder',['ProductId'=>$ProductId]);
});

Route::post('/getSingleProductForPlaceOrderRoute', 'OrdersController@getSingleProductForPlaceOrder');

/*submit order*/
Route::post('/submitOrderRoute', 'OrdersController@submitOrder');

/*show paymentgetway*/
Route::get('/paymentgetwayRoute/{OrdersId}', 'OrdersController@payment');
/**payment success route*/
Route::get('/paymentsuccess/{OrdersId}', function ($OrdersId) {
    return view('paymentsuccess',['OrdersId'=>$OrdersId]);
});
/*set payment status after success */
Route::post('/paymentSuccessFlagRoute', 'OrdersController@confirmOrder');
/**payment fail route*/
Route::get('/paymentfail', function () {
    return view('paymentfail');
});



/*Authentication*/
Route::get('logout', 'Auth\LoginController@logout');



/**dashboard route*/
Route::get('/dashboard/', function () {
    return view('dashboard');
})->middleware('auth'); //when not login then redirect to login page
/*get reveive trend*/
Route::post('/getReceiveTrendDataRoute', 'CommonController@getReceiveTrendData');
/*get delivery trend*/
Route::post('/getDeliveryTrendDataRoute', 'CommonController@getDeliveryTrendData');




/**order report route*/
Route::get('/orderreports/', function () {
    return view('orderreports');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('orderreports','OrdersController@getOrdersReportData')->name('orderdetailstabledatafetch');


/**receive details route*/
Route::get('/receivedetails/', function () {
    return view('receivedetails');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('receivedetails','TransactionController@getReceiveReportData')->name('receivedetailsstabledatafetch');



/**product category entry route*/
Route::get('/productcategoryentry/', function () {
    return view('productcategoryentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('productcategoryentry','ProductCategoryController@getProductCategoryData')->name('productcategorytabledatafetch');
/*add department*/
Route::post('/addEditProductCategoryRoute', 'ProductCategoryController@addEditProductCategory');
/*delete department*/
Route::post('/deleteProductCategoryRoute', 'ProductCategoryController@deleteProductCategory');




/**products entry route*/
Route::get('/productsentry/', function () {
    return view('productsentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('productsentry','ProductsController@getProductsData')->name('productstabledatafetch');
/*add products*/
Route::post('/addEditProductsRoute', 'ProductsController@addEditProducts');
/*delete products*/
Route::post('/deleteProductsRoute', 'ProductsController@deleteProducts');
/*file upload*/
Route::post('/fileUploadProductRoute', 'ProductsController@fileUpload');



/**Product Waitfor Approval route*/
Route::get('/productwaitforapproval/', function () {
    return view('productwaitforapproval');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('productwaitforapproval','FarmerRegistrationFormController@getProductWaitforApprovalData')->name('productwaitforapprovaltabledatafetch');
/*request approve*/
Route::post('/productRequestApproveRoute', 'FarmerRegistrationFormController@productRequestApprove');
/*request cancel*/
Route::post('/ProductRequestCancelRoute', 'FarmerRegistrationFormController@productRequestCancel');


/**order entry route*/
Route::get('/orderplace/', function () {
    return view('orderplace');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('orderplace','OrdersController@getOrderPlaceListData')->name('orderplacetabledatafetch');
/*orders payment confirm*/
Route::post('/orderPaymentConfirmRoute', 'OrdersController@orderPaymentConfirm');
/*order generate*/
Route::post('/orderGenerateRoute', 'OrdersController@orderGenerate');
/*delete order*/
Route::post('/deleteOrderRoute', 'OrdersController@deleteOrder');


/**orders route admin*/
Route::get('/orders/', function () {
    return view('orders');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('orders','OrdersController@getOrdersListData')->name('orderslisttabledatafetch');
/*data fetch for datatable items*/
Route::post('/ordersItems', 'OrdersController@getOrdersDetailsData');
/*orders accept*/
Route::post('/orderRequestAcceptRoute', 'OrdersController@orderRequestAccept');
/*orders delivery*/
Route::post('/orderRequestDeliveryRoute', 'OrdersController@orderRequestDelivery');
/*orders cancel*/
Route::post('/orderRequestCancelRoute', 'OrdersController@orderRequestCancel');


/**Receive entry route*/
Route::get('/receiveentry/', function () {
    return view('receiveentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('receiveentry','TransactionController@getReceiveData')->name('rectransactiontabledatafetch');
/*add products*/
Route::post('/addEditReceiveRoute', 'TransactionController@addEditReceive');
/*delete products*/
Route::post('/deleteReceiveDataRoute', 'TransactionController@deleteReceiveData');








/**blog entry route*/
Route::get('/blogentry/', function () {
    return view('blogentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('blogentry','BlogEntryController@getBlogData')->name('blogtabledatafetch');
/*add blog*/
Route::post('/addEditBlogRoute', 'BlogEntryController@addEditBlog');
/*delete blog*/
Route::post('/deleteBlogRoute', 'BlogEntryController@deleteBlog');












/**Farmer Registration Form route*/
Route::get('/farmerregistrationform/', function () {
    return view('farmerregistrationform');
})->middleware('auth'); //when not login then redirect to login page
/*update Profile*/
Route::post('/farmerregistrationformRoute', 'FarmerRegistrationFormController@addEditFarmerRegistration');



/**My products route*/
Route::get('/myproductslist/', function () {
    return view('myproductslist');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('myproductslist','FarmerRegistrationFormController@getFarmerProductsData')->name('farmerproductstabledatafetch');



/**blog route*/
Route::get('/blog/', function () {
    return view('blog');
});
/*get blog */
Route::post('/getAllBlogViewRoute', 'BlogEntryController@getAllBlogViewData');
/*file upload*/
Route::post('/fileUploadBlogRoute', 'BlogEntryController@fileUpload');


/**blog single route*/
Route::get('/blogsingle/{BlogId}', function ($BlogId) {
    return view('blogsingle',['BlogId'=>$BlogId]);
});

/*get single blog */
Route::post('/getSingleBlogViewRoute', 'BlogEntryController@getSingleBlogViewData');


/**aboutus Form route*/
Route::get('/aboutus/', function () {
    return view('aboutus');
});


/**contact Form route*/
Route::get('/contact/', function () {
    return view('contact');
});





/**User entry route*/
Route::get('/userentry/', function () {
    return view('userentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('userentry','UserEntryController@getUserData')->name('usertabledatafetch');
/*add user*/
Route::post('/addEditUserRoute', 'UserEntryController@addEditUser');
/*edit book*/
Route::post('/userEditUserRoute', 'UserEntryController@editUser');
/*delete book*/
Route::post('/deleteUserRoute', 'UserEntryController@deleteUser');
/*send sms*/
Route::post('/newUserSendSMSRoute', 'UserEntryController@newUserSendSMS');
/*file upload*/
Route::post('/fileUploadUserNIDRoute', 'UserEntryController@fileUpload');




/**User role entry route*/
Route::get('/userroleentry/', function () {
    return view('userroleentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('userroleentry','UserRoleController@getUserRoleData')->name('userroletabledatafetch');






/**Profile route*/
Route::get('/profile/', function () {
    return view('profile');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route::post('profileviewRoute', 'ProfileController@getProfileData');
/*update Profile*/
Route::post('/editProfileRoute', 'ProfileController@editMyProfile');



/*CommonController*/
/*get ProductCategory book*/
Route::post('/getProductCategoryListRoute', 'CommonController@getProductCategoryList');
/*get ProductName book*/
Route::post('/getProductNameListRoute', 'CommonController@getProductNameList');
/*get user list*/
Route::post('/getUserListRoute', 'CommonController@getUserList');
/*get farmer list*/
Route::post('/getFarmerListRoute', 'CommonController@getFarmerList');








Route::get('/hometable/', function () {
    return view('index');
});

Route::get('/test/', function () {
    return view('welcome');
});

Route::get('/users/', function () {
    return view('users');
});

Route::get('/bootstraptest/', function () {
    return view('bootstraptest');
});





Route::get('list', 'EmployeeController@list');
Route::post('/addEmployeeRoute', 'EmployeeController@addEmployee');

Route:: post('list','EmployeeController@getEmployee')->name('dataProcessing');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
