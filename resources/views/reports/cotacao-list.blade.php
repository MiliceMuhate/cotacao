
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Cotacao</h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Nome Empresa</th>
            <th>Balcao</th>
            <th>Total</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->cliente }}</td>
            <td>{{ $record->nome_empresa }}</td>
            <td>{{ $record->balcao }}</td>
            <td>{{ $record->total }}</td>
            <td>{{ $record->data }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
