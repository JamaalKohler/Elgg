<?php
/**
 * Elgg number input
 * Displays a number input field
 *
 * @uses $vars['class'] Additional CSS class
 */

$vars['class'] = elgg_extract_class($vars, 'elgg-input-number');

$defaults = [
	'type' => 'number',
];

$vars = array_merge($defaults, $vars);

echo elgg_format_element('input', $vars);
