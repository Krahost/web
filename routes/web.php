<?php





 
Route::view('/', 'common/web/home');
Route::view('/enquiry', 'common/web/tickets/home');
Route::view('/enquiry/my-ticket', 'common/web/tickets/my-ticket');
Route::view('/enquiry/chat', 'common/web/tickets/ticket-chat');
/*Route::view('/home/{lang?}', 'common/web/home');*/
/*Route::view('/services/{lang?}', 'common/web/services');*/

Route::get('/pages/{type}', function ($type) {
    return view('common/web/cmspage', compact('type'));
});

Route::get('/access-denied', function () {
    abort('403');
});




Route::get('/track/{id}', function ($id) {
    return view('common.admin.track', compact('id'));
});

Route::get('/limit', function () {
    return view('common.admin.limit.index');
});