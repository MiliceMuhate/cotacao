
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Empresa</h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Logo</th>
            <th>Endereco</th>
            <th>Email</th>
            <th>Nuit</th>
            <th>Site</th>
            <th>Telefone</th>
            <th>Nib</th>
            <th>Created At</th>
            <th>Nr Conta Bancaria</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->nome }}</td>
            <td>{{ $record->logo }}</td>
            <td>{{ $record->endereco }}</td>
            <td>{{ $record->email }}</td>
            <td>{{ $record->nuit }}</td>
            <td>{{ $record->site }}</td>
            <td>{{ $record->telefone }}</td>
            <td>{{ $record->nib }}</td>
            <td>{{ $record->created_at }}</td>
            <td>{{ $record->nr_conta_bancaria }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
