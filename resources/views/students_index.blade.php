@if(count($students) > 0 )
    <div class="card">
        <div class="card-header">Учні класу</div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center">П.І.Б.</th>
                        <th scope="col" style="text-align: center">Батьки</th>
                        <th scope="col" style="text-align: center">Пільгове харчування</th>
                        <th scope="col" style="text-align: center">
                            <span class="glyphicon glyphicon-remove"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>
                                <a href="{{ route('students.show', ['student' => $student->id]) }}">{{$student->fullname}}</a>
                            </td>
                            <td style="text-align: center">
                                @if(count($student->parent) > 0)
                                    @foreach($student->parent as $parent)
                                        <p>
                                            {{$parent->fullName}}
                                            @if(!$parent->pivot->confirmed_at)
                                                <a href="{{route('students.confirm', [
                                                    'student' => $student->id,
                                                    'parent' => $parent->id
                                                    ])}}">Підтвердити</a>
                                            @endif
                                        </p>
                                    @endforeach
                                @endif
                            </td>
                            <td style="text-align: center">
                                {{$student->privilege ? 'Так' : 'Ні'}}
                            </td>
                            <td style="text-align: center">
                                <form id="delete{{$student->id}}" action="{{route('students.destroy', ['student' => $student->id])}}" method="post">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <a href="javascript:{}" onclick="document.getElementById('delete{{$student->id}}').submit();">
                                        <span class="glyphicon glyphicon-remove text-danger"></span>
                                    </a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
<div class="card">
    <div class="card-header">Додавання учнів</div>
    <p>Додайте учнів класу згідно класного журналу</p>
    <form method="post" action="{{route($route)}}">
        @csrf
        <div class="form-group row">
            <label for="fullname" class="col-md-4 col-form-label text-md-right">{{__('messages.student_name')}}</label>
            <div class="col-md-4">
                <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname">
                <input type="hidden" name="class" value="{{$schoolClass->id}}">
                @error('fullname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                {{__('messages.add')}}
            </button>
        </div>
        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="privilege" id="privilege" {{ old('privilege') ? 'checked' : '' }}>

                    <label class="form-check-label" for="privilege">
                        Пільгове харчування
                    </label>
                </div>
            </div>
        </div>
    </form>
    <br>
    <form action="{{route($route)}}" method="post">
        @csrf
        <div class="form-group row">
            <label for="textarea" class="col-md-12 col-form-label text-md-center">Додати учнів за списком</label>
        </div>
        <div class="col-md-12">
            <input type="hidden" name="class" value="{{$schoolClass->id}}">
            <textarea class="form-control @error('list') is-invalid @enderror" name="list"></textarea>
            @error('list')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br>
            <button type="submit" class="btn btn-primary btn-block">
                {{__('messages.add')}}
            </button>
        </div>
    </form>
    <br>
</div>
