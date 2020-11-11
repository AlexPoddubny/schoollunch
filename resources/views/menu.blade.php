@if(count($menus) > 0)
    <h3>
        Двотижневе меню з {{date('Y-m-d', strtotime("last monday"))}}:
    </h3>
    @foreach($menus as $date => $menu)
        <div class="card">
            <details {{($date == date('Y-m-d')) ? "open" : ""}}>
                <summary>{{($date == date('Y-m-d')) ? "Сьогодні, " : ""}}{{$date}}, {{\Carbon\Carbon::parse($date)->locale('uk')->getTranslatedDayName('dddd')}}</summary>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center">Перерва</th>
                                <th scope="col" style="text-align: center">№ комплексу</th>
                                <th scope="col" style="text-align: center">Категорія</th>
                                <th scope="col" style="text-align: center">Склад</th>
                                @can('Menu_Create', $school)
                                    <th scope="col" style="text-align: center">Дії</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menu as $item)
                                <tr>
                                    <td>{{$item->breakTime->break_num}}. {{$item->breakTime->break_time}}</td>
                                    <td>Комплекс №{{$item->lunch->number}}{{($item->lunch->privileged) ? '(Пільговий)' : ''}}</td>
                                    <td>{{$item->lunch->category->name}}</td>
                                    <td>
                                        <ul>
                                            @foreach($item->lunch->sizeCourse as $course)
                                                <li>
                                                    <a href="{{route('course.show', ['id' => $course->id, 'size' => $course->pivot->size_id])}}">{{$course->name}} ({{$sizes[$course->pivot->size_id]->size}})</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    @can('Menu_Create', $school)
                                        <td>
                                            <a href="{{route('menu.edit', ['menu' => $item->id])}}">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                            <a href="#" class="delete" data-model="menu" data-id="{{$item->id}}">
                                                <span class="glyphicon glyphicon-remove text-danger"></span>
                                            </a>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @can('Menu_Create', $school)
                    <form action="{{route('menu.replicate')}}" method="post">
                        @csrf
                        <input type="hidden" name="school_id" value="{{$school->id}}">
                        <input type="hidden" name="fromdate" value="{{$date}}">
                        <input type="hidden" name="type" value="day">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label for="todate" class="control-label">Скопіювати денне меню на іншу дату:</label>
                                    <input type="date"
                                        class="form-control
                                        @error('todate')
                                           is-invalid
                                        @enderror"
                                        name="todate"
                                        value="{{$nextDay}}"
                                        required
                                        autocomplete="todate">
                                    @error('todate')
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
                                        <button type="submit" class="btn btn-primary">
                                            Скопіювати
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endcan
            </details>
        </div>
        <br>
    @endforeach
    <h5>Затверджено: Завпрод {{$school->name}} {{$school->cook->lastNameInitials}}</h5>
@else
    <p>Меню на {{date('Y-m-d')}} не складено</p>
@endif
<a href="{{ url()->previous() }}" class="btn btn-primary">На попередню сторінку</a>
@can('Menu_Create', $school)
    <a href="{{route('menu.add', ['id' => $school->id])}}" role="button" class="btn btn-primary">
        Додати позицію у меню
    </a>
@endcan
