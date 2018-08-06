@extends('templates.default')

@section('content')
<h3>Sign up</h3>
<div class="row">
<div class="col-md-4">
<form method="post" action="{{ route('auth.signup') }}" class="form-vertical" role="form">
                                    
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">Your email address</label> 
                <input id="email" type="text" class="form-control" name="email" 
                  value="{{ Request::old('email') ?: '' }}">                                        
                     @if ($errors->has('email'))
                     <span class="help-block">{{ $errors->first('email') }}</span>
                     @endif
         </div>
                           
                                
        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
            <label for="username" class="control-label">Your username</label> 
         <input type="text" class="form-control" name="username" id="username" value="{{ Request::old('username') ?: '' }}">                                        
                    @if ($errors->has('username'))
            <span class="help-block">{{ $errors->first('username') }}</span>
                 @endif
        </div>
                           

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="control-label">Your password</label> 
             <input id="login-password" type="password" class="form-control" name="password">                                        
             @if ($errors->has('password'))
            <span class="help-block">{{ $errors->first('password') }}</span>
          @endif
        </div>

        <div class="form-group">
                     
            
             <button type="submit" class="btn btn-success">Signup</button>
           
        </div>
          <input type="hidden" name="_token" value="{{ Session::token() }}">  
        </form>
        
        </div>
</div>

@stop