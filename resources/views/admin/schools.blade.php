@if(count($schools) != 0)
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">Школа</th>
                    <th scope="col" style="text-align: center">{{__('messages.admin_name')}}</th>
                    <th scope="col" style="text-align: center">{{__('messages.cook_name')}}</th>
                    <th scope="col" style="text-align: center">Статус</th>
                </tr>
            </thead>
            <tbody>
            @foreach($schools as $school)
                <tr>
                    <td>
                        <a href="{{ route('school.show', ['school' => $school->id]) }}">{{$school->name}}</a>
                    </td>
                    <!-- School Admin Assign -->
                    <td style="text-align: center">
                        @if($school->admin_id)
                            <a href="{{ route('users.show', ['user' => $school->admin->id]) }}">
                                {{$school->admin->fullName}}
                            </a>
                            <a href="{{route('schools.edit.type', ['school' => $school->id, 'type' => 'admin'])}}">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="{{route('schools.delete.type', ['school' => $school->id, 'type' => 'admin'])}}">
                                <span class="glyphicon glyphicon-remove text-danger"></span>
                            </a>
                        @else
                            <a class="btn btn-primary" href="{{route('schools.edit.type', ['school' => $school->id, 'type' => 'admin'])}}" role="button">{{__('messages.assign')}}</a>
                        @endif
                    </td>
                    <!-- School Cook Assign -->
                    <td style="text-align: center">
                        @if($school->cook_id)
                            <a href="{{ route('users.show', ['user' => $school->cook->id]) }} "target="_blank">
                                {{$school->cook->fullName}}
                            </a>
                            <a href="{{route('schools.edit.type', ['school' => $school->id, 'type' => 'cook'])}}">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="{{route('schools.delete.type', ['school' => $school->id, 'type' => 'cook'])}}">
                                <span class="glyphicon glyphicon-remove text-danger"></span>
                            </a>
                        @else
                            <a class="btn btn-primary" href="{{route('schools.edit.type', ['school' => $school->id, 'type' => 'cook'])}}" role="button">{{__('messages.assign')}}</a>
                        @endif
                    </td>
                    <td style="text-align: center">
                        <form action="{{route('schools.destroy', ['school' => $school->id])}}" method="post">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">
                                {{__('messages.delete')}}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif
<br>
<form method="post" action="{{route('schools.store')}}">
    @csrf
    <div class="form-group row">
        <label for="schoolname" class="col-md-4 col-form-label text-md-right">{{__('messages.school_name')}}</label>
        <div class="col-md-4">
            <input type="text" class="form-control @error('schoolname') is-invalid @enderror" name="schoolname">
            @error('schoolname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            {{__('messages.add_school')}}
        </button>
    </div>
</form>
<br>
<form method="post" action="{{route('schools.generate')}}">
    @csrf
    <div class="card">
        <div class="card-header">Додати школи пакетом</div>
        <div class="card-body">
            <div class="form-group row">
                <label for="firstnum" class="col-md-4 col-form-label text-md-right">{{__('messages.first_school_number')}}</label>
                <div class="col-md-4">
                    <input type="number" class="form-control @error('lastnum') is-invalid @enderror" name="firstnum" value="{{old('firstnum') ?? 1}}" min="1">
                    @error('firstnum')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="lastnum" class="col-md-4 col-form-label text-md-right">{{__('messages.last_school_number')}}</label>
                <div class="col-md-4">
                    <input type="number" class="form-control @error('lastnum') is-invalid @enderror" name="lastnum" min="1" value="{{old('lastnum')}}">
                    @error('lastnum')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="schoolsname" class="col-md-4 col-form-label text-md-right">{{__('messages.school_name_template')}}</label>
                <div class="col-md-4">
                    <input type="text" class="form-control @error('schoolsname') is-invalid @enderror" name="schoolsname" value="{{old('schoolsname')}}">
                    @error('schoolsname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('messages.generate') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<br>
@if(count($schools) == 0)
    <a class="btn btn-primary" href="{{route('schools.import')}}" role="button">{{__('messages.schools_import')}}</a>
@endif
