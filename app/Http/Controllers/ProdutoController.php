<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoAddRequest;
use App\Http\Requests\ProdutoEditRequest;
use App\Models\Produto;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProdutoListExport;
use App\Exports\ProdutoViewExport;
use Illuminate\Support\Facades\DB;
use Exception;
class ProdutoController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Produto::query();
		if($request->search){
			$search = trim($request->search);
			Produto::search($query, $search);
		}
		$orderby = $request->orderby ?? "produto.codigo";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportList($query); // export current query
		}
		$records = $this->paginate($query, Produto::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Produto::query();
		// if request format is for export example:- product/view/344?export=pdf
		if($this->getExportFormat()){
			return $this->ExportView($query, $rec_id);
		}
		$record = $query->findOrFail($rec_id, Produto::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Insert multiple rows into the database table
     * @return \Illuminate\Http\Response
     */
	function add(ProdutoAddRequest $request){
		$postdata = $request->all();
		$records = [];
		foreach($postdata as &$modeldata){
			$record = Produto::create($modeldata);
			$records[] = $record;
			$this->afterAdd($record);
		}
		return $this->respond($records);
	}
    /**
     * After new record created
     * @param array $record // newly created record
     */
    private function afterAdd($record){
        //enter statement here
        $desconto = $record->desconto?$record->desconto:0;
        DB::table('produto')->where('codigo', $record->codigo)->update(['total' =>($record->p_unitario*$record->quantidade)-$desconto]);
    }
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ProdutoEditRequest $request, $rec_id = null){
		$query = Produto::query();
		$record = $query->findOrFail($rec_id, Produto::editFields());
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
		$query = Produto::query();
		$query->whereIn("codigo", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
	

	/**
     * Export table records to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportList($query){
		ob_end_clean(); // clean any output to allow file download
		$filename = "ListProdutoReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Produto::exportListFields());
			return view("reports.produto-list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Produto::exportListFields());
			$pdf = PDF::loadView("reports.produto-list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new ProdutoListExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new ProdutoListExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
	

	/**
     * Export single record to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $record
	 * @param string $rec_id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportView($query, $rec_id){
		ob_end_clean();// clean any output to allow file download
		$filename ="ViewProdutoReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$record = $query->findOrFail($rec_id, Produto::exportViewFields());
			return view("reports.produto-view", ["record" => $record]);
		}
		elseif($format == "pdf"){
			$record = $query->findOrFail($rec_id, Produto::exportViewFields());
			$pdf = PDF::loadView("reports.produto-view", ["record" => $record]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new ProdutoViewExport($query, $rec_id), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new ProdutoViewExport($query, $rec_id), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
