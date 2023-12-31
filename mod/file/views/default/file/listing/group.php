<?php
/**
 * List all group files
 *
 * Note: this view has a corresponding view in the rss view type, changes should be reflected
 *
 * @uses $vars['entity'] the group to list for
 */

$container = elgg_extract('entity', $vars);

file_register_toggle();

// List files
echo elgg_list_entities([
	'type' => 'object',
	'subtype' => 'file',
	'container_guid' => $container->guid,
	'no_results' => elgg_echo('file:none'),
	'distinct' => false,
]);
