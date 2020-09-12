<div class="card">
    <p>Оберіть обідню перерву, категорію харчування та вкажіть класного керівника</p>
    <form method="POST" action="{{ route('schoolclass.update', ['schoolclass' => $schoolClass->id]) }}">
        @csrf
        {{ method_field('PUT') }}
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.class_name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $schoolClass->name }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="lunchbreak" class="col-md-4 col-form-label text-md-right">{{ __('messages.lunch_break') }}</label>
            <div class="col-md-6">
                <select name="break_id" class="form-control">
                    <option disabled {{($schoolClass->break_id == null) ? 'selected' : ''}}>Оберіть обідню перерву</option>
                    @foreach($schoolClass->school->breakTime as $breakTime)
                        <option value="{{$breakTime->id}}" {{($schoolClass->break_id == $breakTime->id) ? 'selected' : ''}}>{{$breakTime->break_time}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('messages.category') }}</label>
            <div class="col-md-6">
                <select name="category_id" class="form-control">
                    <option disabled {{($schoolClass->category_id == null) ? 'selected' : ''}}>Оберіть категорію харчування</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$schoolClass->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{--<div class="form-group row">
            <input name="teacher_id" id="user-id" type="hidden" value="{{$schoolClass->teacher_id ?? ''}}">
            <label for="teacher" class="col-md-4 col-form-label text-md-right">{{ __('messages.teacher') }}</label>

            <div class="col-md-6">
                <input id="username" type="text" class="form-control @error('teacher') is-invalid @enderror"
                       value="{{ ($schoolClass->teacher_id != null) ? fullname($schoolClass->teacher) : '' }}"
                       autocomplete="teacher" autofocus>
                @error('adminname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Обрати класного керівника</label>
            <div class="col-md-6">
                @livewire('search')
            </div>
        </div>--}}
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.teacher') }}</label>
            <div class="col-md-6">
                {{--            @livewire('search-user')--}}
                <input type="hidden" name="teacher_id" id="user_id">
                <input type="text" class="form-control" name="query" id="user"
                       placeholder="@isset($schoolClass->teacher_id) '' @else Оберіть користувача @endisset"
                       value="@isset($schoolClass->teacher_id) {{$schoolClass->teacher->fullName}} @endisset">
                <div id="result"></div>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('messages.save_changes') }}
                </button>
            </div>
        </div>
        <br>
    </form>
</div>
<br>
<div class="card">
    @include('students_index')
</div>
