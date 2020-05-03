<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col" style="text-align: center">Тип страви</th>
        <th scope="col" style="text-align: center">Назва страви</th>
        <th scope="col" style="text-align: center">Вага страви</th>
        <th scope="col" style="text-align: center">
            <span class="glyphicon glyphicon-remove"></span>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $n => $item)
        <tr>
            <td style="text-align: center">
                {{$item['type']}}
            </td>
            <td style="text-align: center">
                {{$item['name']}}
            </td>
            <td style="text-align: center">
                {{$item['size']}} гр.
            </td>
            <td style="text-align: center">
                <span class="glyphicon glyphicon-remove text-danger del-course"
                      data-id="{{$n}}"
                      aria-hidden="true">
                </span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
