<div class="card">
    <div class="card-header">Страви</div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" style="text-align: center">№ страви у збірнику</th>
                <th scope="col" style="text-align: center">Тип страви</th>
                <th scope="col" style="text-align: center">Назва страви</th>
                <th scope="col" style="text-align: center">Дії</th>
            </tr>
            </thead>
            <tbody>
            @foreach($courses as $course)
                <tr>
                    <td scope="col" style="text-align: center">{{$course->rc}}</td>
                    <td scope="col" style="text-align: center">{{$course->type->name}}</td>
                    <td scope="col" style="text-align: center">{{$course->name}}</td>
                    <td scope="col" style="text-align: center">
                        <a href="{{route('course.show', ['id' => $course->id])}}">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </a>
                        <a href="{{route('courses.edit', ['course' => $course->id])}}">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!!$links!!}
        <a class="btn btn-primary" href="{{route('courses.create')}}" role="button">Додати страву</a>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header">Продукти</div>
    <div class="form-group row">
        <div class="col-md-12">
            <ul class="hr">
                @foreach($products as $product)
                    <li>
                        <a href="{{route('products.edit', ['product' => $product->id])}}">{{$product->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <form action="{{route('products.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <label for="name" class="control-label">Додати продукт</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required autocomplete="name" id="product">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <label for="button" class="control-label">&nbsp;</label>
                    <div class="form-group">
                        <button type="submit" id="newproduct" class="btn btn-primary">
                            Зберегти
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="card">
    <div class="card-header">Типи страв</div>
    <div class="form-group row">
        <div class="col-md-12">
            <ul class="hr">
                @foreach($types as $type)
                    <li>
                        {{$type->sort}}. {{$type->name}}
                    </li>
                    @php $n = $type->sort @endphp
                @endforeach
            </ul>
        </div>
    </div>
    <form action="{{route('types.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <label for="sort">Cорт</label>
                    <input type="number" class="form-control @error('sort') is-invalid @enderror" name="sort" value="{{isset($n) ? $n + 1 : 1}}" required autocomplete="sort">
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <label for="name" class="control-label">Тип страви</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required autocomplete="name">
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <label for="newtype" class="control-label">&nbsp;</label>
                    <div class="form-group">
                        <button type="submit" id="newtype" class="btn btn-primary">
                            Додати тип страви
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
</div>
<br>
<div class="card">
    <div class="card-header">Вага страв</div>
    <div class="form-group row">
        <div class="col-md-12">
            <ul class="hr">
                @foreach($sizes as $size)
                    <li>{{$size->size}} грамів</li>
                @endforeach
            </ul>
        </div>
    </div>
    <form action="{{route('sizes.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <label for="size">Вага страви</label>
                    <input type="number" id="size" step="25" min="25" class="form-control @error('size') is-invalid @enderror" name="size"  required autocomplete="size">
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <label for="factor" class="control-label">Коефіциєнт (відносно 1 кг)</label>
                    <input type="number" id="factor" step="0.025" min="0" class="form-control" name="factor" value="{{old('factor')}}" required autocomplete="factor">
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <label for="newsize" class="control-label">&nbsp;</label>
                    <div class="form-group">
                        <button type="submit" id="newsize" class="btn btn-primary">
                            Додати
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
</div>
