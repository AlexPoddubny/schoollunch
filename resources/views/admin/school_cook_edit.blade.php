<form method="POST" action="{{ route('schools.store') }}">
    @csrf
    <input name="id" type="hidden" value="{{$school->id}}">
    <input name="cook_id" id="user-id" type="hidden" value="{{$school->cook_id ?? ''}}">

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
        <label for="adminname" class="col-md-4 col-form-label text-md-right">{{ __('messages.cook_name') }}</label>

        <div class="col-md-6">
            <input id="username" type="text" class="form-control @error('adminname') is-invalid @enderror" name="username"
                   value="{{ ($school->cook_id != null) ? $school->cook->fullName : '' }}"
                   autocomplete="cookname" autofocus>
            @error('adminname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">Обрати технолога шкільного комбінату харчування</label>
        <div class="col-md-6">
            @livewire('search')
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
