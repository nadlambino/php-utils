<?php

namespace Inspira\Utils;

use Inspira\Contracts\Arrayable;
use Iterator;

function closest_match(string $string, array $options, int|float $passing = 80, $sensitive = true): ?string
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

function arrayable(mixed $data): bool
{
	return is_array($data) || $data instanceof Iterator || $data instanceof Arrayable;
}

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

function trimplode(string $glue, array $array): string
{
	return trim(implode($glue, $array), $glue);
}

function is_multi_array(array $array): bool
{
	return count($array) > 0 && array_reduce($array, function ($carry, $item) {
		return $carry && is_array($item);
	}, true);
}
