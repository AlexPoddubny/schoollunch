@if(count($items) > 0)
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" style="text-align: center">Продукт</th>
                <th scope="col" style="text-align: center">Вага брутто</th>
                <th scope="col" style="text-align: center">Вага нетто</th>
                <th scope="col" style="text-align: center">
                    <span class="glyphicon glyphicon-remove"></span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $n => $item)
                <tr>
                    <td>
                        {{$item['name']}}
                    </td>
                    <td style="text-align: center">
                        {{$item['brutto']}}
                    </td>
                    <td style="text-align: center">
                        {{$item['netto']}}
                    </td>
                    <td style="text-align: center">
                        <a href="#">
                            <span class="glyphicon glyphicon-remove text-danger del-product"
                                data-id="{{$n}}"
                                aria-hidden="true">
                            </span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
