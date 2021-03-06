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
                                @foreach($lunch->sizeCourse->sortBy('type.sort') as $course)
                                    <li>
                                        {{$course->type->sort}}. <a href="{{route('course.show', ['id' => $course->id, 'size' => $course->pivot->size_id])}}">
                                            {{$course->name}} ({{$sizes[$course->pivot->size_id]->size}} гр.)
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td scope="col" style="text-align: center">
                            <p>
                                <a href="{{route('lunches.edit', ['lunch' => $lunch->id])}}">
                                    <span class="glyphicon glyphicon-pencil" title="Редагувати"></span>
                                </a>
                            </p>
                            <p>
                                <a href="{{route('lunch.replicate', ['lunch' => $lunch->id])}}">
                                    <span class="glyphicon glyphicon-share" title="Скопіювати"></span>
                                </a>
                            </p>
                            <p>
                                <a href="#" class="delete" data-model="lunches" data-id="{{$lunch->id}}">
                                    <span class="glyphicon glyphicon-remove text-danger" title="Видалити"></span>
                                </a>
                            </p>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <a class="btn btn-primary" href="{{route('lunches.create')}}" role="button">Додати комплексний обід</a>
    </div>
</div>
