@extends('layouts.default')
<style>
    th {
        background-color: #289ADC;
        color: white;
        padding: 5px 40px;
    }

    tr:nth-child(odd) td {
        background-color: #FFFFFF;
    }

    td {
        padding: 25px 40px;
        background-color: #EEEEEE;
        text-align: center;
    }
</style>
@section('title', 'author.index.blade.php')

@section('content')
<table>
    <tr>
        <th>Author</th>
        <th>Book</th>
    </tr>
    @foreach ($items as $item)
    <tr>
        <td>
            <!-- Authorモデルのメソッドを実行 -->
            {{$item->getDetail()}}
        </td>
        <td>
            @if ($item->book != null)
            <!-- Bookモデルのメソッドを実行 -->
                <table width="100%">
                    <!-- 主テーブルのレコードと紐づく、従テーブルのレコードを順に呼び出し -->
                    @foreach ($item->books as $obj)
                        <tr>
                            <td>{{ $obj->getTitle() }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endsection