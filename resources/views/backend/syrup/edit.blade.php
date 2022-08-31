@extends('backend.layouts.master')
@section('title')

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
                            <h3 class="card-title">Şurup Ekle</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="store_form" method="POST" action="{{route('syrup.update',$syrup->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Şurup Adı</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Şurup Adı" value="{{$syrup->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Şurup Açıklama</label>
                                    <textarea name="desc" id="summernote">{!! $syrup->desc !!}</textarea>
                                </div>


                                <div class="mb-3">
                                    <label for="" class="form-label">Mevcut Resim</label>
                                    <img style="height: 150px" src="{{asset('images\syrups/'.$syrup->image)}}" class="d-block img-thumbnail" alt="...">
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
