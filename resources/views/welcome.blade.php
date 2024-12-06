@extends('layouts.app')


@section('content')
    <h1>這是首頁</h1>
    <h1>Hello jQuery!</h1>
    <button id="btn">點我</button>
    
    <script>
        // 使用 jQuery 實現按鈕點擊事件(給首頁的同學參考)
        $(document).ready(function() {
            $('#btn').click(function() {
                alert('Hello, jQuery is working!');
            });
        });
    </script>
@endsection
