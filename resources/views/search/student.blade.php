@if(isset($students))
    @if($students->isEmpty())
        <p>Учня {{$name}} не знайдено</p>
    @else
        <ul>
            @foreach($students as $student)
                <li>
                    <form action="{{route('home.store')}}" method="post">
                        @csrf
                        <input type="text" hidden name="student" value="{{$student->id}}">
                        {{$student->fullname}}
                        <button type="submit" class="btn btn-primary">
                            Зареєструвати
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@endif
