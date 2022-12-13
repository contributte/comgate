<?php declare(strict_types = 1);

namespace Contributte\Comgate\DI;

use Contributte\Comgate\Comgate;
use Contributte\Comgate\Gateway\PaymentService;
use Contributte\Comgate\Http\HttpClient;
use GuzzleHttp\Client;
use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\Statement;

class ComgateExtension24 extends CompilerExtension
{

	/** @var mixed[] */
	protected $defaults = [
		'gateway' => 'https://payments.comgate.cz/v1.0/',
		'merchant' => null,
		'secret' => null,
		'test' => true,
	];

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults);

		$builder->addDefinition($this->prefix('comgate'))
			->setFactory(Comgate::class, [
				$config['merchant'],
				$config['secret'],
				$config['test'],
			])->setAutowired(false);

		$builder->addDefinition($this->prefix('http.client'))
			->setFactory(HttpClient::class, [
				new Statement(Client::class, [
					[
						'base_uri' => $config['gateway'],
					],
				]),
				$this->prefix('@comgate'),
			]);

		$builder->addDefinition($this->prefix('gateway.payment'))
			->setFactory(PaymentService::class, [
				$this->prefix('@http.client'),
			]);
	}

}
