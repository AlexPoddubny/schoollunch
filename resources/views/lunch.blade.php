<ul>
    @foreach($lunch->sizeCourse as $course)
        <li>
            {{$course->name}} ({{$sizes[$course->pivot->size_id]->size}})
        </li>
    @endforeach
</ul>
