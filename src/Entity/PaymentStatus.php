<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity;

class PaymentStatus extends AbstractEntity
{

	private string $transId;

	final private function __construct()
	{
		// Noop
	}

	public static function of(string $transId): self
	{
		$ps = new static();
		$ps->transId = $transId;

		return $ps;
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
