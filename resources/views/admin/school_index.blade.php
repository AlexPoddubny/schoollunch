<div class="card">
    <div class="card-header">Перерви</div>
    <div class="table-responsive">
{{--        <label class="col-form-label"></label>--}}
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">№ перерви</th>
                    <th scope="col" style="text-align: center">Час</th>
                </tr>
            </thead>
            <tbody>
                @foreach($school->breakTime as $breakTime)
                    <tr>
                        <td scope="col" style="text-align: center">{{$breakTime->break_num}}</td>
                        <td scope="col" style="text-align: center">{{$breakTime->break_time}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <form method="post" action="{{route('school.add_break')}}">
        @csrf
        <input name="school_id" type="hidden" value="{{$school->id}}">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <label for="break_num">Номер перерви</label>
                    <input name="break_num" value="1" class="form-control" type="number">
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <label for="begin" class="control-label">Початок</label>
                    <input class="form-control input-group" name="begin" type="time" value="8:45"/>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
                <div class="form-group">
                    <label for="end" class="control-label">Закінчення</label>
                    <input name="end" type="time" value="9:00" class="form-control input-group"/>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-sm-3 col-xs-3">
                <label for="button" class="control-label">&nbsp;</label>
                <div class="form-group">
                    <button type="submit" id="addBreak" class="btn btn-primary">
                        {{__('messages.add_break')}}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="card">
    <div class="card-header">Класи</div>
</div>
