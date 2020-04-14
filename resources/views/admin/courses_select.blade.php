@foreach($courses as $course)
    <option value="{{$course->id}}">{{$course->name}}</option>
@endforeach
