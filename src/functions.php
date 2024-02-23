<?php

namespace Inspira\Utils;

use Inspira\Contracts\Arrayable;
use Iterator;
use Stringable;

function class_basename(string $class): string
{
	return basename(str_replace('\\', '/', $class));
}

function set_type(mixed $value, string $type)
{
	settype($value, $type);

	return $value;
}

function get_traits(string $class, bool $recursive = true): array
{
	$traits = class_uses($class);
	$parent = get_parent_class($class);

	if ($recursive === true && $parent !== false) {
		$traits = [...$traits, ...get_traits($parent)];
	}

	return $traits;
}
