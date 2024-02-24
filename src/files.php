<?php

namespace Inspira\Utils;

/**
 * Get all files recursively from a directory
 *
 * @param string $directory
 * @param string|null $extension
 * @return array
 */
function get_files_from(string $directory, ?string $extension = null): array
{
	$files = [];
	$extension = $extension ? '.' . $extension : '';

	$currentFiles = glob($directory . '/*' . $extension);
	$files = array_merge($files, $currentFiles);

	$subdirectories = glob($directory . '/*', GLOB_ONLYDIR);

	foreach ($subdirectories as $subdirectory) {
		$files = array_merge($files, get_files_from($subdirectory));
	}

	return $files;
}
