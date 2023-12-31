<?php

namespace Elgg\Amd;

/**
 * This filter adds AMD names to anonymous AMD modules defined in views.
 *
 * @since 1.9
 * @internal
 */
class ViewFilter {
	
	/**
	 * Given the view name, returns the AMD name.
	 *
	 * @param string $name The name of the view (e.g., 'elgg/module.js')
	 *
	 * @return string The AMD name (e.g., 'elgg/module'), or blank for no AMD name.
	 */
	private function getAmdName($name) {
		if (preg_match('~^(js/)?(.+)\\.js\\z~', $name, $m)) {
			// "js/foo/bar.js" or "foo/bar.js"
			return $m[2];
		}

		// must be in "js/" dir
		if (!str_starts_with($name, 'js/')) {
			return '';
		}
		
		$name = substr($name, 3);

		// Don't allow extension. We matched ".js" above
		if (pathinfo($name, PATHINFO_EXTENSION) !== null) {
			return '';
		}

		// "foo/bar"
		return $name;
	}
	
	/**
	 * Inserts the AMD name into `$content` and returns the new value.
	 *
	 * @param string $viewName The name of the view.
	 * @param string $content  The output of the view to be filtered.
	 *
	 * @return string The new content with the AMD name inserted, if applicable.
	 */
	public function filter($viewName, $content) {
		$amdName = $this->getAmdName($viewName);
		
		if (!empty($amdName)) {
			$content = preg_replace('/^(\s*)define\(([^\'"])/m', "\${1}define(\"$amdName\", \$2", $content, 1);
		}
		
		return $content;
	}
}
