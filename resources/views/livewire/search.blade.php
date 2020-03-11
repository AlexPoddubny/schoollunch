<div>
    <input type="text" wire:model="searchTerm" class="form-control"/>
    <ul class="list-group">
        @foreach($users as $user)
            <li class="list-group-item">
                <a href="#" onclick="alert('Clicked!')">{{fullname($user)}}</a>
            </li>
        @endforeach
    </ul>
</div>
