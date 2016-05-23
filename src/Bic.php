<?php

namespace FwsDevelopment;

use Intervention\Validation\Validator;

class Bic
{
	public function __construct($iban)
	{
		$validator = new Validator();

		if (Validator::isIban($iban))
		{
			return $this->getBicCode($iban);
		}
	}

	private function getBicCode($iban)
	{
		$bank_and_bic = [
			'ABNA' => 'ABNANL2A',
			'FTSB' => 'ABNANL2A',
			'AEGO' => 'AEGONL2U',
			'ANAA' => 'ANAANL21',
			'ANDL' => 'ANDLNL2A',
			'ARBN' => 'ARBNNL22',
			'ARSN' => 'ARSNNL21',
			'ASNB' => 'ASNBNL21',
			'ATBA' => 'ATBANL2A',
			'BCDM' => 'BCDMNL22',
			'BCIT' => 'BCITNL2A',
			'BICK' => 'BICKNL2A',
			'BINK' => 'BINKNL21',
			'BKCH' => 'BKCHNL2R',
			'BKMG' => 'BKMGNL2A',
			'BLGW' => 'BLGWNL21',
			'BMEU' => 'BMEUNL21',
			'BNGH' => 'BNGHNL2G',
			'BNPA' => 'BNPANL2A',
			'BOFA' => 'BOFANLNX',
			'BOBOFS' => 'FSNL21002',
			'BOTK' => 'BOTKNL2X',
			'BUNQ' => 'BUNQNL2A',
			'CHAS' => 'CHASNL2X',
			'CITC' => 'CITCNL2A',
			'CITI' => 'CITINL2X',
			'COBA' => 'COBANL2X',
			'DEUT' => 'DEUTNL2N',
			'DHBN' => 'DHBNNL2R',
			'DLBK' => 'DLBKNL2A',
			'DNIB' => 'DNIBNL2G',
			'FBHL' => 'FBHLNL2A',
			'FLOR' => 'FLORNL2A',
			'FRGH' => 'FRGHNL21',
			'FVLB' => 'FVLBNL22',
			'GILL' => 'GILLNL2A',
			'HAND' => 'HANDNL2A',
			'HHBA' => 'HHBANL22',
			'HSBC' => 'HSBCNL2A',
			'ICBK' => 'ICBKNL2A',
			'INGB' => 'INGBNL2A',
			'INSI' => 'INSINL2A',
			'ISBK' => 'ISBKNL2A',
			'KABA' => 'KABANL2A',
			'KASA' => 'KASANL2A',
			'KNAB' => 'KNABNL2H',
			'KOEX' => 'KOEXNL2A',
			'KRED' => 'KREDNL2X',
			'LOCY' => 'LOCYNL2A',
			'LOYD' => 'LOYDNL2A',
			'LPLN' => 'LPLNNL2F',
			'MHCB' => 'MHCBNL2A',
			'NNBA' => 'NNBANL2G',
			'NWAB' => 'NWABNL2G',
			'PCBC' => 'PCBCNL2A',
			'BRANCH' => 'AMSTERDAM',
			'RABO' => 'RABONL2U',
			'RBOS' => 'RBOSNL2A',
			'RBRB' => 'RBRBNL21',
			'SNSB' => 'SNSBNL2A',
			'SOGE' => 'SOGENL2A',
			'STAL' => 'STALNL2G',
			'TEBU' => 'TEBUNL2A',
			'TRIO' => 'TRIONL2U',
			'UBSW' => 'UBSWNL2A',
			'UGBI' => 'UGBINL2A',
			'VOWA' => 'VOWANL21',
			'ZWLB' => 'ZWLBNL21'
		];

		$iban_parts = $this->partIban($iban);

		if (in_array($iban_parts['bank_code'], $bank_and_bic))
		{
			return $bank_and_bic[$iban_parts['bank_code']];
		}
	}

	private function partIban($iban)
	{
		$iban_split = str_split($iban);
		
		$countrycode = "";
		$control_number = "";
		$bank_code = "";
		$bank_number = "";


		for ($i=0; $i<Count($iban_split); $i++)
		{
			if ($i == 0 || $i == 1)
			{
				if (preg_match('/^[a-z]+/', strtolower($split)))
				{
					$countrycode .= strtoupper($split);
				}
			}
			if ($i >= 2 || $i <= 3)
			{
				if (preg_match('/^[0-9]/', $split))
				{
					$control_number .= $split;
				}
			}
			if ($i >= 4 || $i <= 7)
			{
				// Bank code
				if (preg_math('/^[a-z]+/', $split))
				{
					$bank_code .= strtoupper($split);
				}
			}
			if ($i >= 7)
			{
				// everything has to be nummeric
				if (preg_match('/^[0-9]+/', $split))
				{
					$bank_number .= $split;
				}
			}
		}
		
		$return = [
				'country' => $countrycode,
				'control_number' => $control_number,
				'bank_code' => $bank_code,
				'bank_number' => $bank_number
		];

		return $return;
	}
}