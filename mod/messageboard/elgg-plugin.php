<?php

require_once(__DIR__ . '/lib/functions.php');

return [
	'plugin' => [
		'name' => 'Message Board',
		'activate_on_install' => true,
	],
	'actions' => [
		'messageboard/add' => [],
	],
	'routes' => [
		'collection:annotation:messageboard:owner' => [
			'path' => '/messageboard/owner/{username}',
			'resource' => 'messageboard/owner',
			'middleware' => [
				\Elgg\Router\Middleware\UserPageOwnerGatekeeper::class,
			],
		],
		'collection:annotation:messageboard:history' => [
			'path' => '/messageboard/owner/{username}/history/{history_username}',
			'resource' => 'messageboard/owner',
			'middleware' => [
				\Elgg\Router\Middleware\UserPageOwnerGatekeeper::class,
			],
		],
	],
	'events' => [
		'entity:url' => [
			'object' => [
				'Elgg\MessageBoard\Widgets::widgetURL' => [],
			],
		],
	],
	'widgets' => [
		'messageboard' => [
			'context' => ['profile'],
		],
	],
];
