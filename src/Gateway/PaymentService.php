<?php declare(strict_types = 1);

namespace Contributte\Comgate\Gateway;

use Contributte\Comgate\Entity\Payment;
use Contributte\Comgate\Entity\PaymentStatus;
use Contributte\Comgate\Http\HttpClient;
use Contributte\Comgate\Http\Response;

class PaymentService
{

	/** @var HttpClient */
	protected $client;

	public function __construct(HttpClient $client)
	{
		$this->client = $client;
	}

	public function create(Payment $payment): Response
	{
		return $this->client->post('create', $payment->toArray());
	}

	public function status(PaymentStatus $status): Response
	{
		return $this->client->post('status', $status->toArray());
	}

}
