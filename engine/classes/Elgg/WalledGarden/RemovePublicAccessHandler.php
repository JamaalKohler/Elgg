<?php

namespace Elgg\WalledGarden;

/**
 * Remove public access for walled garden
 *
 * @since 4.0
 */
class RemovePublicAccessHandler {
	
	/**
	 * Remove public access for walled gardens
	 *
	 * @param \Elgg\Event $event 'access:collections:write', 'all'
	 *
	 * @return array|void
	 */
	public function __invoke(\Elgg\Event $event) {
		if (!_elgg_services()->config->walled_garden) {
			return;
		}
	
		$accesses = $event->getValue();
		if (isset($accesses[ACCESS_PUBLIC])) {
			unset($accesses[ACCESS_PUBLIC]);
		}
		
		return $accesses;
	}
}
