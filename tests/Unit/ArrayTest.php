<?php

namespace Inspira\Utils;

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
