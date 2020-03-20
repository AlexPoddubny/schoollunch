
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
