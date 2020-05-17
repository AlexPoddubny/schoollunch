@foreach($allcourses as $type => $courses)
    <div class="card">
        <div class="card-header"><strong>{{$type}}</strong></div>
        @foreach($courses as $n => $course)
            @if($n % 3 == 0)
                <div class="form-group row">
            @endif
                <div class="col-sm-4">
                    <img src="{{asset('/images/' . $course->photo)}}" width=200">
                    <p>
                        <strong>
                            <a href="{{route('course.show', ['id' => $course->id])}}">{{$course->rc}}. {{$course->name}}</a>
                        </strong>
                    </p>
                </div>
            @if($n % 3 == 2)
            </div>
            @endif
        @endforeach
        @if($n % 3 != 2)
            </div>
        @endif
    </div>
    <br>
@endforeach
