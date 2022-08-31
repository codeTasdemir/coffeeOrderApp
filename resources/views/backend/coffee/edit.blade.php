@extends('backend.layouts.master')
@section('title')
 Kahve Düzenle - {{$coffee->name}}
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 m-auto">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Kahve Ekle</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="store_form" method="POST" action="{{route('coffee.update',$coffee->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Kahve Adı</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Kahve Adı" value="{{$coffee->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Kahve Açıklama</label>
                                    <textarea name="desc" id="summernote">{!! $coffee->desc !!}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Kahve Üst Kategorisini Seçiniz</label>
                                    <select name="catId" class="form-control">
                                        @foreach($coffeeCategories as $k => $v)
                                            <option value="{{$v->id}}">{{$v->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row mb-5">
                                    <div class="col-md-4 mt-2">
                                        <label for="">Süt & Süt İçermeyen Alternatifler</label>
                                        <br>
                                        <div class="form-check">
                                            @foreach($milks as $i => $j)
                                                <input class="form-check-input" type="checkbox" id="inlineCheckboxmilk{{$j->id}}" value="{{$j->id}}" name="milks[]" @if(!empty($coffee->milks) && in_array($j->id,$coffee->milks))  checked @endif>
                                                <label class="form-check-label" for="inlineCheckboxmilk{{$j->id}}">{{$j->name}}</label>
                                                <br>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-2">
                                        <label for="">Şuruplar</label>
                                        <br>
                                        <div class="form-check">
                                            @foreach($syrups as $f => $l)

                                                <input class="form-check-input" type="checkbox" id="inlineCheckboxsyrups{{$l->id}}" value="{{$l->id}}" name="syrups[]" @if(!empty($coffee->syrups) && in_array($l->id,$coffee->syrups)) checked @endif>
                                                <label class="form-check-label" for="inlineCheckboxsyrups{{$l->id}}">{{$l->name}} </label>
                                                <br>
                                            @endforeach
                                        </div>

                                    </div>

                                    <div class="col-md-4 mt-2">
                                        <label for="">Şeker & Tatlandırıcı</label>
                                        <br>
                                        <div class="form-check">
                                            @foreach($sugars as $m => $n)
                                                <input class="form-check-input" type="checkbox" id="inlineCheckboxsugars{{$n->id}}" value="{{$n->id}}" name="sugars[]" @if(!empty($coffee->sugars) && in_array($n->id,$coffee->sugars))  checked @endif">
                                                <label class="form-check-label" for="inlineCheckboxsugars{{$n->id}}">{{$n->name}}</label>
                                                <br>
                                            @endforeach
                                        </div>

                                    </div>

                                    <div class="col-md-4 mt-2">
                                        <label for="">Boylar</label>
                                        <br>
                                        <div class="form-check">
                                            @foreach($sizes as $s => $f)
                                                <input class="form-check-input" type="checkbox" id="inlineCheckboxsizes{{$f->id}}" value="{{$f->id}}" name="sizes[]" @if(!empty($coffee->sizes) && in_array($f->id,$coffee->sizes))  checked @endif">
                                                <label class="form-check-label" for="inlineCheckboxsizes{{$f->id}}">{{$f->name}}</label>
                                                <br>
                                            @endforeach
                                        </div>

                                    </div>

                                </div>


                                <div class="mb-3">
                                    <label for="" class="form-label">Mevcut Resim</label>
                                    <img style="height: 150px" src="{{asset('images\coffees/'.$coffee->image)}}" class="d-block img-thumbnail" alt="...">
                                </div>

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Resim</label>
                                    <input class="form-control" name="image" type="file" id="formFile">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Oluştur</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script type="text/javascript">
        $(document).ready(function (){
            $('#store_form').on('submit',function (e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    type:"POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:$(this).attr('action'),
                    data:new FormData(form),
                    processData:false,
                    datatype:'json',
                    contentType:false,
                    success:function (){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Kayıt Başarılı'
                        })
                    },
                    error:function (){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: 'Kayıt Tamamlanamadı'
                        })
                    }
                })
            })
        })
    </script>

@endsection
