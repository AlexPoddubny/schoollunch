<form action="{{ route('roles.store') }}" method="post">
    {{ @csrf_field() }}
    <div class="form-group row">
        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('messages.role_name') }}</label>
        <div class="col-md-6">
            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $role->description }}" required autocomplete="description" autofocus disabled>
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.role_type') }}</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name }}" required autocomplete="name" autofocus disabled>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ 'Права:' }}</label>
        <div class="col-md-6 form-group">
            @foreach($perms as $perm)
                <div class="form-check text-left mlr-auto">
                    <input name="{{$role->id}}[]"
                           type="checkbox"
                           class="form-check-input"
                           value="{{$perm->id}}"
                        {{ ($role->hasPermission($perm->name)) ? 'checked' : ''}}>
                    <label class="form-check-label">{{$perm->description}}</label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('messages.save_changes') }}
            </button>
        </div>
    </div>
</form>

