<?php

namespace Jooyeshgar\Moadian;

class InvoiceItem
{
    /**
     * service stuff ID
     */
    public string $sstid;

    /**
     * service stuff title
     */
    public ?string $sstt;

    /**
     * amount
     */
    public float $am;

    /**
     * measurement unit
     */
    public ?string $mu;

    /**
     * net weight
     */
    public ?float $nw;

    /**
     * fee (pure price per item)
     */
    public float $fee;

    /**
     * fee in foreign currency
     */
    public ?float $cfee;

    /**
     * currency type
     */
    public ?string $cut;

    /**
     * exchange rate
     */
    public ?float $exr;

    /**
     * service stuff Rial Value
     */
    public ?float $ssrv;

    /**
     * service stuff currency value
     */
    public ?float $sscv;

    /**
     * pre discount
     */
    public ?float $prdis;

    /**
     * discount
     */
    public ?float $dis;

    /**
     * after discount
     */
    public ?float $adis;

    /**
     * VAT rate
     */
    public float $vra;

    /**
     * VAT amount
     */
    public float $vam;

    /**
     * other duty title
     */
    public ?string $odt;

    /**
     * other duty rate
     */
    public ?float $odr;

    /**
     * other duty amount
     */
    public ?float $odam;

    /**
     * other legal title
     */
    public ?string $olt;

    /**
     * other legal rate
     */
    public ?float $olr;

    /**
     * other legal amount
     */
    public ?float $olam;

    /**
     * construction fee
     */
    public ?float $consfee;

    /**
     * seller profit
     */
    public ?float $spro;

    /**
     * broker salary
     */
    public ?float $bros;

    /**
     * total construction profit broker salary
     */
    public ?float $tcpbs;

    /**
     * cash share of payment
     */
    public ?float $cop;

    /**
     * vat of payment
     */
    public ?float $vop;

    /**
     * buyer register number
     */
    public ?string $bsrn;

    /**
     * total service stuff amount
     */
    public float $tsstam;

    /**
     * Carat Unit Indicator
     */
    public ?float $cui;

    /**
     * Currency Purchase Rate
     */
    public ?float $cpr;

    /**
     * Source Of Value Added Tax
     */
    public ?float $sovat;


    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * set data from array
     */
    public function setData(array $data): void
    {
        $vars = get_class_vars(get_class($this));
        $excludedMap = [];
        foreach ($data as $key => $value) {
            if (isset($vars[$key]) && !in_array($key, $excludedMap)) {
                $this->$key = $value;
            }
        }
    }
}
