<?php
/**
 * Topic save action
 */

$title = elgg_get_title_input();
$desc = get_input('description');
$status = get_input('status', 'open');
$access_id = get_input('access_id');
$container_guid = (int) get_input('container_guid');
$guid = (int) get_input('topic_guid');
$tags = (string) get_input('tags');

// validation of inputs
if (!$title || !$desc) {
	return elgg_error_response(elgg_echo('discussion:error:missing'));
}

$container = get_entity($container_guid);
if (!$container || !$container->canWriteToContainer(0, 'object', 'discussion')) {
	return elgg_error_response(elgg_echo('discussion:error:permissions'));
}

if ($container instanceof \ElggGroup && $access_id === null) {
	// access is null when a group is selected from the container_guid select
	$acl = $container->getOwnedAccessCollection('group_acl');
	if ($acl instanceof \ElggAccessCollection) {
		$access_id = $acl->getID();
	}
}

// sanitize access id
$access_id = (int) $access_id;

// check whether this is a new topic or an edit
$new_topic = !($guid > 0);

if ($new_topic) {
	$topic = new ElggDiscussion();
} else {
	// load original file object
	$topic = get_entity($guid);
	if (!$topic instanceof ElggDiscussion || !$topic->canEdit()) {
		return elgg_error_response(elgg_echo('discussion:topic:notfound'));
	}
}

$topic->title = $title;
$topic->description = $desc;
$topic->status = $status;
$topic->access_id = $access_id;
$topic->container_guid = $container_guid;

$topic->tags = elgg_string_to_array($tags);

if (!$topic->save()) {
	return elgg_error_response(elgg_echo('discussion:error:notsaved'));
}

// handle results differently for new topics and topic edits
if (!$new_topic) {
	return elgg_ok_response('', elgg_echo('discussion:topic:updated'), $topic->getURL());
}

elgg_create_river_item([
	'action_type' => 'create',
	'object_guid' => $topic->guid,
	'target_guid' => $container_guid,
]);

return elgg_ok_response('', elgg_echo('discussion:topic:created'), $topic->getURL());
