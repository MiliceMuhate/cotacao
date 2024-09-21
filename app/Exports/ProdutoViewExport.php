<?php 

namespace App\Exports;
use App\Models\Produto;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ProdutoViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(Produto::exportViewFields());
        $this->rec_id = $rec_id;
    }


    public function query()
    {
        return $this->query->where("codigo", $this->rec_id);
    }


	public function headings(): array
    {
        return [
			'Codigo',
			'Quantidade',
			'Designacao',
			'P Unitario',
			'Empresa Id'
        ];
    }


    public function map($record): array
    {
        return [
			$record->codigo,
			$record->quantidade,
			$record->designacao,
			$record->p_unitario,
			$record->empresa_id
        ];
    }
}
