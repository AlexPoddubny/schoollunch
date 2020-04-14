<div class="card">
    <div class="card-header">Створити комплексний обід</div>
    <br>
    <form action="{{route('lunches.store')}}" method="post">
        @csrf
        <div class="form-group row">
            <label for="number" class="col-md-4 col-form-label text-md-right">Номер комплексу</label>

            <div class="col-md-6">
                <input id="number" type="number" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" required autocomplete="number" autofocus>

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
                <select name="category_id" class="form-control">
                    <option selected disabled>Оберіть категорію</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
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
        <div id="courses"></div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Зберегти комплекс
            </button>
        </div>
    </form>
    <div class="row">
        <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label for="type">Оберіть тип страви</label>
                <select name="type" id="type" class="form-control">
                    <option value="" selected disabled>Оберіть страву</option>
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3" id="courses" >
            <div class="form-group">
                <label for="course" class="control-label">Оберіть страву</label>
                <select name="course" id="courses_list" class="form-control">
                </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
            <div class="form-group">
                <label for="size" class="control-label">Оберіть вагу страви</label>
                <select name="size" id="size" class="form-control">
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
</div>
