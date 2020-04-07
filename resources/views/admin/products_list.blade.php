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
                    <input type="hidden" name="product[{{$n}}][product_id]" value="{{$item->id}}">{{$item->name}}
                </td>
                <td style="text-align: center">
                    <input type="number" step="0.1" name="product[{{$n}}][brutto]" class="form-control">
                </td>
                <td style="text-align: center">
                    <input type="number" step="0.1" name="product[{{$n}}][netto]" class="form-control">
                </td>
                <td style="text-align: center">
                    <span class="glyphicon glyphicon-remove text-danger del-product"
                          data-id="{{$item->id}}"
                          aria-hidden="true">
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
