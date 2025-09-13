<div class="col-lg-2 col-sm-2 col-md-2 text-center">
	<ul class="list-group">
		<li class="list-group-item">
			{{ @Auth::user()->first_name == "" ? config('constants.empty') : @Auth::user()->first_name }} {{ @Auth::user()->last_name == "" ? config('constants.empty') : @Auth::user()->last_name }}
		</li>
		<li class="list-group-item">
			<!--Logout -->	
			<a class="btn btn-success" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
				Logout
			</a>
			<form action="logout" name="logout" id="logout-form" method="post">
			</form>
		</li>
	</ul>
</div>