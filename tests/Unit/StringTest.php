<?php

namespace Inspira\Utils\Tests\Unit;

use stdClass;
use function Inspira\Utils\stringable;
use function Inspira\Utils\to_camel;
use function Inspira\Utils\to_pascal;
use function Inspira\Utils\to_snake;
use function Inspira\Utils\to_kebab;
use function Inspira\Utils\normalize_whitespace;

/*
|--------------------------------------------------------------------------
| stringable Test Case
|--------------------------------------------------------------------------
*/

it('checks if a string is a stringable', function () {
	expect(stringable('test'))->toBeTrue();
	expect(stringable(123))->toBeTrue();
	expect(stringable(null))->toBeTrue();
});

it('should return false for non-stringable values', function () {
	expect(stringable(new stdClass()))->toBeFalse();
	expect(stringable([]))->toBeFalse();
});

/*
|--------------------------------------------------------------------------
| to_snake Test Case
|--------------------------------------------------------------------------
*/

it('should convert string to snake_case', function () {
	expect(to_snake('snake_case'))->toBe('snake_case');
	expect(to_snake('kebab-case'))->toBe('kebab_case');
	expect(to_snake('camelCase'))->toBe('camel_case');
	expect(to_snake('PascalCase'))->toBe('pascal_case');
	expect(to_snake('with white space'))->toBe('with_white_space');
	expect(to_snake('kebab-caseWithCamel'))->toBe('kebab_case_with_camel');
	expect(to_snake('123with456Numbers789'))->toBe('123_with_456_numbers_789');
	expect(to_snake('Camel123Case456'))->toBe('camel_123_case_456');
});

/*
|--------------------------------------------------------------------------
| to_kebab Test Case
|--------------------------------------------------------------------------
*/

it('should convert string to kebab-case', function () {
	expect(to_kebab('snake_case'))->toBe('snake-case');
	expect(to_kebab('kebab-case'))->toBe('kebab-case');
	expect(to_kebab('camelCase'))->toBe('camel-case');
	expect(to_kebab('PascalCase'))->toBe('pascal-case');
	expect(to_kebab('with white space'))->toBe('with-white-space');
	expect(to_kebab('kebab-caseWithCamel'))->toBe('kebab-case-with-camel');
	expect(to_kebab('123with456Numbers789'))->toBe('123-with-456-numbers-789');
	expect(to_kebab('Camel123Case456'))->toBe('camel-123-case-456');
});

/*
|--------------------------------------------------------------------------
| to_camel Test Case
|--------------------------------------------------------------------------
*/

it('should convert string to camelCase', function () {
	expect(to_camel('snake_case'))->toBe('snakeCase');
	expect(to_camel('kebab-case'))->toBe('kebabCase');
	expect(to_camel('camelCase'))->toBe('camelCase');
	expect(to_camel('PascalCase'))->toBe('pascalCase');
	expect(to_camel('with white space'))->toBe('withWhiteSpace');
	expect(to_camel('kebab-caseWithCamel'))->toBe('kebabCaseWithCamel');
	expect(to_camel('123with456Numbers789'))->toBe('123With456Numbers789');
	expect(to_camel('Camel123Case456'))->toBe('camel123Case456');
});

/*
|--------------------------------------------------------------------------
| to_pascal Test Case
|--------------------------------------------------------------------------
*/

it('should convert string to PascalCase', function () {
	expect(to_pascal('snake_case'))->toBe('SnakeCase');
	expect(to_pascal('kebab-case'))->toBe('KebabCase');
	expect(to_pascal('camelCase'))->toBe('CamelCase');
	expect(to_pascal('PascalCase'))->toBe('PascalCase');
	expect(to_pascal('with white space'))->toBe('WithWhiteSpace');
	expect(to_pascal('kebab-caseWithCamel'))->toBe('KebabCaseWithCamel');
	expect(to_pascal('123with456Numbers789'))->toBe('123With456Numbers789');
	expect(to_pascal('Camel123Case456'))->toBe('Camel123Case456');
});

/*
|--------------------------------------------------------------------------
| normalize_whitespace Test Case
|--------------------------------------------------------------------------
*/

it('should normalize whitespace', function () {
	expect(normalize_whitespace('  test   '))->toBe('test');
	expect(normalize_whitespace('  more words     to test '))->toBe('more words to test');
});
