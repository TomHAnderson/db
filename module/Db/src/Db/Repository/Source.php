<?php
namespace Db\Repository;

use Db\Repository\AbstractRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Db\Entity\Band as BandEntity;

class Source extends AbstractRepository
{
    public function findAllYearsByBand(BandEntity $band)
    {
        $lineups = $this->getEntityManager()->getRepository('Db\Entity\Lineup')->findBy(array(
            'band' => $band
        ));

        $performancesForYear = new ArrayCollection;
        $sources = new ArrayCollection;

        $years = array();

        // Fetch all performances for this band
        foreach ($lineups as $lineup) {
            $performances = $this->getEntityManager()->getRepository('Db\Entity\Performance')->findBy(array(
                'lineup' => $lineup
            ));

            foreach ($performances as $performance) {
                $years[(int)$performance->getPerformanceDateAt()->format('Y')] = true;
            }
        }

        $years = array_keys($years);
        sort($years);

        return $years;
    }

    public function findByBandYear(BandEntity $band, $year)
    {
        $lineups = $this->getEntityManager()->getRepository('Db\Entity\Lineup')->findBy(array(
            'band' => $band
        ));

        $performancesForYear = new ArrayCollection;
        $sources = new ArrayCollection;

        // Fetch all performances for this band for this year
        foreach ($lineups as $lineup) {
            $performances = $this->getEntityManager()->getRepository('Db\Entity\Performance')->findBy(array(
                'lineup' => $lineup
            ));

            foreach ($performances as $performance) {
                if ($performance->getPerformanceDateAt()->format('Y') == $year)
                    $performancesForYear->add($performance);
            }
        }

        // Sort performances and fetch sources
        $iterator = $performancesForYear->getIterator();

        $iterator->uasort(function ($first, $second) {
            if ($first->getPerformanceDateAt() === $second->getPerformanceDateAt()) {
                // Same date, sort by name
                if ($first->getName() === $second->getName()) {
                    return 0;
                }

                return strcmp($first->getName(), $second->getName());
            }

            if ($first->getPerformanceDateAt() > $second->getPerformanceDateAt()) {
                return 1;
            } else {
                return -1;
            }
        });

        foreach ($performancesForYear as $performance) {
            foreach ($performance->getSources() as $source) {
                $sources->add($source);
            }
        }

        return $sources;
    }
}
