<form action="{{route('lunches.update', ['lunch' => $lunch->id])}}" method="post">
    @csrf
    {{ method_field('PUT') }}
    <div class="form-group row">
        <label for="number" class="col-md-4 col-form-label text-md-right">Номер комплексу</label>

        <div class="col-md-6">
            <input id="number" type="number" min="1" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') ?? $lunch->number }}" required autocomplete="number" autofocus>

            @error('number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="category" class="col-md-4 col-form-label text-md-right">Категорія комплексу</label>

        <div class="col-md-6">
            <select name="category_id" class="form-control @error('number') is-invalid @enderror">
                <option disabled>Оберіть категорію</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" {{$category->id == $lunch->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                @endforeach
            </select>

            @error('category_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6 offset-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="privileged" id="privileged" {{ old('privileged') ? 'checked' : '' }}>

                <label class="form-check-label" for="privileged">
                    Пільгове харчування
                </label>
            </div>
        </div>
    </div>
    <div id="courses">
        {!! $ingredients !!}
    </div>

    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label for="type">Тип страви</label>
                <select name="type" id="type" class="form-control">
                    <option value="" selected disabled>Оберіть тип страви</option>
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3" id="courses" >
            <div class="form-group">
                <label for="course" class="control-label">Страва</label>
                <select name="course" id="courses_list" class="form-control">
                </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label for="size" class="control-label">Вага страви</label>
                <select name="size" id="size" class="form-control">
                    <option value="" selected disabled>Оберіть вагу страви</option>
                    @foreach($sizes as $size)
                        <option value="{{$size->id}}">{{$size->size}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label for="newtype" class="control-label">&nbsp;</label>
                <div class="form-group">
                    <a href="#" role="button" id="addcourse" class="btn btn-primary">
                        Додати страву
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            Зберегти комплекс
        </button>
    </div>
</form>
