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

Route::get('/', function () {
    return redirect()->intended('/home');
});

Auth::routes();

Route::get('/test', function (){
   return \App\Agent::all()->last();
});

Route::get('/home', 'AgentController@index')->name('home');
Route::post('/agents/register', 'AgentController@postRegisterAgent');
Route::get('/agents/edit/{agent_id}', 'AgentController@getEditAgent');
Route::post('/agents/edit/{agent_id}', 'AgentController@postEditAgent');
Route::get('/agents/delete/{agent_id}', 'AgentController@getDeleteAgent');
Route::post('/agents/delete/{agent_id}', 'AgentController@postDeleteAgent');


Route::get('/recipients', 'RecipientsController@index');
Route::post('/recipients/register', 'RecipientsController@postRegisterRecipient');
Route::get('/recipients/edit/{agent_id}', 'RecipientsController@getEditRecipient');
Route::post('/recipients/edit/{agent_id}', 'RecipientsController@postEditRecipient');
Route::get('/recipients/delete/{agent_id}', 'RecipientsController@getDeleteRecipient');
Route::post('/recipients/delete/{agent_id}', 'RecipientsController@postDeleteRecipient');

Route::get('/containers', 'ContainersController@index');
Route::get('/containers/generate', 'ContainersController@generateNewContainer');
Route::get('/container/{container_id}/add-good', 'ContainersController@addNewGoodToContainer');
Route::get('/container/{container_id}/edit-good/{good_id}', 'ContainersController@getEditGood');
Route::post('/container/{container_id}/add-good', 'ContainersController@postAddNewGoodToContainer');
Route::post('/container/{container_id}/edit-good/{good_id}', 'ContainersController@postEditGood');
Route::get('/container/{container_id}/delete-good/{good_id}', 'ContainersController@deleteGood');
Route::get('/containers/{container_id}/goods', 'ContainersController@viewContainerGoods');

Route::get('/containers/edit/{agent_id}', 'ContainersController@getEditContainer');
Route::post('/containers/edit/{agent_id}', 'ContainersController@postEditContainer');
Route::get('/containers/delete/{agent_id}', 'ContainersController@getDeleteContainer');
Route::post('/containers/delete/{agent_id}', 'ContainersController@postDeleteContainer');


Route::get('/transactions', 'TransactionsController@index');
Route::post('/transactions/register', 'TransactionsController@postRegisterTransaction');
Route::get('/transactions/edit/{agent_id}', 'TransactionsController@getEditTransaction');
Route::post('/transactions/edit/{agent_id}', 'TransactionsController@postEditTransaction');
Route::get('/transactions/delete/{agent_id}', 'TransactionsController@getDeleteTransaction');
Route::post('/transactions/delete/{agent_id}', 'TransactionsController@postDeleteTransaction');

Route::get('/transaction/{transaction_id}/confirm_delivery', 'TransactionsController@confirmTransactionDelivery');
Route::get('/transaction/{transaction_id}/revert_delivery_action', 'TransactionsController@revertDeliveryAction');

Route::get('/users', 'TransactionsController@getUsersListings');
Route::post('/users/register', 'TransactionsController@registerUser');





