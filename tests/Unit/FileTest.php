<?php

namespace Inspira\Utils\Tests\Unit;

use function Inspira\Utils\get_files_from;

/*
|--------------------------------------------------------------------------
| get_files_from Test Case
|--------------------------------------------------------------------------
*/

it('gets all the files from a directory', function () {
	$files = get_files_from(__DIR__ . '/TestGetFileFrom', 'php');

	expect($files)->toBeArray()->not->toBeEmpty();
	expect($files)->toBe([__DIR__ . '/TestGetFileFrom/test.php']);
});
