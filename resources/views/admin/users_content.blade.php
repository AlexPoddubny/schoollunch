<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" style="text-align: center">П.І.Б.</th>
                <th scope="col" style="text-align: center">E-mail</th>
                <th scope="col" style="text-align: center">Телефон</th>
                <th scope="col" style="text-align: center">Опції</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}">{{fullname($user)}}</a>
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        {{$user->phone}}
                    </td>
                    <td>Опції</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@if($users->total() > $users->count())
    {{$users->onEachSide(1)->links()}}
@endif
