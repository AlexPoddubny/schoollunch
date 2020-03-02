<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" style="text-align: center">Роль</th>
                <th scope="col" style="text-align: center">Користувачів</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td><a href="{{ route('roles.show', ['role' => $role->id]) }}">{{$role->description}}</a></td>
                    <td style="text-align: center">{{$role->users_count}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
