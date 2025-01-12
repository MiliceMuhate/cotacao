<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\MediumAddRequest;
use App\Http\Requests\MediumEditRequest;
use App\Models\Medium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class MediumController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Medium::query();
		if($request->search){
			$search = trim($request->search);
			Medium::search($query, $search);
		}
		$orderby = $request->orderby ?? "medium.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$records = $this->paginate($query, Medium::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Medium::query();
		$record = $query->findOrFail($rec_id, Medium::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(MediumAddRequest $request){
		$modeldata = $request->validated();
		
		//save Medium record
		$record = Medium::create($modeldata);
		$rec_id = $record->id;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(MediumEditRequest $request, $rec_id = null){
		$query = Medium::query();
		$record = $query->findOrFail($rec_id, Medium::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $request->validated();
			$record->update($modeldata);
		}
		return $this->respond($record);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Medium::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
    /**
     * Endpoint action
     * @return \Illuminate\Http\Response
     */
    public function insertids(Request $request){
        $modeldata = ['valor' => $request->valor];
        DB::table('medium')->insert($modeldata);
    }
}
