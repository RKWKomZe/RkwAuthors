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

/**
 * Class AuthorsRepository
 *
 * @author Maximilian Fäßler <faesslerweb@web.de>
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright Rkw Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class AuthorsRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{


    /**
     * findAllSortByLastName
     *
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
     */
    public function findAllSortByLastName()
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
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function findByFilterOptionsArray(array $filter)
    {

        $query = $this->createQuery();
        $constraints = array();
        $constraints[] = $query->equals('internal', 1);

        // 1. Sort always by lastName ASC
        $query->setOrderings(
            array(
                'lastName' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
            )
        );

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

        // Hint: if no query is added, this dataset is equal to findAll() with sort by lastName ASC
        return $query->execute();
    }



    /**
     * findByFilterOptions
     *
     * @param \RKW\RkwAuthors\Domain\Model\Filter $filter
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
     * @deprecated This function is deprecated and will be removed soon.
     */
    public function findByFilterOptions(\RKW\RkwAuthors\Domain\Model\Filter $filter)
    {

        trigger_error(__CLASS__ .':' . __METHOD__ . ' will be removed soon. Do not use it any more.', E_USER_DEPRECATED);

        $query = $this->createQuery();
        $constraints = array();
        $constraints[] = $query->equals('internal', 1);

        // 1. Sort always by lastName ASC
        $query->setOrderings(
            array(
                'lastName' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
            )
        );

        // if: one filter option is set -> do filter - else: print all
        if ($filter->getLetter() || $filter->getDepartment()) {

            // Filter by letter, if it is an active option
            $letter = $filter->getLetter();
            $departmentExplode = explode('-', $filter->getDepartment());
            $department = $departmentExplode[0];

            // a) if letter is given
            if ($letter) {
                $constraints[] = $query->like('lastName', "$letter%");
            }

            // b) if department is given
            if ($department) {
                $constraints[] = $query->in('department', array($department));
            }
        }

        $query->matching($query->logicalAnd($constraints));

        // Hint: if no query is added, this dataset is equal to findAll() with sort by lastName ASC
        return $query->execute();
    }


}
