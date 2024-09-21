<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Cotacao extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'cotacao';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'nr';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["id_empresa","cliente","tempo_validade","desconto","iva"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				cliente LIKE ?  OR 
				nome_empresa LIKE ?  OR 
				balcao LIKE ?  OR 
				local LIKE ?  OR 
				id_empresa LIKE ?  OR 
				nr LIKE ?  OR 
				logo LIKE ?  OR 
				id_produtos LIKE ? 
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
			"cliente", 
			"nome_empresa", 
			"balcao", 
			"total", 
			"data", 
			"nr" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"cliente", 
			"nome_empresa", 
			"balcao", 
			"total", 
			"data", 
			"nr" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"nr", 
			"logo", 
			"nome_empresa", 
			"local", 
			"balcao", 
			"cliente", 
			"data", 
			"tempo_validade", 
			"iva", 
			"desconto", 
			"total", 
			"telefone", 
			"email", 
			"nuit", 
			"site", 
			"nib", 
			"nr_conta" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"nr", 
			"logo", 
			"nome_empresa", 
			"local", 
			"balcao", 
			"cliente", 
			"data", 
			"tempo_validade", 
			"iva", 
			"desconto", 
			"total", 
			"telefone", 
			"email", 
			"nuit", 
			"site", 
			"nib", 
			"nr_conta" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id_empresa", 
			"cliente", 
			"tempo_validade", 
			"desconto", 
			"iva", 
			"nr" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
