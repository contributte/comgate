<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity;

use Brick\Math\RoundingMode;
use Brick\Money\Money;
use Contributte\Comgate\Entity\Codes\CountryCode;
use Contributte\Comgate\Entity\Codes\LangCode;
use Contributte\Comgate\Entity\Codes\PaymentMethodCode;

class Payment extends AbstractPayment
{

	/** @var string */
	private $method = PaymentMethodCode::ALL;

	/** @var string ISO 639-1 */
	private $lang = LangCode::CS;

	/** @var bool */
	private $prepareOnly = true;

	/** @var bool */
	private $preauth = false;

	/** @var bool */
	private $initRecurring = false;

	/** @var bool */
	private $verification = false;

	/** @var bool */
	private $embedded = false;

	final private function __construct()
	{
	}

	public static function of(
		Money $money,
		string $label,
		string $refId,
		string $email,
		string $method = PaymentMethodCode::ALL,
		string $country = CountryCode::ALL,
		string $lang = LangCode::CS
	): self
	{
		$p = new static();
		$p->price = $money->multipliedBy(100, RoundingMode::UNNECESSARY)->getAmount()->toInt();
		$p->curr = $money->getCurrency()->getCurrencyCode();
		$p->label = $label;
		$p->refId = $refId;
		$p->email = $email;
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

	/**
	 * @return mixed[]
	 */
	public function toArray(): array
	{
		return array_merge(parent::toArray(), [
			'method' => $this->method,
			'lang' => $this->lang,
			'prepareOnly' => $this->prepareOnly ? 'true' : 'false',
			'preauth' => $this->preauth ? 'true' : 'false',
			'initRecurring' => $this->initRecurring ? 'true' : 'false',
			'verification' => $this->verification ? 'true' : 'false',
			'embedded' => $this->embedded ? 'true' : 'false',
		]);
	}

}
