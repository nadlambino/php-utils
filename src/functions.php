<?php

namespace Inspira\Utils;

use Inspira\Contracts\Arrayable;
use Iterator;
use Stringable;

/**
 * Get the base class name of a class.
 *
 * @param string $class
 * @return string
 */
function class_basename(string $class): string
{
	return basename(str_replace('\\', '/', $class));
}

/**
 * Set the type of variable.
 *
 * @param mixed $value
 * @param string $type
 * @return mixed
 */
function set_type(mixed $value, string $type): mixed
{
	settype($value, $type);

	return $value;
}

/**
 * Get the traits of a class.
 *
 * @param string $class
 * @param bool $recursive
 * @return array
 */
function get_traits(string $class, bool $recursive = true): array
{
	$traits = class_uses($class);
	$parent = get_parent_class($class);

	if ($recursive === true && $parent !== false) {
		$traits = [...$traits, ...get_traits($parent)];
	}

	return $traits;
}
