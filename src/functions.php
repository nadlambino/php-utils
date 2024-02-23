<?php

namespace Inspira\Utils;

use Inspira\Contracts\Arrayable;
use Iterator;
use Stringable;

if (!function_exists('class_basename')) {
	function class_basename(string $class): string
	{
		return basename(str_replace('\\', '/', $class));
	}
}

if (!function_exists('set_type')) {
	function set_type(mixed $value, string $type)
	{
		settype($value, $type);

		return $value;
	}
}

if (!function_exists('get_traits')) {
	function get_traits(string $class): array
	{
		$traits = class_uses($class);
		$parent = get_parent_class($class);

		if ($parent !== false) {
			$traits = [...$traits, ...get_traits($parent)];
		}

		return $traits;
	}
}
