<?php

namespace Inspira\Utils\Tests\Unit;

use Inspira\Contracts\Arrayable;
use function Inspira\Utils\closest_match;
use function Inspira\Utils\arrayable;
use function Inspira\Utils\flatten;
use function Inspira\Utils\is_array_collection;
use function Inspira\Utils\trimplode;

/*
|--------------------------------------------------------------------------
| closest_match Test Case
|--------------------------------------------------------------------------
*/

it('gets the closest match case-sensitive', function () {
	$string = 'PHP';
	$options = ['PHP', 'HPP', 'PPH'];

	expect(closest_match($string, $options))->toBe('PHP');
});

it('gets the closest match not case-sensitive', function () {
	$string = 'php';
	$options = ['PHPS', 'HPP', 'PPH'];

	expect(closest_match($string, $options, sensitive: false))->toBe('PHPS');
});

it('gets the closest match with lower passing percentage', function () {
	$string = 'PHP';
	$options = ['PHP 8.3', 'HPP', 'PPH'];

	expect(closest_match($string, $options, 50))->toBe('HPP');
});

it('returns null when no match found', function () {
	$string = 'JAVA';
	$options = ['PHP 8.3', 'HPP', 'PPH'];

	expect(closest_match($string, $options, 10))->toBeNull();
});

it('returns null when no match found case-sensitive', function () {
	$string = 'java';
	$options = ['PHP 8.3', 'HPP', 'PPH'];

	expect(closest_match($string, $options, 10, false))->toBeNull();
});

/*
|--------------------------------------------------------------------------
| arrayable Test Case
|--------------------------------------------------------------------------
*/

it('checks if a array can be converted into an array', function () {
	expect(arrayable([]))->toBeTrue();
});

it('checks if ArrayObject can be converted into an array', function () {
	expect(arrayable(new \ArrayObject([])))->toBeTrue();
});

it('checks if ArrayIterator can be converted into an array', function () {
	expect(arrayable(new \ArrayIterator([])))->toBeTrue();
});

it('checks if Arrayable can be converted into an array', function () {
	expect(arrayable(new TestArrayable()))->toBeTrue();
});

it('should be false for non-arrayable values', function () {
	expect(arrayable(new \stdClass()))->toBeFalse();
	expect(arrayable(null))->toBeFalse();
	expect(arrayable(true))->toBeFalse();
	expect(arrayable(false))->toBeFalse();
	expect(arrayable(1))->toBeFalse();
	expect(arrayable(''))->toBeFalse();
});

/*
|--------------------------------------------------------------------------
| flatten Test Case
|--------------------------------------------------------------------------
*/

it('flattens an array', function () {
	$array = [
		'a' => 'b',
		'c' => [
			'd' => 'e',
			'f' => 'g'
		],
		'h' => [
			'i' => [
				'j' => 'k'
			]
		]
	];

	expect(flatten($array))->toEqual(['a' => 'b', 'd' => 'e', 'f' => 'g', 'j' => 'k']);
});

it('flattens an empty array', function () {
	expect(flatten([]))->toEqual([]);
});

it('flattens a non multi-dimensional array', function () {
	expect(flatten(['a', 'b', 'c']))->toEqual(['a', 'b', 'c']);
});

/*
|--------------------------------------------------------------------------
| is_multi_array Test Case
|--------------------------------------------------------------------------
*/

it('should return true for collection of arrays', function () {
	expect(is_array_collection([[1], [2], [3]]))->toBeTrue();
});

it('should return false for non collection of arrays', function () {
	expect(is_array_collection([1, 2, 3]))->toBeFalse();
	expect(is_array_collection([[1], 2, 3]))->toBeFalse();
	expect(is_array_collection([1, [2], 3]))->toBeFalse();
});

/*
|--------------------------------------------------------------------------
| trimplode Test Case
|--------------------------------------------------------------------------
*/

it('should implode array with the given glue and ensure that the extra glue are trimmed', function () {
	expect(trimplode(', ', ['a', 'b', 'c']))->toBe('a, b, c');
});
