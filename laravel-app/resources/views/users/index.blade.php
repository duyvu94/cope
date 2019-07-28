@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Users') }}</h4>
                <p class="card-category"> {{ __('Here you can manage users') }}</p>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">{{ __('Add user') }}</a>
                  </div>
                </div>
                
                <div class="table-responsive">
                  <table class="table" id="user-table" style="width:100%">
                    <thead class=" text-primary">
                      <th>
                        ID
                      </th>
                      <th>
                        Name
                      </th>
                      <th>
                        Admin
                      </th>
                      <th>
                        Email
                      </th>
                      <th>
                        Action
                      </th>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
        </div>
      </div>
    </div>
  </div>


  <script>
	
  $(document).ready(function() {
  
    let userTable = $('#user-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('user.index') }}",
      columns: [
          {data: 'id', name: 'id', width:"6%", className: 'info-page'},
          {data: 'name', name: 'name', className: 'info-page'},
          {data: 'is_admin', name: 'is_admin', className: 'info-page'},
          {data: 'email', name: 'email', className: 'info-page'},
          {data: 'action', name: 'action', width:"12%", className: 'info-page', orderable: false, searchable: false},
      ]
    });  
  /*
    $('tbody').on('click', '.info-page', function(){
      let data = problemTable.row(this.closest("tr")).data();
      let url = 'Problem/' + data.id;
      window.location.replace('/Problem/' + data.id)
    });
  */
  });
      
  </script>
@endsection