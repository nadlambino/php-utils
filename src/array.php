<?php

namespace Inspira\Utils;

use Inspira\Contracts\Arrayable;
use Iterator;
use IteratorAggregate;
use Traversable;

/**
 * Finds the closest match for a string.
 *
 * @param string $string
 * @param array $options
 * @param int|float $passing
 * @param bool $sensitive
 * @return string|null
 */
function closest_match(string $string, array $options, int|float $passing = 80, bool $sensitive = true): ?string
{
	$string = $sensitive ? $string : strtolower($string);
	$closest = null;
	$highest = 0;

	foreach ($options as $option) {
		$original = $option;
		$option = $sensitive ? $option : strtolower($option);
		similar_text($string, $option, $percent);

		if ($percent > $highest && $percent >= $passing) {
			$closest = $original;
			$highest = $percent;
		}
	}

	return $closest;
}

/**
 * Checks if a value can be converted into an array.
 *
 * @param mixed $data
 * @return bool
 */
function arrayable(mixed $data): bool
{
	return is_array($data) || $data instanceof IteratorAggregate || $data instanceof Iterator || $data instanceof Arrayable;
}

/**
 * Flattens an array.
 *
 * @param array $array
 * @return array
 */
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

function is_array_collection(array $array): bool
{
	return count($array) > 0 && array_reduce($array, function ($carry, $item) {
			return $carry && is_array($item);
		}, true);
}

function trimplode(string $glue, array $array): string
{
	return trim(implode($glue, $array), $glue);
}
