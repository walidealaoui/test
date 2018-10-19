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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
//
Route::get('/info','HomeController@info');
Route::get('/', 'HomeController@situation');
Route::post('/compteselection','HomeController@compteSelectione');
Route::get('/CLT_COMPTE_OPERATIONS/{id}', 'HomeController@allOperCompteClient');
Route::get('/loadoperationscomponent/{id}','HomeController@loadoperationscomponent');
Route::get('/fonds/{id}','HomeController@fonds');
Route::get('/CLT_COMPTE_COMPOSITION_FONDS/{id}','HomeController@allFondsCompteClient');

Route::get('/CKG_FOND_CONDITIONS/{id}','HomeController@conditionfonds');

Route::get('/BENCHMARK_SI','HomeController@arrayOfBenchmarks');

Route::get('/touLesFonds','HomeController@touLesFonds');
Route::get('/filtrerFonds','HomeController@filtrerFonds');















//
//Route::get('/', 'HomeController@index');
//Route::get('/fonds', 'DashboardController@fonds');
Route::get('/operations', 'DashboardController@operations');
Route::get('/simulateur', 'HomeController@simulateur');
Route::get('/documentation', 'DashboardController@documentation');
//Route::get('/alloperations', 'DashboardController@allOper');
Route::get('/allfonds', 'DashboardController@allFonds');
Route::get('/results', 'DashboardController@filteroperations');
//Route::get('/', 'HomeController@welcome');
Route::get('/home', 'HomeController@index');



//Route::get('/', 'FrontController@index');

//

//Route::get('/fonds', 'FrontController@fonds');
Route::get('/CKG_LIST_FONDS', 'BackController@getFonds');
Route::get('/CKG_FOND_DATA/{id}','BackController@getFondData');
Route::get('/CLT_COMPTE_OPERATIONS/{clt_ref_ckg}','BackController@getClientsOperations');




