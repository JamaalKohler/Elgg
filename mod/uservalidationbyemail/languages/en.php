<?php
/**
 * Translation file
 *
 * Note: don't change the return array to short notation because Transifex can't handle those during `tx push -s`
 */

return array(
	'email:validate:subject' => "%s please confirm your email address for %s!",
	'email:validate:body' => "Before you can start using %s, you must confirm your email address.

Please confirm your email address by clicking on the link below:

%s

If you can't click on the link, copy and paste it to your browser manually.",
	'email:confirm:success' => "You have confirmed your email address!",
	'email:confirm:fail' => "Your email address could not be verified...",

	'uservalidationbyemail:emailsent' => "Email sent to <em>%s</em>",
	'uservalidationbyemail:registerok' => "To activate your account, please confirm your email address by clicking on the link we just sent you.",
	'uservalidationbyemail:change_email' => "Resend validation email",
	'uservalidationbyemail:change_email:info' => "Your account is not validated so the login attempt failed. You can request a new validation link or update the email address related to your account.",

	'uservalidationbyemail:admin:resend_validation' => 'Resend validation',
	'uservalidationbyemail:confirm_resend_validation' => 'Resend validation email to %s?',
	'uservalidationbyemail:confirm_resend_validation_checked' => 'Resend validation to checked users?',
	
	'uservalidationbyemail:errors:unknown_users' => 'Unknown users',
	'uservalidationbyemail:errors:could_not_resend_validation' => 'Could not resend validation request.',
	'uservalidationbyemail:errors:could_not_resend_validations' => 'Could not resend all validation requests to checked users.',

	'uservalidationbyemail:messages:resent_validation' => 'Validation request resent.',
	'uservalidationbyemail:messages:resent_validations' => 'Validation requests resent to all checked users.',
);
