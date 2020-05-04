<div class="card">
    <div class="card-header"><strong>{{$course->rc}}. {{$course->name}} ({{$size->size}} гр.)</strong></div>
    <h5>Інгредієнти:</h5>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">Продукт</th>
                    <th scope="col" style="text-align: center">Вага брутто, грамів</th>
                    <th scope="col" style="text-align: center">Вага нетто, грамів</th>
                </tr>
            </thead>
            <tbody>
                @foreach($course->product as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td style="text-align: center">{{$product->pivot->brutto * $size->factor}}</td>
                        <td style="text-align: center">{{$product->pivot->netto * $size->factor}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h5>Харчова та енергетична цінність страви:</h5>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">Білки, г</th>
                    <th scope="col" style="text-align: center">Жири, г</th>
                    <th scope="col" style="text-align: center">Вуглеводи, г</th>
                    <th scope="col" style="text-align: center">Калорії, ккал</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="col" style="text-align: center">{{$course->albumens * $size->factor}}</td>
                    <td scope="col" style="text-align: center">{{$course->fats * $size->factor}}</td>
                    <td scope="col" style="text-align: center">{{$course->carbonhydrates * $size->factor}}</td>
                    <td scope="col" style="text-align: center">{{$course->calories * $size->factor}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <h5>Технологія приготування страви:</h5>
    <p>{!!$course->recipe!!}</p>
    <h5>Органолептичні характеристики якості готової страви:</h5>
    <p>{!!$course->description!!}</p>
</div>
<br>
<a href="{{ url()->previous() }}" class="btn btn-primary">Назад</a>
