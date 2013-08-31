<div id="login_form">
	<h1>Login, Citizen!</h1>
	<h3>Login failed!</h3>
	<?php
		echo form_open('login/validate');
		echo form_input('user_name', set_value('user_name','In-game nick'));
		echo form_input('user_okey', set_value('user_okey','External ID'));
		echo form_input('user_skey', set_value('user_skey','Secure Oval Office ID'));
		echo form_submit('submit', 'Enter');
		echo anchor('http://www.zombinoia.com?ref=SinSniper', 'Create Account on Zombinoia');
	?>
</div>