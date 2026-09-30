<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity;

use Brick\Math\RoundingMode;
use Brick\Money\Money;
use Contributte\Comgate\Entity\Codes\CountryCode;
use Contributte\Comgate\Entity\Codes\LangCode;
use Contributte\Comgate\Entity\Codes\PaymentMethodCode;

class Payment extends AbstractPayment
{

	private string $method = PaymentMethodCode::ALL;

	/** @var string ISO 639-1 */
	private string $lang = LangCode::CS;

	private bool $prepareOnly = true;

	private bool $preauth = false;

	private bool $initRecurring = false;

	private bool $verification = false;

	private bool $embedded = false;

	private ?bool $chargeUnregulatedCardFees = null;

	private ?string $urlPaid = null;

	private ?string $urlCancelled = null;

	private ?string $urlPending = null;

	final private function __construct()
	{
		// Noop
	}

	public static function of(
		Money $money,
		string $label,
		string $refId,
		string $email,
		string $fullName,
		string $method = PaymentMethodCode::ALL,
		string $country = CountryCode::ALL,
		string $lang = LangCode::CS
	): self
	{
		$p = new static();
		$p->price = $money->multipliedBy(100, RoundingMode::Unnecessary)->getAmount()->toInt();
		$p->curr = $money->getCurrency()->getCurrencyCode();
		$p->label = $label;
		$p->refId = $refId;
		$p->email = $email;
		$p->fullName = $fullName;
		$p->method = $method;
		$p->country = $country;
		$p->lang = $lang;

		return $p;
	}

	public function getMethod(): string
	{
		return $this->method;
	}

	public function getLang(): string
	{
		return $this->lang;
	}

	public function setLang(string $lang): void
	{
		$this->lang = $lang;
	}

	public function isPrepareOnly(): bool
	{
		return $this->prepareOnly;
	}

	public function setPrepareOnly(bool $prepareOnly): void
	{
		$this->prepareOnly = $prepareOnly;
	}

	public function isPreauth(): bool
	{
		return $this->preauth;
	}

	public function setPreauth(bool $preauth): void
	{
		$this->preauth = $preauth;
	}

	public function isInitRecurring(): bool
	{
		return $this->initRecurring;
	}

	public function setInitRecurring(bool $initRecurring): void
	{
		$this->initRecurring = $initRecurring;
	}

	public function isVerification(): bool
	{
		return $this->verification;
	}

	public function setVerification(bool $verification): void
	{
		$this->verification = $verification;
	}

	public function isEmbedded(): bool
	{
		return $this->embedded;
	}

	public function setEmbedded(bool $embedded): void
	{
		$this->embedded = $embedded;
	}

	public function isChargeUnregulatedCardFees(): ?bool
	{
		return $this->chargeUnregulatedCardFees;
	}

	public function setChargeUnregulatedCardFees(?bool $chargeUnregulatedCardFees): void
	{
		$this->chargeUnregulatedCardFees = $chargeUnregulatedCardFees;
	}

	public function getUrlPaid(): ?string
	{
		return $this->urlPaid;
	}

	public function setUrlPaid(?string $urlPaid): void
	{
		$this->urlPaid = $urlPaid;
	}

	public function getUrlCancelled(): ?string
	{
		return $this->urlCancelled;
	}

	public function setUrlCancelled(?string $urlCancelled): void
	{
		$this->urlCancelled = $urlCancelled;
	}

	public function getUrlPending(): ?string
	{
		return $this->urlPending;
	}

	public function setUrlPending(?string $urlPending): void
	{
		$this->urlPending = $urlPending;
	}

	/**
	 * @return mixed[]
	 */
	public function toArray(): array
	{
		$data = [
			'method' => $this->method,
			'lang' => $this->lang,
			'prepareOnly' => $this->prepareOnly ? 'true' : 'false',
			'preauth' => $this->preauth ? 'true' : 'false',
			'initRecurring' => $this->initRecurring ? 'true' : 'false',
			'verification' => $this->verification ? 'true' : 'false',
			'embedded' => $this->embedded ? 'true' : 'false',
		];

		if ($this->chargeUnregulatedCardFees !== null) {
			$data['chargeUnregulatedCardFees'] = $this->chargeUnregulatedCardFees ? 'true' : 'false';
		}

		if ($this->urlPaid !== null) {
			$data['url_paid'] = $this->urlPaid;
		}

		if ($this->urlCancelled !== null) {
			$data['url_cancelled'] = $this->urlCancelled;
		}

		if ($this->urlPending !== null) {
			$data['url_pending'] = $this->urlPending;
		}

		return array_merge(parent::toArray(), $data);
	}

}
