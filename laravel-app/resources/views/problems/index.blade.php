@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Problem List')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Problem list</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="problem-table" style="width:100%">
                <thead class=" text-primary">
                  <th>
                    ID
                  </th>
                  <th>
                    Name
                  </th>
                  <th>
                    Tag(s)
                  </th>
                  <th>
                    Difficulty
                  </th>
                  <th>
                    Solved
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

  let problemTable = $('#problem-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('problem.index') }}",
    columns: [
        {data: 'id', name: 'ID', width:"10%", className: 'info-page'},
        {data: 'name', name: 'name', className: 'info-page'},
        {data: 'name', name: 'name', className: 'info-page'},
        {data: 'difficulty', name: 'name', className: 'info-page'},
        {data: 'difficulty', name: 'difficulty', className: 'info-page'},
    ]
  });  

  $('tbody').on('click', '.info-page', function(){
    let data = problemTable.row(this.closest("tr")).data();
    let url = '/problem/' + data.id;
    window.location.replace(url);
  });

});


  
</script>
@endsection