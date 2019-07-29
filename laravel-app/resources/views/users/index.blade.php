@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{ csrf_field() }}
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
                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">{{ __('Add an user') }}</a>
                    <a href="{{ route('user.create.multi') }}" class="btn btn-sm btn-primary">{{ __('Add multiple users') }}</a>
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
                        Email
                      </th>
                      <th>
                        Admin
                      </th>
                      <th>
                        Class
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
          {data: 'id', name: 'id', width:"6%"},
          {data: 'name', name: 'name'},
          {data: 'email', name: 'email'},
          {data: 'is_admin', name: 'is_admin'},
          {data: 'group', name: 'group'},
          {data: 'action', name: 'action', width:"100px", orderable: false, searchable: false},
      ]
    });  
  
    $('tbody').on('click', '.btn-profile', function(){
      window.location.replace('/profile')
    });

    $('tbody').on('click', '.btn-edit', function(){
      let data = userTable.row(this.closest("tr")).data();
      
    });

    $('tbody').on('click', '.btn-delete', function(){
      let data = userTable.row(this.closest("tr")).data();

      if (confirm("Are you sure you want to delete this user?")){
        $.ajax({
          url: $(this).attr('href'),
          type: 'GET',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        }).done(function($result){
          if ($result == "OK")
            showNotification('success', 'The user has been deleted successfully');
          else
            showNotification('danger', 'The user has been deleted unsuccessfully');

          userTable.ajax.reload();
        });
      }
      
      
    });
  
  });
      
  </script>
@endsection