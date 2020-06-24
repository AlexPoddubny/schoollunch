@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{!! $navigation !!}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {!!$content!!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
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
@endpush
