<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Dictionary;

class DataDictionary
{
    const URL = 'http://estoremedia.space/DataIT/';

    const NAMES = '//div[@class="row"]//div[@class="col-lg-4 col-md-6 mb-4"]//div[@class="card h-100"]//h4//a';
    const URLS = '//div[@class="row"]//div[@class="col-lg-4 col-md-6 mb-4"]//div[@class="card h-100"]//a';
    const IMAGES = '//div[@class="row"]//div[@class="col-lg-4 col-md-6 mb-4"]//div[@class="card h-100"]//a//img';
    const PRICES = '//div[@class="row"]//div[@class="col-lg-4 col-md-6 mb-4"]//div[@class="card h-100"]//h5';
    const OPINIONS = '//div[@class="row"]//div[@class="col-lg-4 col-md-6 mb-4"]//div[@class="card h-100"]//small';

}