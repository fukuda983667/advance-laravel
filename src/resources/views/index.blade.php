@extends('layouts.default')
<style>
    th {
        background-color: #289ADC;
        color: white;
        padding: 5px 40px;
    }
    tr:nth-child(odd) td{
        background-color: #FFFFFF;
    }
    td {
        padding: 25px 40px;
        background-color: #EEEEEE;
        text-align: center;
    }
</style>

@section('title', 'index.blade.php')

@section('content')
<table>
    <tr>
        <th>Data</th>
    </tr>
    @foreach ($authors as $author)
        <tr>
        <td>{{$author->getDetail()}}</td>
        </tr>
    @endforeach
</table>
<!-- <table>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>age</th>
        <th>nationality</th>
    </tr>
    authorは二次元配列の一般的な配列。添え字順に$authorに代入、authorからキーを指定して出力
    @foreach ($authors as $author)
    <tr>
        <td>{{$author->id}}</td>
        <td>{{$author->name}}</td>
        <td>{{$author->age}}</td>
        <td>{{$author->nationality}}</td>
    </tr>
    @endforeach
</table> -->
@endsection