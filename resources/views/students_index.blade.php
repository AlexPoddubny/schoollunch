<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" style="text-align: center">П.І.Б.</th>
                <th scope="col" style="text-align: center">Батьки</th>
                <th scope="col" style="text-align: center">Пільга</th>
                <th scope="col" style="text-align: center">Опції</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>
                        <a href="{{ route('students.show', ['student' => $student->id]) }}">{{$student->fullname}}</a>
                    </td>
                    <td>
                        Не визначено
                    </td>
                    <td>
                        Пільга
                    </td>
                    <td>Опції</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card">
    <div class="card-header">Dashboard</div>
    <br>
    <form method="post" action="{{route('students.add')}}">
        @csrf
        <div class="form-group row">
            <label for="fullname" class="col-md-4 col-form-label text-md-right">{{__('messages.student_name')}}</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="fullname">
            </div>
            <button type="submit" class="btn btn-primary">
                {{__('messages.add')}}
            </button>
        </div>
    </form>
    <br>
    <form action="{{route('students.addmass')}}" method="post">
        @csrf
        <div class="form-group row">
            <label for="textarea" class="col-md-12 col-form-label text-md-center">Додати учнів за списком</label>
        </div>
        <div class="col-md-12">
            <textarea class="form-control" name="list"></textarea>
            <br>
            <button type="submit" class="btn btn-primary btn-block">
                {{__('messages.add')}}
            </button>
        </div>
    </form>
    <br>
</div>
