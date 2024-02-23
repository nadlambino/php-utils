<?php

namespace Inspira\Utils\Tests\Unit;

use Inspira\Contracts\Arrayable;

class TestArrayable implements Arrayable
{
	public function toArray(): array
	{
		return [];
	}
}
