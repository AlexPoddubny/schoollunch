<form action="{{route($route)}}" method="post">
    @csrf
    <div class="form-group row">
        <label for="school" class="col-md-4 col-form-label text-md-right">{{__('messages.select_school')}}</label>
        <div class="col-md-6">
            <select name="school" class="form-control">
                @foreach($schools as $school)
                    <option value="{{$school->id}}">{{$school->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            {{__('messages.select')}}
        </button>
    </div>
</form>
