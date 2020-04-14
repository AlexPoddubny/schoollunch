<div class="card">
    <div class="card-header">Комплексні обіди</div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">№ комплексу</th>
                    <th scope="col" style="text-align: center">Категорія</th>
                    <th scope="col" style="text-align: center">Пільга</th>
                    <th scope="col" style="text-align: center">Страви у комплексі</th>
                    <th scope="col" style="text-align: center">Дії</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lunches as $lunch)
                    <tr>
                        <td scope="col" style="text-align: center">{{$lunch->number}}</td>
                        <td scope="col" style="text-align: center">{{$lunch->category->name}}</td>
                        <td scope="col" style="text-align: center">{{$lunch->privileged}}</td>
                        <td scope="col">
                            <ul>
                                @foreach($lunch->sizeCourse as $course)
                                    <li>{{$course->name}} ( {{$sizes[$course->pivot->size_id]->size}} )</li>
                                @endforeach
                            </ul>
                        </td>
                        <td scope="col" style="text-align: center">Команди</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a class="btn btn-primary" href="{{route('lunches.create')}}" role="button">Додати комплексний обід</a>
    </div>
</div>
