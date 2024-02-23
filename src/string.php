<?php

namespace Inspira\Utils;

use Stringable;

/**
 * Checks if a value can be converted into a string.
 *
 * @param mixed $data
 * @return bool
 */
function stringable(mixed $data): bool
{
	return is_scalar($data) || $data instanceof Stringable || is_null($data);
}

/**
 * Converts a string to snake_case.
 * It can handle kebab-case, camelCase and PascalCase.
 * Other delimiter characters that are handled are whitespace and numbers.
 *
 * @param string $string
 * @return string
 */
function to_snake(string $string): string
{
	return strtolower(preg_replace('/([a-z])(?=[A-Z\d])|(\d)(?=[a-zA-Z])|(\s)+|(-)+/', '$1$2_', $string));
}

/**
 * Converts a string to kebab-case.
 * It can handle snake_case, camelCase and PascalCase.
 * Other delimiter characters that are handled are whitespace and numbers.
 *
 * @param string $string
 * @return string
 */
function to_kebab(string $string): string
{
	return strtolower(str_replace('_', '-', to_snake($string)));
}

/**
 * Converts a string to camelCase.
 * It can handle snake_case, kebab-case and PascalCase.
 * Other delimiter characters that are handled are whitespace and numbers.
 *
 * @param string $string
 * @return string
 */
function to_camel(string $string): string
{
	return preg_replace('/\s/', '', lcfirst(ucwords(str_replace('_', ' ', to_snake($string)))));
}

/**
 * Converts a string to PascalCase.
 * It can handle snake_case, kebab-case and camelCase.
 * Other delimiter characters that are handled are whitespace and numbers.
 *
 * @param string $string
 * @return string
 */
function to_pascal(string $string): string
{
	return preg_replace('/\s/', '', ucwords(str_replace('_', ' ', to_snake($string))));
}

/**
 * Ensures a string has only a single whitespace between words.
 *
 * @param string $string
 * @return string
 */
function normalize_whitespace(string $string): string
{
	return preg_replace('/\s+/', ' ', trim($string));
}
