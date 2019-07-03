<?php declare(strict_types = 1);

namespace Contributte\Comgate\Entity\Codes;

final class PaymentMethodCode
{

	public const ALL = 'ALL';
	public const ALL_CARDS = 'CARD_ALL';
	public const ALL_BANKS = 'BANK_ALL';

	// CZ

	public const BANK_AIRBANK_TRANSFER = 'BANK_CZ_AB';
	public const BANK_CSOB_TRANSFER = 'BANK_CZ_CSOB';
	public const BANK_EQUA_TRANSFER = 'BANK_CZ_EB';
	public const BANK_OTHER_TRANSFER = 'BANK_CZ_OTHER';

	public const BANK_RB_BUTTON = 'BANK_CZ_RB';
	public const BANK_KB_BUTTON = 'BANK_CZ_KB';
	public const BANK_MONETA_BUTTON = 'BANK_CZ_GE';
	public const BANK_SBERBANK_BUTTON = 'BANK_CZ_VB';
	public const BANK_FIO_BUTTON = 'BANK_CZ_FB';
	public const BANK_CESKASPORITELNA_BUTTON = 'BANK_CZ_CS_P';
	public const BANK_MBANK_BUTTON = 'BANK_CZ_MB_P';
	public const BANK_CSOB_BUTTON = 'BANK_CZ_CSOB_P';
	public const BANK_ERA_BUTTON = 'BANK_CZ_PS_P';
	public const BANK_UNICREDIT_BUTTON = 'BANK_CZ_UC';

	// SK

	public const BANK_PRIMA_SK_TRANSFER = 'BANK_SK_DEXIA';
	public const BANK_FIO_SK_TRANSFER = 'BANK_SK_FB';
	public const BANK_OTHER_SK_TRANSFER = 'BANK_SK_OTHER';

	public const BANK_SLOVENSKASPORITELNA_SK_BUTTON = 'BANK_SK_SP';
	public const BANK_VUB_SK_BUTTON = 'BANK_SK_VUB';
	public const BANK_TATRA_SK_BUTTON = 'BANK_SK_TB';
	public const BANK_CSOB_SK_BUTTON = 'BANK_SK_CSOB';
	public const BANK_POSTOVNA_SK_BUTTON = 'BANK_SK_PB';

}
