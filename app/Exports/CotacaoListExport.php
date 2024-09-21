<?php 

namespace App\Exports;
use App\Models\Cotacao;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class CotacaoListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Cotacao::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Cliente',
			'Nome Empresa',
			'Balcao',
			'Total',
			'Data'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->cliente,
			$record->nome_empresa,
			$record->balcao,
			$record->total,
			$record->data
        ];
    }
}
