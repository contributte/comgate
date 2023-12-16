<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity;

use Contributte\Comgate\Entity\Codes\CountryCode;

class AbstractPayment extends AbstractEntity
{

	protected int $price;

	/** @var string ISO 4217 */
	protected string $curr;

	protected string $label;

	protected string $refId;

	protected string $email;

	protected string $country = CountryCode::ALL;

	protected string $account;

	protected string $name;

	public function getPrice(): int
	{
		return $this->price;
	}

	public function getCurr(): string
	{
		return $this->curr;
	}

	public function getLabel(): string
	{
		return $this->label;
	}

	public function getRefId(): string
	{
		return $this->refId;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function getCountry(): string
	{
		return $this->country;
	}

	public function getAccount(): string
	{
		return $this->account;
	}

	public function setAccount(string $account): void
	{
		$this->account = $account;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): void
	{
		$this->name = $name;
	}

	/**
	 * @return mixed[]
	 */
	public function toArray(): array
	{
		return [
			'price' => $this->price,
			'curr' => $this->curr,
			'label' => $this->label,
			'refId' => $this->refId,
			'email' => $this->email,
			'country' => $this->country,
			'account' => $this->account,
			'name' => $this->name,
		];
	}

}
