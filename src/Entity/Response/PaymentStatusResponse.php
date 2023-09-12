<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity\Response;

class PaymentStatusResponse extends AbstractResponseEntity
{

	public function getMerchant(): string
	{
		return $this->getRequiredString('merchant');
	}

	public function getTest(): bool
	{
		return $this->getRequiredBool('test');
	}

	public function getPrice(): int
	{
		return $this->getRequiredInteger('price');
	}

	public function getCurr(): string
	{
		return $this->getRequiredString('curr');
	}

	public function getLabel(): string
	{
		return $this->getRequiredString('label');
	}

	public function getRefId(): string
	{
		return $this->getRequiredString('refId');
	}

	public function getPayerId(): ?string
	{
		return $this->getString('payerId');
	}

	public function getMethod(): ?string
	{
		return $this->getString('method');
	}

	public function getAccount(): ?string
	{
		return $this->getString('account');
	}

	public function getEmail(): string
	{
		return $this->getRequiredString('email');
	}

	public function getName(): ?string
	{
		return $this->getString('name');
	}

	public function getTransId(): string
	{
		return $this->getRequiredString('transId');
	}

	public function getSecret(): string
	{
		return $this->getRequiredString('secret');
	}

	public function getStatus(): string
	{
		return $this->getRequiredString('status');
	}

	public function getPayerName(): ?string
	{
		return $this->getString('payerName');
	}

	public function getPayerAcc(): ?string
	{
		return $this->getString('payerAcc');
	}

	public function getFee(): string
	{
		return $this->getString('fee', 'unknown');
	}

}
