@foreach($menus as $date => $menu)
    <div class="card">
        <div class="card-header">{{$date}}</div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center">Перерва</th>
                        <th scope="col" style="text-align: center">№ комплексу</th>
                        <th scope="col" style="text-align: center">Склад</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menu as $item)
                        <tr>
                            <td>{{$item->breakTime->break_num}}. {{$item->breakTime->break_time}}</td>
                            <td>Комплекс №{{$item->lunch->number}}{{($item->lunch->privileged) ? '(Пільговий)' : ''}}</td>
                            <td>
                                <ul>
                                    @foreach($item->lunch->sizeCourse as $course)
                                        <li>
                                            {{$course->name}} ({{$sizes[$course->pivot->size_id]->size}})
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
    {{-- Додати перевірку на повара--}}
    <a href="{{route('menu.create')}}" role="button" class="btn btn-primary">
        Додати позицію у меню
    </a>
</div>
