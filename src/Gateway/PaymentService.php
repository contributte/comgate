<?php declare(strict_types = 1);

namespace Contributte\Comgate\Gateway;

use Contributte\Comgate\Entity\Payment;
use Contributte\Comgate\Entity\PaymentStatus;
use Contributte\Comgate\Entity\Refund;
use Contributte\Comgate\Entity\Storno;
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
		$data = $payment->toArray();

		return $this->client->post('create', $data);
	}

	public function status(PaymentStatus $status): Response
	{
		return $this->client->post('status', $status->toArray());
	}

	public function refund(Refund $payment): Response
	{
		$data = $payment->toArray();

		return $this->client->post('refund', $data);
	}

	public function storno(Storno $payment): Response
	{
		$data = $payment->toArray();

		return $this->client->post('cancel', $data);
	}

}
