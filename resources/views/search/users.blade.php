@if(isset($users))
    @if($users->isEmpty())
        <p>Користувача {{$name}} не знайдено</p>
    @else
        <ul class="list-group search">
            @foreach($users as $user)
                <li class="list-group-item">
                    <a href="#" class="add-user" data-id="{{$user->id}}" data-name="{{fullname($user)}}">{{fullname($user)}}</a>
                </li>
            @endforeach
        </ul>
    @endif
@endif
