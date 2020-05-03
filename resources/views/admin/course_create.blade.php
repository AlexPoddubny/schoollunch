<form action="{{route('courses.store')}}" method="post">
    @csrf
    <div class="form-group row">
        <label for="rc" class="col-md-4 col-form-label text-md-right">Номер страви</label>

        <div class="col-md-6">
            <input id="rc" type="number" class="form-control @error('rc') is-invalid @enderror" name="rc" value="{{old('rc')}}" required autocomplete="rc" autofocus>

            @error('rc')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">Назва страви</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="type" class="col-md-4 col-form-label text-md-right">Тип страви</label>

        <div class="col-md-6">
            <select name="type_id" class="form-control @error('type_id') is-invalid @enderror">
                @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>

            @error('type_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="products" class="col-md-12 col-form-label text-md-center">Інгредієнти (на 1 кг страви)</label>
    </div>
    <div class="form-group row">
        <div class="col-md-12 table-responsive" id="products">
        </div>
    </div>
    <div class="form-group row">
        <label for="search" class="col-md-4 col-form-label text-md-right">Оберіть інгредієнт</label>
        <div class="col-md-6">
            <ul class="hr">
                @foreach($products as $product)
                    <li>
                        <a href="#" data-id="{{$product->id}}" class="add-product">{{$product->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="form-group row">
        <label for="energy" class="col-md-12 col-form-label text-md-center">Харчова та енергетична цінність (на 1 кг страви)</label>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label for="albumens">Білки</label>
                <input name="albumens" step="0.1" class="form-control @error('albumens') is-invalid @enderror" type="number">
                @error('albumens')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label for="fats" class="control-label">Жири</label>
                <input class="form-control input-group @error('fats') is-invalid @enderror" step="0.1" name="fats" type="number">
                @error('fats')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label for="carbonhydrates" class="control-label">Вуглеводи</label>
                <input name="carbonhydrates" type="number" step="0.1" class="form-control input-group @error('carbonhydrates') is-invalid @enderror"/>
                @error('carbonhydrates')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label for="calories" class="control-label">Калорії</label>
                <input name="calories" type="number" step="0.1" class="form-control input-group @error('calories') is-invalid @enderror"/>
                @error('calories')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="recipe" class="col-md-12 col-form-label text-md-left">Технологія приготування</label>
                <textarea name="recipe" class="col-md-12 form-control input-group" rows="10"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="description" class="col-md-12 col-form-label text-md-left">Органолептичні характеристики якості готової страви:</label>
                <textarea name="description" class="col-md-12 form-control input-group" rows="10"></textarea>
                <br>
                <button type="submit" class="btn btn-primary btn-block">
                    Зберегти страву
                </button>
            </div>
        </div>
    </div>
    {{--<div class="form-group row">
        <label for="search" class="col-md-4 col-form-label text-md-right">Оберіть інгредієнт</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="query" id="course_query">
        </div>
    </div>
    <div class="col-md-12 form-group row" id="result"></div>--}}
</form>
