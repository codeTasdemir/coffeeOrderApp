@extends('backend.layouts.master')
@section('title')
Kahve Üst Kategori Ekle
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
                            <h3 class="card-title">Kahve Üst Kategorisi Ekle</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="store_form" method="POST" action="{{route('coffeeCategories.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Kahve üst Kategori Adı</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Kahve üst Kategori Adı">
                                </div>
                                <div class="form-group">
                                    <label for="summernote">Açıklama</label>
                                    <textarea class="textarea" name="desc" id="summernote"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Resim</label>
                                    <input class="form-control" type="file" name="image" id="formFile">
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
                        });
                        setInterval(function () {
                            $('input').val('');
                        }, 3000);


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
                        });

                    }
                })
            })
        })
    </script>

@endsection
