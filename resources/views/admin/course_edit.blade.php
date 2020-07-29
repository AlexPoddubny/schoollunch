<form action="{{route('courses.update', ['course' => $course->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PUT') }}
    <div class="form-group row">
        <label for="rc" class="col-md-4 col-form-label text-md-right">№ страви у збірнику</label>

        <div class="col-md-6">
            <input id="rc" type="number" class="form-control @error('rc') is-invalid @enderror" name="rc" value="{{old('rc') ?? $course->rc}}" required autocomplete="rc" autofocus>

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
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name') ?? $course->name}}" required autocomplete="name" autofocus>

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
                    <option value="{{$type->id}}" {{($type->id == $course->type_id) ? 'selected' : '' }}>{{$type->name}}</option>
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
        <label for="products" class="col-md-12 col-form-label text-md-center"><strong>Інгредієнти (на 1 кг страви)</strong></label>
    </div>
    {{--Інгредієнти--}}
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="form-group row">
        <div class="col-md-12 table-responsive" id="products">
            {!! $ingredients !!}
        </div>
    </div>
    {{--Продукти--}}
    <div class="form-group row">
        <label for="products" class="col-md-12 col-form-label text-md-left"><strong>Додати продукт</strong></label>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label for="product_id">Оберіть продукт</label>
                <select name="product_id" id="product_id" class="form-control">
                    <option value="" selected disabled>Оберіть продукт</option>
                    @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label for="brutto">Вага брутто</label>
                <input type="number" step="0.1" name="brutto" id="brutto" class="form-control">
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label for="netto">Вага нетто</label>
                <input type="number" step="0.1" name="netto" id="netto" class="form-control">
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label for="newproduct" class="control-label">&nbsp;</label>
                <div class="form-group">
                    <a href="#" role="button" id="add-product" class="btn btn-primary">
                        Додати продукт
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="energy" class="col-md-12 col-form-label text-md-center">Харчова та енергетична цінність (на 1 кг страви)</label>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label for="albumens">Білки</label>
                <input name="albumens" step="0.1" class="form-control @error('albumens') is-invalid @enderror" type="number" value="{{old('albumens') ?? $course->albumens}}">
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
                <input class="form-control input-group @error('fats') is-invalid @enderror" step="0.1" name="fats" type="number" value="{{old('fats') ?? $course->fats}}">
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
                <input name="carbonhydrates" type="number" step="0.1" class="form-control input-group @error('carbonhydrates') is-invalid @enderror" value="{{old('carbonhydrates') ?? $course->carbonhydrates}}"/>
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
                <input name="calories" type="number" step="0.1" class="form-control input-group @error('calories') is-invalid @enderror" value="{{old('calories') ?? $course->calories}}"/>
                @error('calories')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    @isset($course->photo)
        <img src="{{asset('/images/' . $course->photo)}}" alt="" style="object-fit: contain">
    @endisset
    <div class="form-group">
        <label for="image">Завантажити фото страви</label>
        <input type="file" class="form-control-file" name="image" value="{{$course->photo}}">
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="recipe" class="col-md-12 col-form-label text-md-left">Технологія приготування</label>
                <textarea name="recipe" class="col-md-12 form-control input-group @error('recipe') is-invalid @enderror" rows="10">{{old('recipe') ?? $course->recipe}}</textarea>
                @error('recipe')
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
                <label for="description" class="col-md-12 col-form-label text-md-left">Органолептичні характеристики якості готової страви:</label>
                <textarea name="description" class="col-md-12 form-control input-group @error('description') is-invalid @enderror" rows="10">{{old('description') ?? $course->description}}</textarea>
                @error('decription')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <button type="submit" class="btn btn-primary btn-block">
                    Зберегти страву
                </button>
            </div>
        </div>
    </div>
</form>
