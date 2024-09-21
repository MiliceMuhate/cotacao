
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <tbody>
        <tr>
            <th>Nr</th>
            <td>{{ $record->nr }}</td>
            <td>Balcao: {{ $record->balcao }}</td>
            
        </tr>
        <tr>
            <th>Cliente</th>
            <td>{{ $record->cliente }}</td>
            <td>Data: {{ $record->data }}</td>
        </tr>
        <tr>
            <th></th>
            <td>
                <img src="{{ $record->logo }}" alt="Logo" style="max-width:250px;"/>
            </td>
            <td>
                {{ $record->nome_empresa }}<br>
                Endereco: {{ $record->local }}<br>
                Telefone: {{ $record->telefone }}<br>
                Email: {{ $record->email }}<br>
                Nuit: {{ $record->nuit }}<br>
                Site: {{ $record->site }}<br>
                NIB: {{ $record->nib }}<br>
                Numero de conta: {{ $record->nr_conta }}
            </td>
        </tr>
        <tr>
            <th>Iva</th>
            <td>{{ $record->iva }}</td>
        </tr>
        <tr>
            <th>Desconto</th>
            <td>{{ $record->desconto }}</td>
        </tr>
        <tr>
            <th>Total</th>
            <td>{{ $record->total }}</td>
        </tr>
    </tbody>
</table>
@endsection
