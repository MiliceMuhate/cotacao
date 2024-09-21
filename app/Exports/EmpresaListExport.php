<?php 

namespace App\Exports;
use App\Models\Empresa;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class EmpresaListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Empresa::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Id',
			'Nome',
			'Logo',
			'Endereco',
			'Email',
			'Nuit',
			'Site',
			'Telefone',
			'Nib',
			'Created At',
			'Nr Conta Bancaria'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->nome,
			$record->logo,
			$record->endereco,
			$record->email,
			$record->nuit,
			$record->site,
			$record->telefone,
			$record->nib,
			$record->created_at,
			$record->nr_conta_bancaria
        ];
    }
}
