<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Empresa extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'empresa';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["nome","logo","endereco","email","nuit","site","telefone","nib","nr_conta_bancaria"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				id LIKE ?  OR 
				nome LIKE ?  OR 
				logo LIKE ?  OR 
				endereco LIKE ?  OR 
				email LIKE ?  OR 
				site LIKE ?  OR 
				telefone LIKE ?  OR 
				nr_conta_bancaria LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"id", 
			"nome", 
			"logo", 
			"endereco", 
			"email", 
			"nuit", 
			"site", 
			"telefone", 
			"nib", 
			"created_at", 
			"nr_conta_bancaria" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id", 
			"nome", 
			"logo", 
			"endereco", 
			"email", 
			"nuit", 
			"site", 
			"telefone", 
			"nib", 
			"created_at", 
			"nr_conta_bancaria" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id", 
			"nome", 
			"logo", 
			"endereco", 
			"email", 
			"nuit", 
			"site", 
			"telefone", 
			"nib", 
			"created_at", 
			"nr_conta_bancaria" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id", 
			"nome", 
			"logo", 
			"endereco", 
			"email", 
			"nuit", 
			"site", 
			"telefone", 
			"nib", 
			"created_at", 
			"nr_conta_bancaria" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"nome", 
			"logo", 
			"endereco", 
			"email", 
			"nuit", 
			"site", 
			"telefone", 
			"nib", 
			"id", 
			"nr_conta_bancaria" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
