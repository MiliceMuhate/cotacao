
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Produto Details</h1></div>
<table class="table table-sm table-striped">
    <tbody>
        <tr>
            <th>Codigo</th>
            <td>{{ $record->codigo }}</td>
        </tr>
        <tr>
            <th>Quantidade</th>
            <td>{{ $record->quantidade }}</td>
        </tr>
        <tr>
            <th>Designacao</th>
            <td>{{ $record->designacao }}</td>
        </tr>
        <tr>
            <th>P Unitario</th>
            <td>{{ $record->p_unitario }}</td>
        </tr>
        <tr>
            <th>Empresa Id</th>
            <td>{{ $record->empresa_id }}</td>
        </tr>
    </tbody>
</table>
@endsection
