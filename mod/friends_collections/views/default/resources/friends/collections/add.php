<?php
/**
 * Create a new collection
 */

$user = elgg_get_page_owner_entity();

elgg_push_breadcrumb(elgg_echo('friends:collections'), elgg_generate_url('collection:access_collection:friends:owner', ['username' => $user->username]));

echo elgg_view_page(elgg_echo('friends:collections:add'), [
	'content' => elgg_view_form('friends/collections/edit', ['sticky_enabled' => true]),
	'filter_id' => 'friends_collections/edit',
]);
