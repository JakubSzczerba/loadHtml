<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Services;

use DOMDocument;
use DOMXPath;
use App\Dictionary\DataDictionary;

class DataProvider
{
    public function integration()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, DataDictionary::URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($ch);
        $dom = new DOMDocument();
        $dom->preserveWhiteSpace = false;
        @ $dom->loadHTML($html);

        $domxpath = new DOMXPath($dom);

        return $domxpath;
    }

    public function serializeData(): array
    {
        $product_names =  ($this->integration())->query(DataDictionary::NAMES);
        $names = [];
        foreach ($product_names as $product_name) {
            $names[] = $product_name->attributes->item(2)->value;
            $names = array_unique($names);
        }

        $product_urls =  ($this->integration())->query(DataDictionary::URLS);
        $urls = [];
        foreach ($product_urls as $product_url) {
            $urls[] = $product_url->attributes->item(0)->value;
            $urls = array_unique($urls);
        }

        $product_image_urls =  ($this->integration())->query(DataDictionary::IMAGES);        
        $image_urls = [];
        foreach ($product_image_urls as $product_image_url) {
            $image_urls[] = $product_image_url->attributes->item(1)->value;
        }
        
        $product_prices =  ($this->integration())->query(DataDictionary::PRICES);
        $prices = [];
        foreach ($product_prices as $product_price) {
            $prices[] = $product_price->textContent;
        }

        $product_opinions =  ($this->integration())->query(DataDictionary::OPINIONS);
        $opinions = [];
        $stars = [];
        foreach ($product_opinions as $product_opinion) {
            $chars = $product_opinion->textContent;
            $opinion = (int) filter_var($chars, FILTER_SANITIZE_NUMBER_INT);
            $opinions[] = $opinion;
            
            $star = mb_substr($chars, 0,5);
            $stars[] = $star;
        }

        $array = [];
        foreach ( $names as $idx => $val ) {
            $array[] = [$names[$idx], $urls[$idx], $image_urls[$idx], $prices[$idx], $opinions[$idx], $stars[$idx]];
        }
        
        return $array;
    }

}