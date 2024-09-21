<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\CotacaoAddRequest;
use App\Http\Requests\CotacaoEditRequest;
use App\Models\Cotacao;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CotacaoListExport;
use App\Exports\CotacaoViewExport;
use Illuminate\Support\Facades\DB;
use Exception;
class CotacaoController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Cotacao::query();
		if($request->search){
			$search = trim($request->search);
			Cotacao::search($query, $search);
		}
		$orderby = $request->orderby ?? "cotacao.nr";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportList($query); // export current query
		}
		$records = $this->paginate($query, Cotacao::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Cotacao::query();
		// if request format is for export example:- product/view/344?export=pdf
		if($this->getExportFormat()){
			return $this->ExportView($query, $rec_id);
		}
		$record = $query->findOrFail($rec_id, Cotacao::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(CotacaoAddRequest $request){
		$modeldata = $request->validated();
		
		//save Cotacao record
		$record = Cotacao::create($modeldata);
		$rec_id = $record->nr;
		$this->afterAdd($record);
		return $this->respond($record);
	}
    /**
     * After new record created
     * @param array $record // newly created record
     */
    private function afterAdd($record){
        //enter statement here
       $ids     = DB::table('medium')->latest()->value('valor');
       $empresa = DB::table('empresa')->where('id', $record->id_empresa)->first();
       foreach($ids as $id){
           $produtos = DB::table('produto')->where('codigo', $id)->first();
       }
       DB::table('cotacao')->where('nr', $record->nr)->update(['id_produtos' => $ids,'nome_empresa'=>$empresa->nome, 'local'=>$empresa->endereco,'logo'=>$empresa->logo]);
        DB::table('medium')->where('id', '!=', 0)->delete();
    }
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(CotacaoEditRequest $request, $rec_id = null){
		$query = Cotacao::query();
		$record = $query->findOrFail($rec_id, Cotacao::editFields());
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
		$query = Cotacao::query();
		$query->whereIn("nr", $arr_id);
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
		$filename = "ListCotacaoReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Cotacao::exportListFields());
			return view("reports.cotacao-list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Cotacao::exportListFields());
			$pdf = PDF::loadView("reports.cotacao-list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new CotacaoListExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new CotacaoListExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
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
		$filename ="ViewCotacaoReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$record = $query->findOrFail($rec_id, Cotacao::exportViewFields());
			return view("reports.cotacao-view", ["record" => $record]);
		}
		elseif($format == "pdf"){
			$record = $query->findOrFail($rec_id, Cotacao::exportViewFields());
			$pdf = PDF::loadView("reports.cotacao-view", ["record" => $record]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new CotacaoViewExport($query, $rec_id), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new CotacaoViewExport($query, $rec_id), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
