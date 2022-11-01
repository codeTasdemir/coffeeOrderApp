@extends('backend.layouts.master')
@section('title')

@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row bg-white">
                <div class="alert alert-success">
                    <h5 >Kahve Detay</h5>
                </div>
                <div class="col-md-3 mt-2">
                    <div class="card" style="">
                        <img src="{{asset('images\coffees/'.$coffee->image)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$coffee->name}}</h5>
                            <p class="card-text">{!!  $coffee->desc !!}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Kategori: </b> {{$coffee->category->name}}</li>
                        </ul>
{{--                        <div class="card-body">--}}
{{--                            <a href="#" class="card-link">Card link</a>--}}
{{--                            <a href="#" class="card-link">Another link</a>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-3 mt-2">
                    <div class="card" >
                        <div class="card-header">
                            Süt veya Alternatifleri
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($milks as $k => $v)
                                    <li class="list-group-item">{{$v->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                        <div class="col-md-3 mt-2">
                    <div class="card" >
                        <div class="card-header">
                            Şuruplar
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($syrups as $i => $j)
                                    <li class="list-group-item">{{$j->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                        <div class="col-md-3 mt-2">
                    <div class="card" >
                        <div class="card-header">
                            Şeker vs Tatlandırıcı
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($sugars as $p => $s)
                                    <li class="list-group-item">{{$s->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                        <div class="col-md-3 mt-2">
                    <div class="card" >
                        <div class="card-header">
                            Boylar
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($sizes as $f => $m)
                                    <li class="list-group-item">{{$m->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
