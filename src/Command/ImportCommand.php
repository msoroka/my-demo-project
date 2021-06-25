<?php

namespace App\Command;

use App\Command\Import\TaxImport;
use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('app:import')
            ->setDescription('Import base data for demo purposes');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        new TaxImport();

        $this->writeInfo('Import done');

        return Command::SUCCESS;
    }
}
