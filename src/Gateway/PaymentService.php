<?php declare(strict_types = 1);

namespace Contributte\Comgate\Gateway;

use Contributte\Comgate\Entity\Payment;
use Contributte\Comgate\Entity\PaymentStatus;
use Contributte\Comgate\Entity\RecurringPayment;
use Contributte\Comgate\Entity\Refund;
use Contributte\Comgate\Entity\Response\PaymentResponse;
use Contributte\Comgate\Entity\Response\PaymentStatusResponse;
use Contributte\Comgate\Entity\Response\RecurringPaymentResponse;
use Contributte\Comgate\Entity\Response\RefundResponse;
use Contributte\Comgate\Entity\Response\StornoResponse;
use Contributte\Comgate\Entity\Storno;
use Contributte\Comgate\Http\HttpClient;

class PaymentService
{

	protected HttpClient $client;

	public function __construct(HttpClient $client)
	{
		$this->client = $client;
	}

	public function create(Payment $payment): PaymentResponse
	{
		$data = $payment->toArray();

		return new PaymentResponse($this->client->post('create', $data));
	}

	public function recurring(RecurringPayment $payment): RecurringPaymentResponse
	{
		$data = $payment->toArray();

		return new RecurringPaymentResponse($this->client->post('recurring', $data));
	}

	public function status(PaymentStatus $status): PaymentStatusResponse
	{
		return new PaymentStatusResponse($this->client->post('status', $status->toArray()));
	}

	public function refund(Refund $payment): RefundResponse
	{
		$data = $payment->toArray();

		return new RefundResponse($this->client->post('refund', $data));
	}

	public function storno(Storno $payment): StornoResponse
	{
		$data = $payment->toArray();

		return new StornoResponse($this->client->post('cancel', $data));
	}

}
