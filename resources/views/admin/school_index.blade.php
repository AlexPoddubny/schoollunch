<div class="card">
    <div class="card-header">Перерви</div>
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
                    <input name="end" type="time" class="form-control input-group @error('end') is-invalid @enderror" min="08:00" value="{{old('end')}}"/>
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
    <br>
    <form method="post" action="{{route('school.add_class')}}">
        @csrf
        <input name="school_id" type="hidden" value="{{$school->id}}">
        <div class="form-group row">
            <label for="classname" class="col-md-4 col-form-label text-md-right">{{__('messages.class_name')}}</label>
            <div class="col-md-4">
                <input type="text" class="form-control @error('classname') is-invalid @enderror" name="classname" value="{{old('classname')}}">
                @error('classname')
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
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" style="text-align: center">Клас</th>
                <th scope="col" style="text-align: center">Обідня перерва</th>
                <th scope="col" style="text-align: center">Категорія</th>
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
                    <td scope="col" style="text-align: center">{{$schoolClass->break_id == null ? 'Не вказано' : $schoolClass->breakTime->break_time}}</td>
                    <td scope="col" style="text-align: center">{{$schoolClass->category->name ?? 'Не вказано'}}</td>
                    <td scope="col" style="text-align: center">{{$schoolClass->teacher_id == null ? 'Не призначено' : fullname($schoolClass->teacher)}}</td>
                    <td scope="col" style="text-align: center">
                        <form method="post" action="{{route('school.copy_class', ['class' => $schoolClass->id])}}">
                            @csrf
                            <button type="submit" class="btn btn-primary" id="copy_class">
                                {{__('messages.copy_class')}}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
