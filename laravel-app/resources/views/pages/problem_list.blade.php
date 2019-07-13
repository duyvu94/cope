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
	let problemList = $('#problem-table').DataTable({
		processing: true,
    serverSide: true,
    ajax: "{{ route('problem.table') }}",
    columns: [
        {data: 'id', name: 'ID', width:"10%"},
        {data: 'name', name: 'name'},
        {data: 'name', name: 'name'},
        {data: 'difficulty', name: 'name'},
        {data: 'difficulty', name: 'difficulty'},
    ]
	});
  
</script>
@endsection