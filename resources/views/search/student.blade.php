@if(isset($students))
    @if($students->isEmpty())
        <p>Учня {{$name}} не знайдено</p>
    @else
        <ul class="dropdown-menu" style="display:block; position:relative">
            @foreach($students as $student)
                {{--<li class="list-group-item">
                    <form action="{{route('home.store')}}" method="post">
                        @csrf
                        <input type="text" hidden name="student" value="{{$student->id}}">
                        {{$student->fullname}}
                        <button type="submit" class="btn btn-primary">
                            Зареєструвати
                        </button>
                    </form>
                </li>--}}
                <li{{-- class="list-group-item"--}}>
                    <a href="#" data-id="{{$student->id}}" class="add-child">{{$student->fullname}}</a>
                </li>
            @endforeach
        </ul>
    @endif
@endif
