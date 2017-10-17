<?php
declare(strict_types=1);

namespace App;

use App\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;

class ProductImporter
{
    private $entityManager;

    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function importFile(string $file): void
    {
        foreach ($this->readImportFile($file) as $data) {
            $product = Product::fromArray($data);

            $this->entityManager->persist($product);
            $this->entityManager->flush();
        }
    }

    private function readImportFile(string $file) : \Generator
    {
        $file = new \SplFileObject($file);
        $fields = $file->fgetcsv();

        while ($file->valid()) {
            $data = $file->fgetcsv();
            if (count($fields) === count($data)) {
                yield array_combine($fields, $data);
            }
        }
    }
}
