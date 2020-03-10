@if($users)
    <ul>
        @foreach($users as $user)
            <li>
                {{fullname($user)}}
            </li>
        @endforeach
    </ul>
@endif
