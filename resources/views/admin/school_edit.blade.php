<form method="POST" action="{{ route('schools.update', ['school' => $school->id]) }}">
    @csrf
    {{ method_field('PUT') }}
{{--    <input name="id" type="hidden" value="{{$school->id}}">--}}
    <input name="type" type="hidden" value="{{$type}}">
    <input name="user_id" id="user-id" type="hidden" value="{{isset($user) ? $user->id : ''}}">

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
{{--
    <div class="form-group row">
        <label for="adminname" class="col-md-4 col-form-label text-md-right">{{ __('messages.' . $type . '_name') }}:</label>

        <div class="col-md-6">
            <label for="adminname" id="username" class="col-md-6 col-form-label text-md-left">{{ isset($user) ? fullname($user) : 'Не призначено' }}</label>
            --}}{{--<input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                   value=""
                   autocomplete="username" autofocus disabled>
            --}}{{--
        </div>
    </div>
    --}}
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{$type == 'admin' ? 'Адміністратор' : 'Технолог шкільного комбінату харчування'}}</label>
        <div class="col-md-6">
{{--            @livewire('search-user')--}}
            <input type="hidden" name="user" id="user_id">
            <input type="text" class="form-control" name="query" id="user" placeholder="@isset($user) '' @else Оберіть користувача @endisset" value="@isset($user) {{fullname($user)}} @endisset">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4"></div>
        <div class="form-group row col-md-6 text-md-left" id="result"></div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('messages.save_changes') }}
            </button>
        </div>
    </div>
</form>
