<div class="panel panel-default">
	<div class="panel-heading">
		{{ $reply->created_at->diffForHumans() }}
		<a href="#">{{ $reply->author->name }}</a> said:
	</div>
	<div class="panel-body">
		{{ $reply->body }}
	</div>
</div>