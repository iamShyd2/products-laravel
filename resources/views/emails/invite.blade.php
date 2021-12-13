<p>Hi {{ $invite->user->name }},</p>
<p>You've been invited as a user to sign up at WashMan Laundry.</p>
<a href="{{ route('users.accept', ['token' => $invite->token]) }}">Click here</a> to activate!
