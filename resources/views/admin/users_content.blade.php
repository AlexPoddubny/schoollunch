<div class="table-responsive">
    <table class="table table-hover" id="user-table">
        <thead>
            <tr>
                <th scope="col" style="text-align: center">id</th>
                <th scope="col" style="text-align: center">Прізвище</th>
{{--                <th scope="col" style="text-align: center">П.І.Б.</th>--}}
                <th scope="col" style="text-align: center">Ім'я</th>
                <th scope="col" style="text-align: center">По батькові</th>
                <th scope="col" style="text-align: center">E-mail</th>
                <th scope="col" style="text-align: center">Телефон</th>
                <th scope="col" style="text-align: center">Зареєстровано:</th>
                <th scope="col" style="text-align: center">Підтверджено:</th>
                <th scope="col" style="text-align: center">Дії</th>
{{--                <th scope="col" style="text-align: center"><span class="glyphicon glyphicon-remove"></span></th>--}}
            </tr>
        </thead>
        {{--
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}">{{fullname($user)}}</a>
                    </td>
                    <td style="text-align: center">
                        {{$user->email}}
                    </td>
                    <td style="text-align: center">
                        {{$user->phone}}
                    </td>
                    <td style="text-align: center">
                        <a href="#" class="delete" data-model="users" data-id="{{$user->id}}">
                            <span class="glyphicon glyphicon-remove text-danger"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        --}}
    </table>
</div>
{{--@if($users->total() > $users->count())
    {{$users->onEachSide(1)->links()}}
@endif--}}
{{--@push('scripts')
    <script>
		$(function() {
			$('#user-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: '{!! route('datatables.users') !!}',
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'lastname', name: 'lastname' },
					{ data: 'firstname', name: 'firstname' },
					{ data: 'middlename', name: 'middlename' },
					{ data: 'email', name: 'email'},
					{ data: 'phone', name: 'phone'},
					// { data: 'created_at', name: 'created_at' },
					// { data: 'updated_at', name: 'updated_at' }
				]
			});
		});
    </script>
@endpush--}}
