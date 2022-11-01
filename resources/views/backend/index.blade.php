@extends('backend.layouts.master')
@section('title')
 Anasayfa - Admin Paneli
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{route('logout')}}">
            @csrf
            <button class="btn btn-danger" type="submit">
                çıkış yap
            </button>
        </form>
    </div>
@endsection
