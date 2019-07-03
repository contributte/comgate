<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity;

abstract class AbstractEntity
{

	/**
	 * @return mixed[]
	 */
	abstract public function toArray(): array;

}
