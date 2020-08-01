@if($user)
<form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}">
    @csrf
    {{ method_field('PUT') }}

    <div class="form-group row">
        <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('messages.firstname') }}</label>

        <div class="col-md-6">
            <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" required autocomplete="firstname" autofocus>

            @error('firstname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="middlename" class="col-md-4 col-form-label text-md-right">{{ __('messages.middlename') }}</label>

        <div class="col-md-6">
            <input id="middlename" type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" value="{{ $user->middlename }}" required autocomplete="middlename" autofocus>

            @error('middlename')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('messages.lastname') }}</label>

        <div class="col-md-6">
            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user->lastname }}" required autocomplete="lastname" autofocus>

            @error('lastname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('messages.phone') . ': (+38)' }}</label>

        <div class="col-md-6">
            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone">

            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('messages.email') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="sex" class="col-md-4 col-form-label text-md-right">{{ __('messages.sex') }}</label>

        <div class="col-md-6">
            <select name="sex" class="form-control">
                <option value="female" {{ ($user->sex == 'female') ? 'selected' : ''}} > @lang('messages.female')</option>
                <option value="male" {{ ($user->sex == 'male') ? 'selected' : '' }} > @lang('messages.male')</option>
            </select>
            @error('sex')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
            </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ 'Ролі:' }}</label>
        <div class="col-md-6 form-group">
            @foreach($roles as $role)
                <div class="form-check text-left mlr-auto">
                    <input name="roles[]"
                        type="checkbox"
                        class="form-check-input"
                        value="{{$role->id}}"
                        {{ ($user->hasRole($role->name)) ? 'checked' : ''}}>
                    <label class="form-check-label">
                        {{$role->description}}
                        @if($user->hasRole($role->name))
                            @switch($role->name)
                                @case('SchoolAdmin')
                                    <a href="{{ route('school.show', ['school' => $user->school->id]) }}">
                                        {{$user->school->name}}
                                    </a>
                                @break
                                @case('Cook')
                                    <a href="{{ route('school.show', ['school' => $user->cook->id]) }}">
                                        {{$user->cook->name}}
                                    </a>
                                @break
                                @case('ClassTeacher')
                                    <a href="{{route('schoolclass.edit', ['schoolclass' => $user->schoolClass->id])}}">
                                        {{$user->schoolClass->name . ' класу'}}</a>,&nbsp;
                                    <a href="{{ route('school.show', ['school' => $user->schoolClass->school->id]) }}">
                                        {{$user->schoolClass->school->name}}
                                    </a>
                                @break
                            @endswitch
                        @endif
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    {{--<div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('messages.password') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('messages.confirm_password') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>--}}

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('messages.save_changes') }}
            </button>
        </div>
    </div>
</form>
@else
    <a href="{{url()->previous()}}" role="button" class="btn btn-primary">Повернутись назад</a>
@endif
