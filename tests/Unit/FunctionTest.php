<?php

namespace Inspira\Utils\Tests\Unit;

use function Inspira\Utils\class_basename;
use function Inspira\Utils\set_type;
use function Inspira\Utils\get_traits;

it('gets the base class name of a class', function () {
	expect(class_basename('Inspira\Utils\Tests\Unit\StringTest'))->toBe('StringTest');
	expect(class_basename(TestArrayable::class))->toBe('TestArrayable');
});

it('sets the type of a variable', function () {
	expect(set_type('foo', 'string'))->toBe('foo');
	expect(set_type('foo', 'int'))->toBe(0);
	expect(set_type('foo', 'float'))->toBe(0.0);
	expect(set_type('foo', 'bool'))->toBe(true);
	expect(set_type('1', 'int'))->toBe(1);
	expect(set_type('1.0', 'float'))->toBe(1.0);
	expect(set_type(true, 'bool'))->toBe(true);
	expect(set_type(false, 'bool'))->toBe(false);
	expect(set_type(null, 'bool'))->toBe(false);
});

it('gets the traits of a class', function () {
	expect(get_traits(TestArrayable::class))->toBe([]);
	expect(get_traits(TestGetTraits::class))->toBe([GetTraits::class => GetTraits::class]);
});
