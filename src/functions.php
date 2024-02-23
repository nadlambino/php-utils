<?php

namespace Inspira\Utils;

use Inspira\Contracts\Arrayable;
use Iterator;
use Stringable;

if (!function_exists('stringable')) {
	function stringable(mixed $data): bool
	{
		return is_scalar($data) || $data instanceof Stringable || is_null($data);
	}
}

if (!function_exists('arrayable')) {
	function arrayable(mixed $data): bool
	{
		return is_array($data) || $data instanceof Iterator || $data instanceof Arrayable;
	}
}

if (!function_exists('flatten')) {
	function flatten(array $array): array
	{
		$result = [];
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$result += flatten($value);
				continue;
			}

			$result[$key] = $value;
		}

		return $result;
	}
}

if (!function_exists('trimplode')) {
	function trimplode(string $glue, array $array): string
	{
		return trim(implode($glue, $array), $glue);
	}
}

if (!function_exists('is_multi_array')) {
	function is_multi_array(array $array): bool
	{
		return count($array) > 0 && array_reduce($array, function ($carry, $item) {
				return $carry && is_array($item);
			}, true);
	}
}

if (!function_exists('camel_to_snake')) {
	function camel_to_snake(string $string): string
	{
		return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $string));
	}
}

if (!function_exists('snake_to_camel')) {
	function snake_to_camel(string $string): string
	{
		return lcfirst(str_replace('_', '', ucwords($string, '_')));
	}
}

if (!function_exists('camel_to_kebab')) {
	function camel_to_kebab(string $string): string
	{
		return strtolower(preg_replace('/([a-z])([A-Z])/', '$1-$2', $string));
	}
}

if (!function_exists('kebab_to_camel')) {
	function kebab_to_camel(string $string): string
	{
		$string = str_replace('-', '', ucwords($string, '-'));

		return lcfirst($string);
	}
}

if (!function_exists('kebab_to_pascal')) {
	function kebab_to_pascal(string $string): string
	{
		return str_replace('-', '', ucwords($string, '-'));
	}
}

if (!function_exists('pascal_to_kebab')) {
	function pascal_to_kebab(string $string): string
	{
		return strtolower(preg_replace('/([a-z])([A-Z])/', '$1-$2', $string));
	}
}

if (!function_exists('class_basename')) {
	function class_basename(string $class): string
	{
		return basename(str_replace('\\', '/', $class));
	}
}

if (!function_exists('normalize_whitespace')) {
	function normalize_whitespace(string $string): string
	{
		return preg_replace('/\s+/', ' ', trim($string));
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
