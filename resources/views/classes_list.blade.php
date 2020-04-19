@foreach($classes as $class)
    <li>
        <input class="form-check-input" type="checkbox" name="class_id[]"
               value="{{$class->id}}">

        <label class="form-check-label" for="class_id">
            {{$class->name}}
        </label>
    </li>
@endforeach
