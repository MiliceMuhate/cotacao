<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Components Data Contoller
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Controller
 */
class Components_dataController extends Controller{
	
	/**
     * id_empresa_option_list Model Action
     * @return array
     */
	function id_empresa_option_list(Request $request){
		$sqltext = "SELECT  DISTINCT id AS value,nome AS label FROM empresa";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
}
