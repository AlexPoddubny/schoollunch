<div class="card">
    <div class="card-header">Перерви</div>
    <p>Додайте шкільні перерви</p>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">№ перерви</th>
                    <th scope="col" style="text-align: center">Час</th>
                </tr>
            </thead>
            <tbody>
                @foreach($school->breakTime as $n => $breakTime)
                    <tr>
                        <td scope="col" style="text-align: center">{{$breakTime->break_num}}</td>
                        <td scope="col" style="text-align: center">{{$breakTime->break_time}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <form method="post" action="{{route('school.add_break')}}">
        @csrf
        <input name="school_id" type="hidden" value="{{$school->id}}">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <label for="break_num">Номер перерви</label>
                    <input name="break_num" value="{{isset($n) ? $n + 2 : 1}}" min="1" class="form-control @error('break_num') is-invalid @enderror" type="number">
                    @error('break_num')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <label for="begin" class="control-label">Початок</label>
                    <input class="form-control input-group @error('begin') is-invalid @enderror" name="begin" type="time" min="08:45" value="{{old('begin')}}">
                    @error('begin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <label for="end" class="control-label">Закінчення</label>
                    <input name="end" type="time" class="form-control input-group @error('end') is-invalid @enderror" min="08:00" value="{{old('end')}}">
                    @error('end')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
                <label for="button" class="control-label">&nbsp;</label>
                <div class="form-group">
                    <button type="submit" id="addBreak" class="btn btn-primary">
                        {{__('messages.add_break')}}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<br>
<div class="card">
    <div class="card-header">Класи</div>
    <p>Додайте класи школи.
        <br>
        Для кожного класу оберіть обідню перерву, категорію харчування та вкажіть класного керівника.
    </p>
    <form method="post" action="{{route('school.add_class')}}">
        @csrf
        <input name="school_id" type="hidden" value="{{$school->id}}">
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{__('messages.class_name')}}</label>
            <div class="col-md-4">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                {{__('messages.add_class')}}
            </button>
        </div>
    </form>
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="alert alert-success print-success-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" style="text-align: center">Клас</th>
                <th scope="col" style="text-align: center">Обідня перерва</th>
                <th scope="col" style="text-align: center">Категорія</th>
                <th scope="col" style="text-align: center">Кількість учнів</th>
                <th scope="col" style="text-align: center">Класний керівник</th>
                <th scope="col" style="text-align: center">Опції</th>
            </tr>
            </thead>
            <tbody>
            @foreach($school->schoolClass as $schoolClass)
                <tr>
                    <td scope="col" style="text-align: center">
                        <a href="{{route('schoolclass.edit', ['schoolclass' => $schoolClass->id])}}">{{$schoolClass->name}}</a>
                    </td>
                    <td scope="col" style="text-align: center">{{$schoolClass->break_id ? $schoolClass->breakTime->break_num . '. ' . $schoolClass->breakTime->break_time : 'Не вказано'}}</td>
                    <td scope="col" style="text-align: center">{{$schoolClass->category->name ?? 'Не вказано'}}</td>
                    <td scope="col" style="text-align: center">{{count($schoolClass->student)}}</td>
                    <td scope="col" style="text-align: center">
                        @if($schoolClass->teacher_id)
                            {{$schoolClass->teacher->fullName}}
                            <a href="{{route('removeteacher', ['class' => $schoolClass->id])}}">
                                <span class="glyphicon glyphicon-remove text-danger"></span>
                            </a>
                        @else
                            Не призначено
                        @endif
                    </td>
                    <td scope="col" style="text-align: center">
                        {{--
                        <a href="{{route('school.replicate', ['class' => $schoolClass->id])}}" title="Скопіювати клас">
                            <span class="glyphicon glyphicon-copy"></span>
                        </a>
                        --}}
                        <a href="#" class="delete" data-model="schoolclass" data-id="{{$schoolClass->id}}" title="Видалити клас">
                            <span class="glyphicon glyphicon-remove text-danger"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
