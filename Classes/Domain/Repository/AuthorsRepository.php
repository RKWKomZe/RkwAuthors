<?php

namespace RKW\RkwAuthors\Domain\Repository;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * Class AuthorsRepository
 *
 * @author Maximilian Fäßler <maximilian@faesslerweb.de>
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class AuthorsRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * findAllSortByLastName
     *
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findAllSortByLastName(): QueryResultInterface
    {

        $query = $this->createQuery();
        $query->setOrderings(
            array(
                'lastName' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
            )
        );

        $query->matching($query->equals('internal', 1));
        return $query->execute();
    }


    /**
     * findByFilterOptionsArray
     *
     * @param array $filter
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function findByFilterOptionsArray(array $filter): QueryResultInterface
    {

        $query = $this->createQuery();
        $constraints = array();
        $constraints[] = $query->equals('internal', 1);

        // if: one filter option is set -> do filter - else: print all
        if ($filter['letter'] || $filter['department']) {

            // Filter by letter, if it is an active option
            $letter = preg_replace('#[^a-zA-Z]#', '', $filter['letter']);
            $department = is_array($filter['department']) ? $filter['department'] : [];

            // a) if letter is given
            if ($letter) {
                $constraints[] = $query->like('lastName', "$letter%");
            }

            // b) if department is given
            if ($department) {
                $constraints[] = $query->in('department', $department);
            }
        }

        $query->matching($query->logicalAnd($constraints));

        // sort by lastName ASC
        $query->setOrderings(
            array(
                'lastName' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
            )
        );

        // Hint: if no query is added, this dataset is equal to findAll(), but sorted by lastName
        return $query->execute();
    }
}
