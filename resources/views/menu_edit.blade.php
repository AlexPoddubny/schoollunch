<form action="{{route('menu.update', ['menu' => $menu->id])}}" method="post">
    @csrf
    {{ method_field('PUT') }}
    <div class="form-group row">
        <label for="date" class="col-md-4 col-form-label text-md-right">Дата</label>

        <div class="col-md-6">
            <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{old('date') ?? $menu->date}}" required autocomplete="date" autofocus>

            @error('date')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="break" class="col-md-4 col-form-label text-md-right">Перерва</label>

        <div class="col-md-6">
            <select name="break_id" id="break_id" class="form-control class-select @error('break_id') is-invalid @enderror">
                <option disabled>Оберіть перерву</option>
                @foreach($breaks as $break)
                    <option value="{{$break->id}}" {{$break->id == $menu->break_id ? 'selected' : ''}}>{{$break->break_num}}. {{$break->break_time}}</option>
                @endforeach
            </select>

            @error('break_id')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="category" class="col-md-4 col-form-label text-md-right">Категорія харчування</label>
        <div class="col-md-6">
            <select name="category_id" id="category_id" class="form-control menu-select class-select @error('category_id') is-invalid @enderror">
                <option disabled>Оберіть категорію харчування</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" {{$category->id == $menu->category_id ? 'selected' : ''}}>{{$category->name}}</option>
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
                <input class="form-check-input menu-select" type="checkbox" name="privileged" id="privileged" {{ old('privileged') ? 'checked' : '' }}>

                <label class="form-check-label" for="privileged">
                    Пільгове харчування
                </label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="lunch" class="col-md-4 col-form-label text-md-right">Комплексний обід</label>
        <div class="col-md-6">
            <select name="lunch_id" id="lunch_select" class="form-control @error('lunch_id') is-invalid @enderror">
                @foreach($lunches as $lunch)
                    <option value="{{$lunch->id}}" {{$lunch->id == $menu->lunch_id ? 'selected' : ''}}>Комплекс № {{$lunch->number}}</option>
                @endforeach
            </select>

            @error('lunch_id')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6 offset-md-4" id="lunch"></div>
    </div>
    <div class="form-group row">
        <button type="submit" class="btn btn-primary btn-block">
            Зберегти
        </button>
    </div>
</form>
