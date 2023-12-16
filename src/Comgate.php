<?php declare(strict_types = 1);

namespace Contributte\Comgate;

class Comgate
{

	private string $merchant;

	private string $secret;

	private bool $test;

	public function __construct(string $merchant, string $secret, bool $test = true)
	{
		$this->merchant = $merchant;
		$this->secret = $secret;
		$this->test = $test;
	}

	public function getMerchant(): string
	{
		return $this->merchant;
	}

	public function getSecret(): string
	{
		return $this->secret;
	}

	public function isTest(): bool
	{
		return $this->test;
	}

}
