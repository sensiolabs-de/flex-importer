<?php
declare(strict_types=1);

namespace App\Command;

use App\ProductImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ProductImportCommand extends Command
{
    private $productImporter;

    public function __construct(ProductImporter $productImporter)
    {
        $this->productImporter = $productImporter;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('app:product:import')
            ->addArgument('file', InputArgument::REQUIRED, 'Path to import file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $file = $input->getArgument('file');

        $io->title('Product Import');

        $this->productImporter->importFile($file);

        $io->success('Successfully imported products.');

        return 0;
    }
}
