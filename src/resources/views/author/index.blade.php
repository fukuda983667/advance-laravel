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
    <!-- $paramのキー(hasItems)を指定して、子要素のhasItemsを呼び出している -->
    @foreach ($hasItems as $item)
    <tr>
        <td>
            <!-- Authorモデルのメソッドを実行 -->
            {{$item->getDetail()}}
        </td>
        <td>
            @if ($item->book != null)
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

<table>
    <tr>
        <th>Author</th>
    </tr>
    @foreach ($noItems as $item)
        <tr>
            <td>{{ $item->getDetail() }}</td>
        </tr>
    @endforeach
</table>
@endsection

<!-- {{$item->book}} -->
<!-- {"id":1,"author_id":1,"title":"da","created_at":"2024-04-22T09:10:11.000000Z","updated_at":"2024-04-22T09:10:11.000000Z"} -->

<!-- {{$item}} -->
<!-- {"id":1,"name":"tony","age":36,"nationality":"American","created_at":"2024-04-16T16:03:07.000000Z","updated_at":"2024-04-18T04:21:16.000000Z"} -->