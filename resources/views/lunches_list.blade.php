@foreach($lunches as $lunch)
    <option value="{{$lunch->id}}">Комплекс № {{$lunch->number}}</option>
@endforeach
