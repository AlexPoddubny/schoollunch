@if(isset($users))
    @if($users->isEmpty())
        <p>Користувача {{$name}} не знайдено</p>
    @else
        <ul class="dropdown-menu" style="display:block; position:relative">
            @foreach($users as $user)
                <li>
                    <a href="#" class="add-user" data-id="{{$user->id}}" data-name="{{$user->getFullName()}}">{{$user->getFullName()}}</a>
                </li>
            @endforeach
        </ul>
    @endif
@endif
