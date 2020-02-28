<form action="{{ route('permissions.store') }}" method="post">
    {{ @csrf_field() }}
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">Дозвіл</th>
                    @foreach($roles as $role)
                        <th scope="col" style="text-align: center">{{$role->description}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($perms as $perm)
                    <tr>
                        <td>{{$perm->description}}</td>
                        @foreach($roles as $role)
                            <td  style="text-align: center">
                                <input name="{{$role->id}}[]"
                                       type="checkbox"
                                       class="form-check-input"
                                       value="{{$perm->id}}"
                                        {{ ($role->hasPermission($perm->name)) ? 'checked' : ''}}
                                >
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <input class="btn .btn-block" type="submit" value="Зберегти" />
</form>
