<!DOCTYPE html>
<html>
<head>
	<title>Thank you for supporting our Good Works | KidStories</title>
    <meta name="description" content="We really appreciate your contribution, it will go a long way in ensuring the prove better works for our young user. Thank you.">
</head>
<body>
<h3>Dear {{ $user->first_name, $user->last_name }}</h3>
<p>We are glad to inform you that we have recieved your payment of {{($paymentDetails['data']['amount']/100 )}}.</p>
<p>You can now browse all stories that are premium. start here {{ route('stories.index') }}</p>
</body>
</html>