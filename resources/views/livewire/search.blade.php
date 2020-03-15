<div>
    <input type="text" wire:model="searchTerm" class="form-control"/>
    <ul class="list-group search">
        @foreach($users as $user)
            <li class="list-group-item">
                <a href="#" class="add-user" data-id="{{$user->id}}" data-name="{{fullname($user)}}">{{fullname($user)}}</a>
            </li>
        @endforeach
    </ul>
</div>
