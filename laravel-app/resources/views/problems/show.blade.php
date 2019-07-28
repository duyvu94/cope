@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Problem Detail')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9">
        <div class="card ">
          <div class="card-header card-header-primary">
            <h4 class="card-title "> {{$problem->name}} </h4>
          </div>
          <div class="card-body">
            <div class="iframe-container d-none d-lg-block">
                <iframe src="{{ asset($problem->pdf_path) }}" >
                  <p>Your browser does not support iframes.</p>
                </iframe>
              </div>
              <div class="col-md-12 d-none d-sm-block d-md-block d-lg-none d-block d-sm-none text-center ml-auto mr-auto">
                <h5>The icons are visible on Desktop mode inside an iframe. Please turn on the Desktop mode!
                </h5>
              </div>
          </div>
        </div>
      </div>

	  <div class ="col-md-3">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title "> Detail </h4>
          </div>
          <div class="card-body">

            <h4>Time limit: <b>{{$problem->time_limit}}</b> ms</h4>
            <h4>Memory limit: <b>{{$problem->memory_limit}}</b> Mb</h4>
            <h4>Tag: </h4>

              
            <button class="btn btn-info btn-block"> My submission</button>  
            
            <button class="btn btn-warning btn-block">All submission</button>

           	<button class="btn btn-success btn-block" onclick="window.location='{{ route('problem.form.submit', $problem->id) }}'" >Submit solution</button>
            
          </div>
        </div>
	  </div>

    </div>
  </div>
</div>

<script>
	
  
</script>
@endsection