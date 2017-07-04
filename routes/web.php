<?php

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

Route::group(['middleware' => 'guest'], function() {
  Route::get('/', function() {
    return view('welcome');
  });
});

Auth::routes();

//Admin routes (All routes to manage admin panel)
Route::group(['prefix' => 'BackEndPanel', 'middleware' => ['auth', 'admin']], function() {

  //Admin dashboard routes.
  Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

  //Admin plan routes
  Route::get('/plans/add-new-plan', 'PlanController@create')->name('plan.new');
  Route::post('/plans/save', 'PlanController@store')->name('plan.save');
  Route::get('/plans/all-plans', 'AdminController@allPlans')->name('plans.all');
  Route::get('/plans/{id}/edit', 'PlanController@edit')->name('plan.edit');
  Route::post('/plans/{id}/update', 'PlanController@update')->name('plan.update');
  Route::post('/plans/{id}/hide-plan', 'PlanController@hide')->name('plan.hide');
  Route::post('/plans/{id}/unhide-plan', 'PlanController@unHide')->name('plan.unhide');
  Route::post('/plans/{id}/delete', 'PlanController@destroy')->name('plan.delete');

  //FAQ admin routes.
  Route::get('/faqs/all', 'AdminController@allFaqs')->name('faqs.all');
  Route::post('/faqs/store-new-faq', 'FaqController@store')->name('faq.store');
  Route::post('/faqs/{id}/update', 'FaqController@update')->name('faq.update');
  Route::post('/faqs/{id}/delete', 'FaqController@destroy')->name('faq.delete');

  //Support routes.
  Route::get('/support-queries', 'AdminController@allQueries')->name('support.queries');
  Route::get('/support/{id}/reply', 'SupportController@reply')->name('query.reply');
  Route::post('/support/{id}/send-reply', 'SupportController@sendReply')->name('query.send-reply');
  Route::post('/support/delete', 'SupportController@destroy')->name('query.delete');

  //Users routes
  Route::get('/users/all', 'UserController@index')->name('users.all');
  Route::get('/users/{id}/view', 'UserController@view')->name('admin.user-view');

  Route::post('/users/{id}/block', 'UserController@block')->name('user.block');
  Route::post('/users/{id}/unblock', 'UserController@unblock')->name('user.unblock');

  Route::get('/users/{id}/add-deposit', 'DepositController@addDeposit')->name('admin.user-deposit');
  Route::post('/users/{id}/save-deposit', 'DepositController@saveDeposit')->name('admin.user-save-deposit');

  Route::get('/users/{id}/add-withdrawal', 'WithdrawalController@addWithdrawal')->name('admin.user-withdrawal');
  Route::post('/users/{id}/save-withdrawal', 'WithdrawalController@saveWithdrawal')->name('admin.save-withdrawal');

  Route::get('/users/{id}/add-commission', 'CommissionController@addcommission')->name('admin.user-commission');
  Route::post('/users/{id}/save-commission', 'CommissionController@savecommission')->name('admin.save-commission');

  //Pending & deposit requests in admin
  Route::get('/deposits/pending-requests', 'AdminController@getPendingDeposits')->name('pending.deposits');
  Route::post('/deposits/{id}/approve', 'DepositController@approve')->name('approve.deposit');
  Route::post('/deposits/{id}/delete', 'DepositController@delete')->name('delete.deposit');

  //Pending & withdrawal requests in admin
  Route::get('/withdrawals/pending-requests', 'AdminController@getPendingWithdrawals')->name('pending.withdrawals');
  Route::post('/withdrawals/{id}/approve', 'WithdrawalController@approve')->name('approve.withdraw');
  Route::post('/withdrawals/{id}/delete', 'WithdrawalController@delete')->name('delete.withdraw');

  //Admin setting routes.
  Route::get('/settings', 'AdminController@setting')->name('admin.setting');
  Route::post('/settings/save', 'AdminController@saveSetting')->name('save.admin-setting');
  Route::post('/settings/{id}/update', 'AdminController@updateSetting')->name('update.admin-setting');

  //Admin send emails
  Route::get('/users/send-email', 'AdminController@emailForm')->name('email.form');
  Route::post('/users/send-email', 'AdminController@sendEmail')->name('send.email');

  //News routes.
  Route::get('/news/view-all', 'NewsController@index')->name('news.all');
  Route::get('/news/add-new', 'NewsController@create')->name('new.news');
  Route::post('/news/save', 'NewsController@store')->name('news.store');
  Route::post('/news/{id}/delete', 'NewsController@destroy')->name('news.delete');

});

//Profile and dashboard routes.
Route::group(['middleware' => 'auth'], function() {
  Route::get('/home', 'ProfileController@index')->name('dashboard');
  Route::get('/user/{id}/edit', 'ProfileController@edit')->name('profile.edit');
  Route::post('/user/{id}/update', 'ProfileController@update')->name('profile.update');
});

//Static page routes
Route::get('/rules', 'StaticPageController@rules')->name('rules');
Route::get('/how-it-works', 'StaticPageController@works')->name('works');

//FAQs page routes.
Route::get('/faqs', 'FaqController@index')->name('faqs');

//Support Routes.
Route::get('/support/new-ticket', 'SupportController@create')->name('support.new');
Route::post('/support/submit-ticket', 'SupportController@store')->name('support.store');

//Plans routes
Route::get('/plans/view-all', 'PlanController@index')->name('plans.view-all');
Route::get('/calculate-profit', 'PlanController@getProfitForm')->name('profit.form');
Route::post('/calculate-profit-result', 'PlanController@getProfitResult')->name('profit.result');

//Deposit routes.
Route::group(['middleware' => 'auth', 'prefix' => 'finance'], function() {
  Route::get('/{id}/deposit', 'DepositController@create')->name('deposit.new');
  Route::post('/{id}/deposit/send', 'DepositController@store')->name('deposit.save');
});

//Withdrawal Routes.
Route::group(['middleware' => 'auth', 'prefix' => 'finance'], function() {
  Route::get('/{id}/withdraw', 'WithdrawalController@create')->name('withdraw.new');
  Route::post('/{id}/withdraw/send', 'WithdrawalController@store')->name('withdraw.save');
  Route::get('/my-balance', 'HistoryController@myBalance')->name('my.balance');
});


//Transaction History routes.
Route::group(['middleware' => 'auth', 'prefix' => 'finance'], function() {
  Route::get('/transaction-history', 'HistoryController@index')->name('history.all');
  Route::get('/transactions/{type}/{id}/view-transaction', 'HistoryController@viewTransaction')->name('view.transaction');
});

//Refer page routes.
Route::group(['middleware' => 'auth'], function() {
  Route::get('/refer-a-friend', 'RefController@index')->name('ref.all');
});
