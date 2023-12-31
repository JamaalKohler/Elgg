<?php

echo elgg_view_field([
	'#type' => 'search',
	'name' => 'member_query',
	'value' => get_input('member_query'),
	'required' => true,
	'placeholder' => elgg_echo('members:search'),
	'aria-label' => elgg_echo('members:search'), // because we don't use #label
]);

$footer = elgg_view_field([
	'#type' => 'submit',
	'text' => elgg_echo('search'),
]);

$footer .= elgg_format_element('p', [
	'class' => 'elgg-text-help',
], elgg_echo('members:total', [elgg_count_entities(['type' => 'user'])]));

elgg_set_form_footer($footer);
