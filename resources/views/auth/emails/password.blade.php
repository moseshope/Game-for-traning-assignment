<h4 style="font-size:18px">Hello <strong>{{$user->name}}</strong></h4>

Click here to reset your password: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
<br/>
<br/>
<p>
  <small>This is an automated message, please do not answer.</small><br/>
  <a href="http://www.story-juice.com">Story Juice</a>
</p>
