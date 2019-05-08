<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
<h3>Dear {{ $user->first_name, $user->last_name }}</h3>
<p>We are glad to inform you that we have recieved your payment of {{($paymentDetails['data']['amount']/100 )}}.</p>
<p>You can now browse all stories that are premium. start here {{ route('stories.index') }}</p>
</body>
</html>