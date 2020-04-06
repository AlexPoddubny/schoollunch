@if(isset($searchResults))
    @if($searchResults->isEmpty())
        <p>Інгредієнт {{$searchTerm}} не знайдено</p>
    @else
        <ul class="hr">
            @foreach($searchResults as $result)
                <li>
                    <a href="#" data-id="{{$result->url}}" class="add-product" id="title{{$result->url}}">{{$result->title}}</a>
                    {{--<span id="title{{$result->url}}">{{$result->title}}</span>
                    <div><label for="brutto">Brutto:</label><input type="number" step="0.1" name="brutto" class="form-control" id="brutto{{$result->url}}"></div>
                    <div><label for="netto">Netto:</label><input type="number" step="0.1" name="netto" class="form-control" id="netto{{$result->url}}"></div>
                    <a href="#" class="btn btn-primary add-product" role="button" data-id="{{$result->url}}">Додати</a>--}}
                </li>
            @endforeach
        </ul>
    @endif
@endif
