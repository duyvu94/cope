@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Submit solution')])

@section('content')
<div class="content">
  <div class="container-fluid">
    
      <form class="row" method="POST" action="{{ route("submission.upload") }}" >

        <div class="col-md-9">
          <div class="card ">
            <div class="card-header card-header-primary">
              <h4 class="card-title "> {{$problem->name}} - Code</h4>
            </div>
            <div class="card-body">
              <div id="code-editor" style="height : 70vh"></div>
            </div>
          </div>
        </div>

        <div class ="col-md-3">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title "> Choose the compiler </h4>
            </div>
            <div class="card-body">
              <select class="custom-select custom-select-sm form-control form-control-sm" id="compiler-list">
                <option value="c_cpp">C++</option>
                <option value="pascal">FreePascal</option>
              </select>
              
              <button type="submit" class="btn btn-success btn-block" >Submit</button>
              
            </div>
          </div>
        </div>

      </form>
    
  </div>
</div>

<script>
  var editor = ace.edit("code-editor");
  editor.setTheme("ace/theme/xcode");
  editor.session.setMode("ace/mode/c_cpp");
  editor.setFontSize(14);

  $( '#compiler-list' ).change(function() {
    editor.session.setMode('ace/mode/' + $(this).val());
  });
  
</script>
@endsection