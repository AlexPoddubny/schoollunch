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
    <p>Меню не вказано</p>
@endif
@can('Menu_Create')
    <a href="{{route('menu.create')}}" role="button" class="btn btn-primary">
        Додати позицію у меню
    </a>
@endcan
