<form method="POST" action="{{ route('schools.store') }}">
    @csrf
    <input name="id" type="hidden" value="{{$school->id}}">

    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.school_name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $school->name }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="adminname" class="col-md-4 col-form-label text-md-right">{{ __('messages.admin_name') }}</label>

        <div class="col-md-6">
            <input id="adminname" type="text" class="form-control @error('adminname') is-invalid @enderror" name="adminname"
                   value="{{ ($school->admin_id != null) ? fullname($school->admin) : '' }}"
                   required autocomplete="adminname" autofocus>
            @error('adminname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
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
