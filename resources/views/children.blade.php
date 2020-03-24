<form method="POST" action="{{ url('home') }}">
    @csrf
    <div class="form-group row">
        <label for="school_id" class="col-md-4 col-form-label text-md-right">{{ __('messages.select_school') }}</label>
        <div class="col-md-6">
            <select name="school_id" class="form-control" id="schools">
                <option disabled selected>Оберіть школу</option>
                @foreach($schools as $school)
                    <option value="{{$school->id}}">{{$school->name}}</option>
                @endforeach
            </select>
        </div>{{--
        <button type="submit" class="btn btn-primary">
            {{__('messages.select')}}
        </button>--}}
    </div>
    <div id="classes_group" hidden>
        <div class="form-group row">
            <label for="class_id" class="col-md-4 col-form-label text-md-right">Оберіть клас</label>
            <div class="col-md-6">
                <select name="class_id" class="form-control" id="classes">
                    <option disabled selected>Оберіть клас</option>
                </select>
            </div>
        </div>
    </div>
</form>
