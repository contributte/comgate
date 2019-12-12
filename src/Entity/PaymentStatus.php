<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity;

class PaymentStatus extends AbstractEntity
{

	/** @var string */
	private $transId;

	final private function __construct()
	{
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
