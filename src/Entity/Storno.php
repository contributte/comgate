<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity;

class Storno extends AbstractEntity
{

	private string $transId;

	final private function __construct()
	{
		// Noop
	}

	public static function of(
		string $transId
	): self
	{
		$p = new static();
		$p->transId = $transId;

		return $p;
	}

	public function getTransId(): string
	{
		return $this->transId;
	}

	/**
	 * @return mixed[]
	 */
	public function toArray(): array
	{
		return [
			'transId' => $this->transId,
		];
	}

}
