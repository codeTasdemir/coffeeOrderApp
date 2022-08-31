@extends('backend.layouts.master')
@section('title')
Boylar
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('size.create')}}" class="btn btn-primary">Yeni Boy Ekle</a>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>İd</th>
                                    <th>Adı</th>
                                    <th>Düzenle</th>
                                    <th>sil</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sizes as $k => $v)
                                    <tr>
                                        <td>{{$v->id}}</td>
                                        <td>{{$v->name}}</td>
                                        <td><a href="{{route('size.edit',$v->id)}}">Düzenle</a></td>
                                        <td><button data-url="{{route('size.destroy',$v->id)}}"  class="btn btn-danger btm-sm delete">Sil</button></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {{--                                <tfoot>--}}
                                {{--                                <tr>--}}
                                {{--                                    <th>İd</th>--}}
                                {{--                                    <th>Adı</th>--}}
                                {{--                                    <th>Kategori</th>--}}
                                {{--                                </tr>--}}
                                {{--                                </tfoot>--}}
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <script type="text/javascript">
        $(document).ready(function (){
            $('.delete').on('click',function (e){
                e.preventDefault();
                var url = $(this).data('url');

                Swal.fire({
                    title: 'Emin misiniz?',
                    text: "Bu işlem Geri Alınamaz!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sil',
                    cancelButtonText: 'Vazgeç'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url:url,
                            method:"POST",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success:function (){
                                Swal.fire(
                                    'Silindi!',
                                    'Silme İşlemi Başarılı.',
                                    'success'
                                )

                            },
                            error:function (){
                                Swal.fire(
                                    'Silinemedi!',
                                    'Silme İşlemi Gerçekleştirilemedi.',
                                    'alert'
                                )
                            }
                        })
                    }
                })
            })
        });
    </script>
@endsection
