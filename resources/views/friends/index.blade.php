@extends('templates.default')

@section('content')
<div class="row">
    <div class="col-lg-6">
    <h4>Your Friends</h4>
    @if (!$friends->count())
<p>You have no friends</p>
@else
    @foreach ($friends as $user)
        @include('user/partials/userblock')
    @endforeach
 @endif

    </div>

    <div class="col-lg-6">
    <h4>Friend Requests</h4>

@if(!$requests->count())
    <p>You have no friend requests</p>
  @else
    @foreach($requests as $user)
        @include('user.partials.userblock')
    @endforeach 
    @endif 
    </div>
</div>
@stop