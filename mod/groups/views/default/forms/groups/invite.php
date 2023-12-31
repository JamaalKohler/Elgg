<?php
/**
 * Elgg groups invite form
 */

$group = elgg_extract('entity', $vars);
if (!$group instanceof \ElggGroup) {
	return;
}

$friends_count = elgg_count_entities([
	'type' => 'user',
	'relationship' => 'friend',
	'relationship_guid' => elgg_get_logged_in_user_guid(),
]);
if (empty($friends_count)) {
	echo elgg_echo('groups:nofriendsatall');
	return;
}

echo elgg_view_field([
	'#type' => 'hidden',
	'name' => 'forward_url',
	'value' => $group->getURL(),
]);

echo elgg_view_field([
	'#type' => 'hidden',
	'name' => 'group_guid',
	'value' => $group->guid,
]);

echo elgg_view_field([
	'#type' => 'friendspicker',
	'#help' => elgg_echo('groups:invite:friends:help'),
	'name' => 'user_guid',
	'options' => [
		'item_view' => 'livesearch/user/group_invite',
		'group_guid' => $group->guid,
	],
]);

echo elgg_view_field([
	'#type' => 'checkbox',
	'#label' => elgg_echo('groups:invite:resend'),
	'name' => 'resend',
	'value' => 1,
	'switch' => true,
]);

$footer = elgg_view_field([
	'#type' => 'submit',
	'text' => elgg_echo('invite'),
]);

elgg_set_form_footer($footer);
