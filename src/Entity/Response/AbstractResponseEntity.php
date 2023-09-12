<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity\Response;

use Contributte\Comgate\Exceptions\Logical\InvalidArgumentException;
use Contributte\Comgate\Exceptions\Runtime\InvalidComGateDataException;
use Contributte\Comgate\Http\Response;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractResponseEntity extends Response
{

	/**
	 * @param Response|ResponseInterface $origin
	 */
	public function __construct($origin)
	{
		if ($origin instanceof Response) {
			$origin = $origin->getOrigin();
		}

		parent::__construct($origin);
	}

	/**
	 * @param string $fieldId
	 * @param int|string|null $default
	 * @return int|string|null
	 */
	public function get(string $fieldId, $default = null)
	{
		$value = $this->getData()[$fieldId] ?? $default;
		if ($value !== null && !is_string($value) && !is_int($value)) {
			throw new InvalidComGateDataException(sprintf('Comgate response field "%s" - unexpected type', $fieldId));
		}

		return $value;
	}

	/**
	 * @phpstan-return ($default is null ? (string|null) : string)
	 */
	protected function getString(string $fieldId, ?string $default = null): ?string
	{
		return (string) ($this->get($fieldId) ?? $default);
	}

	protected function getRequiredString(string $fieldId): string
	{
		$value = $this->getString($fieldId);
		if ($value === null) {
			throw new InvalidArgumentException(sprintf('Comgate response field "%s" - missing', $fieldId));
		}

		return $value;
	}

	/**
	 * @phpstan-return ($default is null ? (int|null) : int)
	 */
	protected function getInteger(string $fieldId, ?int $default = null): ?int
	{
		return (int) ($this->get($fieldId) ?? $default);
	}

	protected function getRequiredInteger(string $fieldId): int
	{
		$value = $this->getInteger($fieldId);
		if ($value === null) {
			throw new InvalidArgumentException(sprintf('Comgate response field "%s" - missing', $fieldId));
		}

		return $value;
	}

	/**
	 * @phpstan-return ($default is null ? (bool|null) : bool)
	 */
	protected function getBool(string $fieldId, ?bool $default = null): ?bool
	{
		return (bool) ($this->get($fieldId) ?? $default);
	}

	protected function getRequiredBool(string $fieldId): bool
	{
		$value = $this->getBool($fieldId);
		if ($value === null) {
			throw new InvalidArgumentException(sprintf('Comgate response field "%s" - missing', $fieldId));
		}

		return $value;
	}

	public function getErrorCode(): int
	{
		return $this->getRequiredInteger('code');
	}

	public function getErrorMessage(): ?string
	{
		return $this->getString('message');
	}

	public function isOk(): bool
	{
		return $this->getInteger('code', -1) === 0;
	}

}
