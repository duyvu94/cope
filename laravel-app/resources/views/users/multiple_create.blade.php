@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('user.store.multi') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add Users') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>

                <div id="emails-field" hidden>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email(s)') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('emails.*') ? ' has-danger' : '' }}"> 
                      <textarea class="form-control{{ $errors->has('emails') ? ' is-invalid' : '' }}" rows="10" id="input-emails"
                        placeholder="{{ __('Emails are separated by spaces, e.g. "abc@csp.com cde@csp.com def@csp.com"') }}"></textarea>
                      @if ($errors->has('emails.*'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('emails.*') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Class') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <select class="custom-select custom-select-sm form-control form-control-sm" id="group-list" name="group_id">
                        @foreach ($groups as $group)
                          <option value={{ $group->id }}>{{$group->text}}</option>    
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Administrator') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <select class="custom-select custom-select-sm form-control form-control-sm" id="group-list" name="is_admin">
                        <option value=0>False</option>    
                        <option value=1>True</option>    
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">{{ __('Default password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                      <input class="form-control" name="password" id="input-password" value=""/>
                      @if ($errors->has('password'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button id='btn-submit' type="submit" class="btn btn-primary">{{ __('Add User(s)') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    var generate_emails = false;
    $('#btn-submit').on('click', function(e){
      if (!generate_emails){
        generate_emails = true;
        e.preventDefault();

        let emailsValue = $('#input-emails').val();
        emailsArray = emailsValue.trimLeft().trimRight().split(/\s+/);
        for (let email in emailsArray){
          $('#emails-field').append('<input name="emails[]"  value="'+ emailsArray[email] +'"/>');
        }
        $(this).trigger('click');
      }
    });
  </script>
@endsection