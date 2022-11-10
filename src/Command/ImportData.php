<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Services\DataProvider;

class ImportData extends Command
{
    private DataProvider $dataProvider;

    public function __construct(DataProvider $dataProvider)
    {
        parent::__construct();
        $this->dataProvider = $dataProvider;
    }

    protected function configure()
    {
        $this->setName('import:products');
        $this->setDescription('Import products to csv file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Attempting to import the feed');

        $data = $this->dataProvider->serializeData();
        $headers = ['name', 'url', 'image', 'price', 'opinions', 'stars'];
        array_unshift($data, $headers);

        $fp = fopen('products.csv', 'w');
        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }  
        fclose($fp);

        $io->success('Csv has beed generated');
    }
}