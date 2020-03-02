<form action="{{ route('roles.store') }}" method="post">
    {{ @csrf_field() }}
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <td>Назва ролі</td>
                <td>{{$role->description}}</td>
            </tr>
            <tr>
                <td>Тип ролі</td>
                <td>{{$role->name}}</td>
            </tr>
            @foreach($perms as $perm)
                <tr>
                    <td colspan="2">
                        <input name="{{$role->id}}[]"
                            type="checkbox"
                            class="form-check-input"
                            value="{{$perm->id}}"
                            {{ ($role->hasPermission($perm->name)) ? 'checked' : ''}}
                        > {{$perm->description}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <input class="btn .btn-block" type="submit" value="Зберегти" />
</form>
