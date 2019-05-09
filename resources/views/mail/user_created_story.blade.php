<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<h3>Dear {{$admin->first_name, $admin->last_name  }}</h3>


<p> {{ $story->user->first_name, $story->user->last_name}}  created a story and is waiting fpr your approval before it can be published. Kindly go through it <a href="{{ route('admin.stories.show',['slug'=>$story->slug]) }}">here</a> </p>

</body>
</html>