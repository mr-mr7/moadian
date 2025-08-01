<?php

namespace Jooyeshgar\Moadian;

use DateTime;
use Jooyeshgar\Moadian\Services\VerhoeffService;

class InvoiceHeader
{
    /**
     * MOADIAN_USERNAME
     */
    public string $clientId;

    /**
     * unique tax ID (should be set by setTaxID )
     */
    public string $taxid;

    /**
     * invoice timestamp (milliseconds from epoch)
     */
    public int $indatim;

    /**
     * invoice creation timestamp (milliseconds from epoch)
     */
    public ?int $indati2m;

    /**
     * invoice type
     */
    public int $inty;

    /**
     * internal invoice number
     */
    public ?string $inno;

    /**
     * invoice reference tax ID
     */
    public ?string $irtaxid;

    /**
     * invoice pattern
     */
    public int $inp;

    /**
     * invoice subject
     */
    public int $ins;

    /**
     * seller tax identification number
     */
    public string $tins;

    /**
     * type of buyer
     */
    public ?int $tob;

    /**
     * buyer ID
     */
    public ?string $bid;

    /**
     * buyer tax identification number
     */
    public ?string $tinb;

    /**
     * seller branch code
     */
    public ?string $sbc;

    /**
     * buyer postal code
     */
    public ?string $bpc;

    /**
     * buyer branch code
     */
    public ?string $bbc;

    /**
     * flight type
     */
    public ?int $ft;

    /**
     * buyer passport number
     */
    public ?string $bpn;

    /**
     * seller customs licence number
     */
    public ?string $scln;

    /**
     * seller customs code
     */
    public ?string $scc;

    /**
     * contract registration number
     */
    public ?string $crn;

    /**
     * customs declaration cottage number
     */
    public ?string $cdcn;

    /**
     * customs declaration cottage date
     */
    public ?int $cdcd;

    /**
     * billing ID
     */
    public ?string $billid;

    /**
     * total pre discount
     */
    public ?float $tprdis;

    /**
     * total discount
     */
    public ?float $tdis;

    /**
     * total after discount
     */
    public ?float $tadis;

    /**
     * total VAT amount
     */
    public float $tvam;

    /**
     * total other duty amount
     */
    public ?float $todam;

    /**
     * total bill
     */
    public float $tbill;

    /**
     * total net weight
     */
    public ?float $tonw;

    /**
     * total Rial value
     */
    public ?float $torv;

    /**
     * total currency value
     */
    public ?float $tocv;

    /**
     * settlement type
     */
    public ?int $setm;

    /**
     * cash payment
     */
    public ?float $cap;

    /**
     * installment payment
     */
    public ?float $insp;

    /**
     * total VAT of payment
     */
    public ?float $tvop;

    /**
     * tax17
     */
    public ?float $tax17;

    /**
     * Tax Identification Number of the Company
     */
    public ?string $tinc;

    /**
     * Lading Number
     */
    public ?string $lno;

    /**
     * Lading Reference Number
     */
    public ?string $lrno;

    /**
     * Origin Country
     */
    public ?string $ocu;

    /**
     * Origin City
     */
    public ?string $oci;

    /**
     * Destination Country
     */
    public ?string $dco;

    /**
     * Destination City
     */
    public ?string $dci;

    /**
     * Transporter ID
     */
    public ?string $tid;

    /**
     * Receiver ID
     */
    public ?string $rid;

    /**
     * Lading Type
     */
    public ?string $lt;

    /**
     * Container Number
     */
    public ?string $cno;

    /**
     * Driver's national ID / foreign nationals' unique code in road transportation
     */
    public ?string $did;

    /**
     * Shipped Goods
     */
    public ?array $sg=[];

    /**
     * Announcement Sale Number
     */
    public ?string $asn;

    /**
     * Announcement Sale Date (5 digits)
     */
    public ?int $asd;

    /**
     * Insurance Number
     */
    public ?string $in;

    /**
     * Appendix Number
     */
    public ?string $an;

    public function __construct(?string $username = null) {
        $this->clientId = $username;
    }

    public function toArray(): array
    {
        $arr = get_object_vars($this);
        unset($arr['clientId']);
        return $arr;
    }

    /**
     * set data from array
     */
    public function setData(array $data): void {
        $vars = get_class_vars(get_class($this));
        $excludedMap = ['taxid'];
        foreach ($data as $key => $value) {
            if (isset($vars[$key]) && !in_array($key, $excludedMap)) {
                $this->$key = $value;
            }
        }
    }

    public function setTaxID(DateTime $date, int $internalInvoiceId)
    {
        $daysPastEpoch = $this->getDaysPastEpoch($date);
        $daysPastEpochPadded = str_pad($daysPastEpoch, 6, '0', STR_PAD_LEFT);
        $hexDaysPastEpochPadded = str_pad(dechex($daysPastEpoch), 5, '0', STR_PAD_LEFT);

        $numericClientId = $this->clientIdToNumber($this->clientId);

        $internalInvoiceIdPadded = str_pad($internalInvoiceId, 12, '0', STR_PAD_LEFT);
        $hexInternalInvoiceIdPadded = str_pad(dechex($internalInvoiceId), 10, '0', STR_PAD_LEFT);

        $decimalInvoiceId = $numericClientId . $daysPastEpochPadded . $internalInvoiceIdPadded;

        $checksum = VerhoeffService::checkSum($decimalInvoiceId);

        $this->taxid = strtoupper($this->clientId . $hexDaysPastEpochPadded . $hexInternalInvoiceIdPadded . $checksum);
    }

    private function getDaysPastEpoch(DateTime $date): int
    {
        return (int)($date->getTimestamp() / (3600 * 24));
    }

    private function clientIdToNumber(string $clientId): string
    {
        if(!defined('CHARACTER_TO_NUMBER_CODING'))
            define('CHARACTER_TO_NUMBER_CODING', [
                'A' => 65, 'B' => 66, 'C' => 67, 'D' => 68, 'E' => 69, 'F' => 70, 'G' => 71, 'H' => 72, 'I' => 73,
                'J' => 74, 'K' => 75, 'L' => 76, 'M' => 77, 'N' => 78, 'O' => 79, 'P' => 80, 'Q' => 81, 'R' => 82,
                'S' => 83, 'T' => 84, 'U' => 85, 'V' => 86, 'W' => 87, 'X' => 88, 'Y' => 89, 'Z' => 90,
            ]);
    
        $result = '';
        foreach (str_split($clientId) as $char) {
            if (is_numeric($char)) {
                $result .= $char;
            } else {
                $result .= CHARACTER_TO_NUMBER_CODING[$char];
            }
        }
    
        return $result;
    }

    /**
     * Add Shipped Goods Item
     */
    public function addSgItem(string $sgid,string $sgt): void {
        $this->sg[] = [
            'sgid' => $sgid,
            'sgt' => $sgt,
        ];
    }
}
