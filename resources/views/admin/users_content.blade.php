<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" style="text-align: center">П.І.Б.</th>
                <th scope="col" style="text-align: center">E-mail</th>
                <th scope="col" style="text-align: center">Телефон</th>
                <th scope="col" style="text-align: center"><span class="glyphicon glyphicon-remove"></span></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}">{{fullname($user)}}</a>
                    </td>
                    <td style="text-align: center">
                        {{$user->email}}
                    </td>
                    <td style="text-align: center">
                        {{$user->phone}}
                    </td>
                    <td style="text-align: center">
                        <a href="#" class="user-delete">
                            <span class="glyphicon glyphicon-remove text-danger"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@if($users->total() > $users->count())
    {{$users->onEachSide(1)->links()}}
@endif
