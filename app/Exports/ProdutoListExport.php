<?php 

namespace App\Exports;
use App\Models\Produto;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ProdutoListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Produto::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
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
