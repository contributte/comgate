<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity\Response;

class RecurringPaymentResponse extends AbstractResponseEntity
{

	public function getTransId(): string
	{
		return $this->getRequiredString('transId');
	}

}
