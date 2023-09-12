<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity\Response;

class PaymentResponse extends AbstractResponseEntity
{

	public function getTransId(): string
	{
		return $this->getRequiredString('transId');
	}

	public function getRedirect(): ?string
	{
		return $this->getString('redirect');
	}

}
