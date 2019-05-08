<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
<h3>Dear {{ $user->first_name, $user->last_name }}</h3>
<p>We are glad to inform you that we have gone through your story and we have seen that it meets our standards hence we have published it.</p>
<p>You can find it  <a href="{{ route('story.show',['id'=>$story->slug]) }}"> here </a></p>
</body>
</html>