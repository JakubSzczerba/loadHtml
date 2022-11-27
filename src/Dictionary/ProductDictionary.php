<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Dictionary;

class ProductDictionary
{
    const URL = 'http://estoremedia.space/DataIT/';

    const PRICE = '//div[@class="row"]//h5';
    const OLD_PRICE = '//div[@class="row"]//h5//del';
    const URLS = '//div[@class="row"]//img';
    const CODE = '//div[@class="row"]//script';
    const OPINIONS = '//div[@class="row"]//small';
    const NAME = '//div[@class="row mb-0 pl-3"]//h3';
}