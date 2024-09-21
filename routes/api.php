<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// api routes that need auth

Route::middleware(['auth:api'])->group(function () {


});

Route::get('home', 'HomeController@index');


/* routes for Cotacao Controller  */	
	Route::get('cotacao/', 'CotacaoController@index');
	Route::get('cotacao/index', 'CotacaoController@index');
	Route::get('cotacao/index/{filter?}/{filtervalue?}', 'CotacaoController@index');	
	Route::get('cotacao/view/{rec_id}', 'CotacaoController@view');	
	Route::post('cotacao/add', 'CotacaoController@add');	
	Route::any('cotacao/edit/{rec_id}', 'CotacaoController@edit');	
	Route::any('cotacao/delete/{rec_id}', 'CotacaoController@delete');

/* routes for Empresa Controller  */	
	Route::get('empresa/', 'EmpresaController@index');
	Route::get('empresa/index', 'EmpresaController@index');
	Route::get('empresa/index/{filter?}/{filtervalue?}', 'EmpresaController@index');	
	Route::get('empresa/view/{rec_id}', 'EmpresaController@view');	
	Route::post('empresa/add', 'EmpresaController@add');	
	Route::any('empresa/edit/{rec_id}', 'EmpresaController@edit');	
	Route::any('empresa/delete/{rec_id}', 'EmpresaController@delete');

/* routes for Medium Controller  */

/* routes for Produto Controller  */	
	Route::get('produto/', 'ProdutoController@index');
	Route::get('produto/index', 'ProdutoController@index');
	Route::get('produto/index/{filter?}/{filtervalue?}', 'ProdutoController@index');	
	Route::get('produto/view/{rec_id}', 'ProdutoController@view');	
	Route::post('produto/add', 'ProdutoController@add');	
	Route::any('produto/edit/{rec_id}', 'ProdutoController@edit');	
	Route::any('produto/delete/{rec_id}', 'ProdutoController@delete');
	
	Route::get('components_data/id_empresa_option_list/{arg1?}', 'Components_dataController@id_empresa_option_list');


/* Custom endpoint routes  */	
	Route::post('medium/insertids', 'MediumController@insertids');

/* routes for FileUpload Controller  */	
Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');