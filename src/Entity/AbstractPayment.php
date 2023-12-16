<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity;

use Contributte\Comgate\Entity\Codes\CountryCode;
use Contributte\Comgate\Exceptions\LogicException;

class AbstractPayment extends AbstractEntity
{

	protected ?int $price = null;

	/** @var string ISO 4217 */
	protected ?string $curr = null;

	protected ?string $label = null;

	protected ?string $refId = null;

	protected ?string $email = null;

	protected ?string $country = CountryCode::ALL;

	protected ?string $account = null;

	protected ?string $name = null;

	public function getPrice(): int
	{
		if ($this->price === null) {
			throw new LogicException('Price is required');
		}

		return $this->price;
	}

	public function getCurr(): string
	{
		if ($this->curr === null) {
			throw new LogicException('Curr is required');
		}

		return $this->curr;
	}

	public function getLabel(): string
	{
		if ($this->label === null) {
			throw new LogicException('Label is required');
		}

		return $this->label;
	}

	public function getRefId(): string
	{
		if ($this->refId === null) {
			throw new LogicException('RefId is required');
		}

		return $this->refId;
	}

	public function getEmail(): string
	{
		if ($this->email === null) {
			throw new LogicException('Email is required');
		}

		return $this->email;
	}

	public function getCountry(): string
	{
		if ($this->country === null) {
			throw new LogicException('Country is required');
		}

		return $this->country;
	}

	public function getAccount(): string
	{
		if ($this->account === null) {
			throw new LogicException('Account is required');
		}

		return $this->account;
	}

	public function setAccount(string $account): void
	{
		$this->account = $account;
	}

	public function getName(): string
	{
		if ($this->name === null) {
			throw new LogicException('Name is required');
		}

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
