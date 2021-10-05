<?php
namespace App\Helpers;

use PhpParser\Node\Expr\Cast\String_;

class Mobile{
    const MINIMALCOUNTRYCODE = 0;
    const COUNTRYCODE = 1;
    const MOBILENUMBER = 2;

    protected String $mobileNumber;
    protected Bool $isValid = false;
    public function __construct( protected String | int $mobileText )
    {
        $this->mobileToEnNumbers()->validate();
    }

    protected function mobileToEnNumbers(){
        $this->mobile = (String) $this->mobileText;
        $this->mobile = str_replace(
            ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷' ,'۸' ,'۹', '٠', '١', '٢', '٣', '٤','٥','٦','٧','٨','٩'],
            [0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9],
            $this->mobile
        );
        return $this;
    }
    protected function validate(){
        $this->isValid = preg_match("/^((\+|00)?98|0)?(9((([13][0-9]|9[0-4]|0[1-5]|41|2[0-2]|94)\d{7})|(99[08]\d{6})|((991[0-4]|999[6-9]|981[0-5])\d{5})))$/", $this->mobile, $reg);
        if($this->isValid){
            $this->mobileNumber = $reg[3];
        }
        return $this;
    }

    public function isValid(){
        return $this->isValid;
    }

    public function mobileNumber(int $flag = 0): String
    {
        switch($flag){
            case static::MINIMALCOUNTRYCODE: return "98{$this->mobileNumber}";
            case static::COUNTRYCODE: return "+98{$this->mobileNumber}";
            case static::MOBILENUMBER: return $this->mobileNumber;
        }
    }

    public static function getNumber(String | int $mobileText, int $flag = 0){
        return (new static($mobileText))->mobileNumber($flag);
    }
}
