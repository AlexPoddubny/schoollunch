<p>Доброго дня, {{$user->firstname}} {{$user->middlename}}!</p>
@if(count($children) > 0)
    <div>
        Сьогодні, {{date('Y-m-d')}} у ваш{{(count($children) == 1 ? 'ої дитини наступний обід' : 'их дітей наступні обіди')}}:
    </div>
    @foreach($children as $child)
        <div>
            {{$child->fullname}}, {{$child->schoolClass->name}} клас, <a href="{{route('menu.view', ['id' => $child->schoolClass->school->id])}}">{{$child->schoolClass->school->name}}</a>, на перерві {{$child->schoolClass->breakTime->break_num}} о {{$child->schoolClass->breakTime->break_time}}:
            @foreach($child->schoolClass->breakTime->menu as $menu)
                <ul>
                    @foreach($menu->lunch->sizeCourse as $course)
                        <li>
                            <a href="{{route('course.show', ['id' => $course->id, 'size' => $course->pivot->size_id])}}">{{$course->name}} ({{$sizes[$course->pivot->size_id]->size}} гр.)</a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    @endforeach

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">П.І.Б.</th>
                    <th scope="col" style="text-align: center">Школа</th>
                    <th scope="col" style="text-align: center">Клас</th>
                    <th scope="col" style="text-align: center">Підтвердження</th>
                    <th scope="col" style="text-align: center"><span class="glyphicon glyphicon-remove"></span></th>
                </tr>
            </thead>
            <tbody>
                @foreach($children as $child)
                    <tr>

                        <td>
                            <a href="{{ route('students.show', ['student' => $child->id]) }}">{{$child->fullname}}</a>
                        </td>
                        <td style="text-align: center">
                            {{$child->schoolClass->school->name}}
                        </td>
                        <td style="text-align: center">
                            {{$child->schoolClass->name}}
                        </td>
                        <td style="text-align: center">
                            {{$child->pivot->confirmed_at ?? 'Не підтверджено. Зверніться до класного керівника для підтвердженя своєї особи.'}}
                        </td>
                        <td style="text-align: center">
                            <a href="{{route('home.remove', ['child' => $child->id])}}">
                                <span class="glyphicon glyphicon-remove text-danger"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
<div class="card">
    <div class="card-header">Додавання школяра</div>
    <br>
    <div class="form-group row">
        <label for="school_id" class="col-md-4 col-form-label text-md-right">{{ __('messages.select_school') }}</label>
        <div class="col-md-6">
            <select name="school_id" class="form-control" id="schools">
                <option disabled selected>Оберіть школу навчання вашої дитини</option>
                @foreach($schools as $school)
                    <option value="{{$school->id}}">{{$school->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div id="classes_group" hidden>
        <div class="form-group row">
            <label for="class_id" class="col-md-4 col-form-label text-md-right">Оберіть клас навчання дитини</label>
            <div class="col-md-6">
                <select name="class_id" class="form-control" id="classes">
                    <option disabled selected>Оберіть клас</option>
                </select>
            </div>
        </div>
        <div id="viewMenu" hidden>
            {{--<a class="btn btn-primary" href="#" role="button">Переглянути меню</a>
            <p>або</p>--}}
            <div class="form-group row">
                <label for="search" class="col-md-4 col-form-label text-md-right">Знайдіть учня</label>
                <div class="col-md-6">
{{--                    <input type="hidden" name="schoolClass" id="schoolClass">--}}
                    <input type="text" class="form-control" name="query" id="student" placeholder="Вкажіть не менше 3-х літер ПІБ учня">
{{--                    @livewire('search-student')--}}
                </div>
{{--                <a id="search" class="btn btn-primary" href="#" role="button">Знайти</a>--}}
            </div>
            <div class="form-group row">
                <div class="col-md-4"></div>
                <div class="form-group row col-md-6 text-md-left" id="result"></div>
            </div>
        </div>
    </div>
</div>
