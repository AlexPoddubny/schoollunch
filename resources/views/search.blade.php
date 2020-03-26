@if(isset($searchResults))
    @if($searchResults->isEmpty())
        <p>Учня {{$searchTerm}} не знайдено</p>
    @else
        <ul>
            @foreach($searchResults as $result)
                <li>
                    <a href="{{$result->url}}">{{$result->title}}</a>
                    <a href="{{route('home.store')}}" class="btn btn-primary" role="button">Зареєструвати</a>
                </li>
            @endforeach
        </ul>
    @endif
@endif
