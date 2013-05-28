<?php
namespace Db\Repository;

use Db\Repository\AbstractRepository;
use Db\Entity\Band as BandEntity;

class Band extends AbstractRepository
{
    public function getLatestYear(BandEntity $band)
    {
        $lineups = $this->getEntityManager()->getRepository('Db\Entity\Lineup')->findBy(array(
            'band' => $band
        ));

        $year = 0;
        foreach ($lineups as $lineup) {
            $performances = $this->getEntityManager()->getRepository('Db\Entity\Performance')->findBy(array(
                'lineup' => $lineup
            ));

            foreach ($performances as $performance) {
                if ($performance->getPerformanceDateAt()->format('Y') > $year)
                    $year = $performance->getPerformanceDateAt()->format('Y');
            }
        }

        return $year;
    }
}
