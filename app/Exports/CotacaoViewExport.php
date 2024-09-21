<?php 

namespace App\Exports;
use App\Models\Cotacao;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class CotacaoViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(Cotacao::exportViewFields());
        $this->rec_id = $rec_id;
    }


    public function query()
    {
        return $this->query->where("nr", $this->rec_id);
    }


	public function headings(): array
    {
        return [
			'Nr',
			'Cliente',
			'',
			'Iva',
			'Desconto',
			'Total'
        ];
    }


    public function map($record): array
    {
        return [
			$record->nr,
			$record->cliente,
			$record->logo,
			$record->iva,
			$record->desconto,
			$record->total
        ];
    }
}
