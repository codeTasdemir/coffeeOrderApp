@extends('front.layouts.master')
@section('title')
    Coffee Order App
@endsection
@section('content')
    <div class="container-fluid">
        <section id="home">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <form id="coffeeStore" method="post" action="{{route('front.getSelectedValues')}}">
                            @csrf
                            <h4>Kahvenizi Oluşturun</h4>
                            <hr>
                            <div>
                                <div class="mb-">
                                    <label for="">Adınız</label>
                                    <input required type="text" name="name" class="form-control" aria-describedby="basic-addon1"><br>
                                </div>
                                <div class="mb-2">
                                    <label>İçecek Türü</label>
                                    <select name="category" data-route="{{route('front.getCoffees')}}" class="category form-select">
                                        @foreach($coffeeCategory as $k => $v)
                                            <option value="{{$v->id}}">{{$v->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label>İçecek Adı</label>
                                    <select name="coffeeName" class="form-select coffees" aria-label="Default select example">
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label>Boy Seçimi</label>
                                    <select  name="size" class="form-select size" aria-label="Default select example">
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label for="">Sos / Şurup</label>
                                    <select name="syrup[]" class="form-select js-example-basic-multiple syrup" multiple="multiple" aria-label="Default select example">
                                    </select>
                                </div>
                                <br>
                                <div class="mb-1">
                                    <label for="">Süt/Süt İçermeyen Alternatifler</label>
                                    <select name="milk[]" class="form-select js-example-basic-multiple milk" multiple="multiple" aria-label="Default select example">
                                    </select>
                                </div>
                                <br>
                                <div class="mb-1">
                                    <label for="">Şeker/ Tatlandırıcı</label>
                                    <select name="sugar[]" class="form-select js-example-basic-multiple sugar" multiple="multiple" aria-label="Default select example">
                                    </select>
                                </div>
                                <br>
                                <div class="mb-1">
                                    <button class="btn btn-success" type="submit">Gönder</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8 m-auto text-center">
                        <div class="qrCodeArea">

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function (){
            //get coffees by category id.
            $('.category').on('focus',function (){
                $('.sugar').empty();
                $('.milk').empty();
                $('.size').empty();
                $('.syrup').empty();
                $('.coffees').empty();

                var catId = $(this).val();
                $.ajax({
                    type:"POST",
                    url:$(this).data('route'),
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{catId:catId},
                    success:function (data){
                        $.each(data,function(index, value ) {
                            for (let n = 0; n < value['coffees'].length; n++) {
                                $('.coffees').append('<option value="' + value.coffees[n]['id'] + '">' + value.coffees[n]['name'] + '</option>');
                            }
                        });
                        $('.coffees').on('focus',function (){
                            var coffeeId = $(this).val();
                            $('.sugar').empty();
                            $('.milk').empty();
                            $('.size').empty();
                            $('.syrup').empty();
                            $.ajax({
                                type:"POST",
                                url:'{{route('front.getCoffeeCustomization')}}',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                data:{coffeeId:coffeeId},
                                success:function (choiceDatas){
                                    $.each(choiceDatas,function(index, value ) {
                                        for (let i = 0; i < value['selectedSyrups'].length; i++) {
                                            $('.syrup').append('<option value="' + value.selectedSyrups[i]['id'] + '">' + value.selectedSyrups[i]['name'] + '</option>');
                                        }
                                    });
                                    $.each(choiceDatas,function(index, value ) {
                                        for (let j = 0; j < value['selectedMilks'].length; j++) {
                                            $('.milk').append('<option value="' + value.selectedMilks[j]['id'] + '">' + value.selectedMilks[j]['name'] + '</option>');
                                        }
                                    });
                                    $.each(choiceDatas,function(index, value ) {
                                        for (let k = 0; k < value['selectedSugars'].length; k++) {
                                            $('.sugar').append('<option value="' + value.selectedSugars[k]['id'] + '">' + value.selectedSugars[k]['name'] + '</option>');
                                        }
                                    });
                                    $.each(choiceDatas,function(index, value ) {
                                        for (let p = 0; p < value['selectedSizes'].length; p++) {
                                            $('.size').append('<option value="' + value.selectedSizes[p]['id'] + '">' + value.selectedSizes[p]['name'] + '</option>');
                                        }
                                    });
                                }
                            })
                        })
                    }
                })
            });

            $('#coffeeStore').on('submit',function (e){
              e.preventDefault();
              let url = $('#coffeeStore').attr('action');
              let form = this;
                $.ajax({
                    type:"POST",
                    url:url,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:new FormData(form),
                    processData:false,
                    datatype:'json',
                    contentType:false,
                    success:function (qrCode){
                        $('.qrCodeArea').html(qrCode);
                    }
                })
            })

        });

    </script>
@endsection
