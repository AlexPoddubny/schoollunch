@if(count($menus) > 0)
    @foreach($menus as $date => $menu)
        <div class="card">
            <div class="card-header">{{$date}}</div>
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
            <br>
        </div>
        <br>
    @endforeach
@else
    <p>Меню на {{date('Y-m-d')}} не складено</p>
@endif
<a href="{{ url()->previous() }}" class="btn btn-primary">На попередню сторінку</a>
@can('Menu_Create', $school)
    <a href="{{route('menu.add', ['id' => $school->id])}}" role="button" class="btn btn-primary">
        Додати позицію у меню
    </a>
@endcan
