@if(count($schools) != 0)
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">Школа</th>
                    <th scope="col" style="text-align: center">Статус</th>
                </tr>
            </thead>
            <tbody>
            @foreach($schools as $school)
                <tr>
                    <td>
                        <a href="{{ route('schools.edit', ['school' => $school->id]) }}">{{$school->name}}</a>
                    </td>
                    <td style="text-align: center">
                        @if($school->admin_id != null)
                            Підключено
                        @else
                            <a class="btn btn-primary" href="{{route('schools.edit', ['school' => $school->id])}}" role="button">{{__('messages.school_admin_assign')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif
<br>
<form method="post" action="{{route('schools.store')}}">
    <div>
        <div class="form-group row">
            <label for="schoolname" class="col-md-4 col-form-label text-md-right">{{__('messages.school_name')}}</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="schoolname">
            </div>
            <button type="submit" class="btn btn-primary">
                {{__('messages.add_school')}}
            </button>
        </div>
    </div>
</form>
<br>
<form method="post" action="{{route('schools.generate')}}">
    <div class="card">
        <div class="card-header">Додати школи пакетом</div>
        <div class="card-body">
            <div class="form-group row">
                <label for="firstnum" class="col-md-4 col-form-label text-md-right">{{__('messages.first_school_number')}}</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="firstnum" value="1">
                </div>
            </div>
            <div class="form-group row">
                <label for="lastnum" class="col-md-4 col-form-label text-md-right">{{__('messages.last_school_number')}}</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="lastnum">
                </div>
            </div>
            <div class="form-group row">
                <label for="schoolname" class="col-md-4 col-form-label text-md-right">{{__('messages.school_name_template')}}</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="schoolname">
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
