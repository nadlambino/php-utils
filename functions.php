<?php

use Inspira\Contracts\Arrayable;

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
