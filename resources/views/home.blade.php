@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <br>
                    <a href="{{url('keys/create')}}">添加公钥</a>
                    <a href="{{url('keys/lists')}}">解密数据</a>
                    <a href="{{url('keys/sign')}}">自动验签</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
