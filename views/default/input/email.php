<?php
/**
 * Elgg email input
 * Displays an email input field
 *
 * @uses $vars['class'] Additional CSS class
 */

$vars['class'] = elgg_extract_class($vars, 'elgg-input-email');

$defaults = [
	'autocapitalize' => 'off',
	'type' => 'email',
];

$vars = array_merge($defaults, $vars);

echo elgg_format_element('input', $vars);
