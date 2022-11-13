<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Services;

use DOMDocument;
use DOMXPath;
use App\Dictionary\ProductDictionary;

class ProductProvider
{
    public function integration(string $product)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, ProductDictionary::URL.$product);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($ch);
        $dom = new DOMDocument();
        $dom->preserveWhiteSpace = false;
        @ $dom->loadHTML($html);

        $domxpath = new DOMXPath($dom);

        return $domxpath;
    }

    public function serializeProduct(string $product): array
    {
        $product_price =  ($this->integration($product))->query(ProductDictionary::PRICE);
        $price = '';
        foreach ($product_price as $prices) {
            $substr = mb_substr( $prices->textContent, 0,8);
            $price = $substr;
        }

        $product_old_price =  ($this->integration($product))->query(ProductDictionary::OLD_PRICE);
        $old_price = '-';
        foreach ($product_old_price as $old_prices) {
            $old_price = $old_prices->textContent;
        }

        $product_image_urls =  ($this->integration($product))->query(ProductDictionary::URLS);        
        $image_url = '';
        foreach ($product_image_urls as $product_image_url) {
            $image_url = $product_image_url->attributes->item(1)->value;
        }

        $product_code =  ($this->integration($product))->query(ProductDictionary::CODE);
        $code = '';
        foreach ($product_code as $codes) {
            $json = json_decode($codes->textContent, true);
            foreach ($json as $value) {
                $code = $value['code'];
            }
        }

        $product_opinions =  ($this->integration($product))->query(ProductDictionary::OPINIONS);
        $opinions = '';
        $stars = '';
        foreach ($product_opinions as $product_opinion) {
            $chars = $product_opinion->textContent;
            $opinion = (int) filter_var($chars, FILTER_SANITIZE_NUMBER_INT);
            $opinions = $opinion;
            
            $star = mb_substr($chars, 0,5);
            $result = strlen($star);
            $stars = $star;
        }

        $product_names =  ($this->integration($product))->query(ProductDictionary::NAME);
        $name = '';
        foreach ($product_names as $product_name) {
            $name = $product_name->textContent;   
        }

    $result = [$price, $old_price, $image_url, $code, $opinions, $stars, $name];
    
    return $result;
    }

    public function serializeVariants(string $product): array
    {
        $product_variants =  ($this->integration($product))->query(ProductDictionary::CODE);
        $variant = [];
        foreach ($product_variants as $variants) {
            $json = json_decode($variants->textContent, true);
            foreach ($json as $value) {
                $variant = $value['variants'];
            }
        }

        return $variant;
    }
}