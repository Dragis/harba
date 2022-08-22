<?php

namespace App\Command;

use App\Entity\Harbour;
use App\Repository\HarbourRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:import-harbours',
    description: 'Imports all harbours',
    hidden: false
)]
class ImportHarbours extends Command
{
    const HARBOURS_GET_URL = 'https://devapi.harba.co/harbors/visible';

    public function __construct(
        private EntityManagerInterface $entityManager,
        private HttpClientInterface $httpClient,
        private HarbourRepository $harbourRepository,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $imported = 0;
        $updated = 0;
        $response = $this->httpClient->request(Request::METHOD_GET, self::HARBOURS_GET_URL);
        $harbours = json_decode($response->getContent(), true);

        foreach ($harbours as $harbourArray) {
            $harbour = $this->harbourRepository->findOneBy(['uuid' => $harbourArray['id']]);

            if (null === $harbour) {
                $imported++;
                $this->mapHarbour($harbourArray, $harbour = new Harbour());
            } else {
                $updated++;
                $this->mapHarbour($harbourArray, $harbour);
            }

            $this->entityManager->persist($harbour);
        }

        $this->entityManager->flush();
        $output->writeln(sprintf('Imported %s, updated %s harbours', $imported, $updated));

        return Command::SUCCESS;
    }

    private function mapHarbour(array $harbourArray, Harbour $harbour): void
    {
        $harbour
            ->setName($harbourArray['name'])
            ->setUuid($harbourArray['id'])
            ->setTranslations($harbourArray['translations'])
            ->setAcceptBankPayments($harbourArray['acceptBankPayments'])
            ->setAcceptEpayPayments($harbourArray['acceptEpayPayments'])
            ->setBookOneDayOnly($harbourArray['bookOneDayOnly'])
            ->setCanBook($harbourArray['canBook'])
            ->setAcceptGoCardlessPayments($harbourArray['acceptGoCardlessPayments'])
            ->setCashOnlyBookings($harbourArray['cashOnlyBookings'])
            ->setImage($harbourArray['image'] ?? null)
            ->setIsFree($harbourArray['isFree'])
            ->setIsPriceHidden($harbourArray['isPriceHidden'])
            ->setLat($harbourArray['lat'])
            ->setLon($harbourArray['lon'])
            ->setNotActivated($harbourArray['notActivated'])
            ->setSubscribedBerthsHiddenFromGuests($harbourArray['subscribedBerthsHiddenFromGuests']);
    }
}
