@extends('layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="row">
				  <div class="col-sm-2">
				  		<ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
	  						<li><a href="{{ route('chat') }}">Chat</a></li>
	  						<li><a href="javascript:void(0)">Videochat</a></li>
						</ul>
				  </div>
				  <div class="col-sm-10">
				  	@yield('contentcomunity')
				  </div>
				</div>
            </div>
        </div>
@endsection