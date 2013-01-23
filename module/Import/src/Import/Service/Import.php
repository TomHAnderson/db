<?php
/*
    # RUN BEFORE IMPORTING

    alter table shows add column imported integer not null default 0;
    alter table artists add column imported integer not null default 0;
*/


namespace Import\Service;
use Db\Entity\BandGroup as BandGroupEntity
    , Db\Entity\Band as BandEntity
    , Heartsentwined\Cron\Service\Cron
    ;

class Import {
    use \Db\Model\Component\EntityManager
        , \Db\Model\Component\ServiceManager
        ;

    public function registerCron()
    {
        Cron::register(
            'import',
            $this->getCron(),
            array($this, 'run'),
            array()
        );

        return $this;
    }

    public function run() {
        die('run import');
    }

    /**
     * cron expression: how frequently import module should be run
     */
    protected $cron;
    public function setCron($cron)
    {
        $this->cron = $cron;

        return $this;
    }
    public function getCron()
    {
        return $this->cron;
    }

    public function artistGroups()
    {
        $db = $this->getServiceLocator()->get('db');

        $statement = $db->query('select * from artist_groups');
        $results = $statement->execute();

        foreach ($results as $group) {
            if ($modelBandGroup->findOneBy(array(
                'name' => trim($group['title']),
            ))) continue;

            $bandGroup = new BandGroupEntity;
            $bandGroup->setName(trim($group['title']));
            $bandGroup->setNote(trim($group['header']) . $trim($group['footer']));

            $this->getEntityManager()->persist($bandGroup);
        }

        $this->getEntityManager()->flush();
        return;
    }

    public function artists()
    {
        $modelBandGroup = $this->getServiceLocator()->get('modelBandGroup');
        $db = $this->getServiceLocator()->get('db');

        $statement = $db->query('select * from artists where imported = 0 limit 1000');
        $results = $statement->execute();

        foreach ($results as $artist) {
            $band = new BandEntity;

            $band->setName(trim($artist['name']));
            $band->setNote(trim($artist['notes']));

            if ($artist['abbrev']) {
                $alias = new AliasEntity;
                $alias->setName(trim($artist['abbrev']));
                $alias->setBand($band);

                $this->getEntityManager()->persist($alias);
            }

            $lineup = new LineupEntity;
            $lineup->setBand($band);
            $lineup->setName($band->getName());

            $this->getEntityManager()->persist($lineup);

            // Find band group
            $groupStatement = $db->query('
                SELECT title
                  FROM artist_groups, artist_groups_xref
                 WHERE ref_artist_group = artist_group_key
                   AND ref_artist = ?', $artist['artist_key']);
            $groupResults = $statement->execute();
            $title = reset($groupResults);
            if ($title) {
                $bandGroup = $modelBandGroup->findOneBy(array(
                    'name' => $title['title'],
                ));

                $band->setBandGroup($bandGroup);
            }

            if ($artist['official_url']) {
                $bandLink = new BandLinkEntity;
                $bandLink->setBand($band);
                $bandLink->setTitle('Official URL');
                $bandLink->setUrl($artist['official_url']);

                $this->getEntityManager()->persist($bandLink);
            }

            if ($artist['fan_url']) {
                $bandLink = new BandLinkEntity;
                $bandLink->setBand($band);
                $bandLink->setTitle('Fan URL');
                $bandLink->setUrl($artist['fan_url']);

                $this->getEntityManager()->persist($bandLink);
            }

            $this->getEntityManager()->persist($band);
            $this->getEntityManager()->flush();

            $statement = $db->query('update artists set imported = 1 where artist_key = ?', $artist['artist_key']);
            $results = $statement->execute();
        }

    }

    public function shows() {
        $modelVenue = $this->getServiceLocator()->get('modelVenue');
        $db = $this->getServiceLocator()->get('db');

        $statement = $db->query('select * from shows where imported = 0 limit 1000');
        $results = $statement->execute();

        foreach ($results as $row) {
            $venue = $modelVenue->findBy(array(
                'name' => trim($row['venue']),
                'city' => trim($row['city']),
                'state' => trim($row['state']),
            ));
            if (!$venue) {
                $venue = new VenueEntity;
                $venue->setName(trim($row['venue']));
                $venue->setCity(trim($row['city']));
                $venue->setState(trim($row['state']));

                $modelVenue->create($venue);
            }


            $artistStatement = $db->query('select * from artists where ref_artist = ?', array($row['ref_artist']));
            $artistResults = $statement->execute();
            # reset() rewinds array's internal pointer to the first element and
            # returns the value of the first array element, or FALSE if the array is empty.
            $artist = reset($artistResults);
            $band = $modelBand->findOneBy(array(
                'name' => trim($artist['name']),
            ));

            if (!$band) {
                $band = new BandEntity;

                $band->setName(trim($artist['name']));
                $band->setNameNormalized(trim($artist['name']));
            }

            ///

            $show = new ShowEntity;
            $show->setVenue($venue);

            if (!$states = $modelState->findBy(array(
                'name' => $row['state']
            ))) {
                $states = $modelState->findBy(array(
                    'abbrev' => $row['state']
                ));
            }

            if ($states and sizeof($states) == 1) {
                $place = new PlaceEntity;

                $place->setState($states[0]);
                $place->setName($row['city']);

                $modelPlace->create($place);
            } else {
                $countries = $modelCountry->findBy(array(
                    'name' => $row['state']
                ));

                if (!$countries) {
                    $countries = $modelCountry->findBy(array(
                        'abbrev' => $row['state']
                    ));
                }
            }
        }
    }

}