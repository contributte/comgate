<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity;

abstract class AbstractEntity
{

	/**
	 * @return array<string, mixed>
	 */
	abstract public function toArray(): array;

}
