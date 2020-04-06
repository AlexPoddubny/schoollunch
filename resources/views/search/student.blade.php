@if(isset($searchResults))
    @if($searchResults->isEmpty())
        <p>Учня {{$searchTerm}} не знайдено</p>
    @else
        <ul>
            @foreach($searchResults as $result)
                <li>
                    <form action="{{route('home.store')}}" method="post">
                        @csrf
                        <input type="text" hidden name="student" value="{{$result->url}}">
                        {{$result->title}}
                        <button type="submit" class="btn btn-primary">
                            Зареєструвати
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@endif
