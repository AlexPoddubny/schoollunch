<div>
    <input type="text" wire:model="searchTerm" class="form-control"/>
    <ul>
        @foreach($users as $user)
            <li>
                <p>
                    {{fullname($user)}}
                </p>
            </li>
        @endforeach
    </ul>
</div>
