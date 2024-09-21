<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Produto extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'produto';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'codigo';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["quantidade","designacao","p_unitario","empresa_id"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				codigo LIKE ?  OR 
				designacao LIKE ?  OR 
				p_unitario LIKE ?  OR 
				empresa_id LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%"
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
			"codigo", 
			"quantidade", 
			"designacao", 
			"p_unitario", 
			"empresa_id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"codigo", 
			"quantidade", 
			"designacao", 
			"p_unitario", 
			"empresa_id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"codigo", 
			"quantidade", 
			"designacao", 
			"p_unitario" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"codigo", 
			"quantidade", 
			"designacao", 
			"p_unitario" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"quantidade", 
			"designacao", 
			"p_unitario", 
			"empresa_id", 
			"codigo" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
