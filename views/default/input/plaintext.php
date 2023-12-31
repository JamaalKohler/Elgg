<?php
/**
 * Elgg long text input (plaintext)
 * Displays a long text input field that should not be overridden by wysiwyg editors.
 *
 * @uses $vars['value']    The current value, if any
 * @uses $vars['name']     The name of the input field
 * @uses $vars['class']    Additional CSS class
 */

$vars['class'] = elgg_extract_class($vars, 'elgg-input-plaintext');

$defaults = [
	'rows' => '10',
	'cols' => '50',
];

$vars = array_merge($defaults, $vars);

$value = htmlspecialchars(elgg_extract('value', $vars, ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
unset($vars['value']);

echo elgg_format_element('textarea', $vars, $value);
