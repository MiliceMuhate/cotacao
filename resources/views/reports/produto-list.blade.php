
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Produto</h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Quantidade</th>
            <th>Designacao</th>
            <th>P Unitario</th>
            <th>Empresa Id</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->codigo }}</td>
            <td>{{ $record->quantidade }}</td>
            <td>{{ $record->designacao }}</td>
            <td>{{ $record->p_unitario }}</td>
            <td>{{ $record->empresa_id }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
