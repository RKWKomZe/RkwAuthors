<?php

namespace RKW\RkwAuthors\Domain\Model;

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
 * Class Authors
 *
 * @author Maximilian Fäßler <faesslerweb@web.de>
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright Rkw Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Authors extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * firstName
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $firstName = '';

    /**
     * middleName
     *
     * @var string
     */
    protected $middleName = '';

    /**
     * lastName
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $lastName = '';

    /**
     * titleAfter
     *
     * @var string
     */
    protected $titleAfter = '';

    /**
     * titleBefore
     *
     * @var string
     */
    protected $titleBefore = '';

    /**
     * street
     *
     * @var string
     */
    protected $street = '';

    /**
     * company
     *
     * @var string
     */
    protected $company = '';

    /**
     * number
     *
     * @var string
     */
    protected $number = '';

    /**
     * city
     *
     * @var string
     */
    protected $city = '';

    /**
     * zip
     *
     * @var string
     */
    protected $zip = '';

    /**
     * functionTitle
     *
     * @var string
     */
    protected $functionTitle = '';

    /**
     * functionTitleShort
     *
     * @var string
     */
    protected $functionTitleShort = '';

    /**
     * functionDescription
     *
     * @var string
     */
    protected $functionDescription = '';

    /**
     * email
     *
     * @var string
     */
    protected $email = '';

    /**
     * phone
     *
     * @var string
     */
    protected $phone = '';

    /**
     * phone2
     *
     * @var string
     */
    protected $phone2 = '';

    /**
     * fax
     *
     * @var string
     */
    protected $fax = '';

    /**
     * url
     *
     * @var string
     */
    protected $url = '';

    /**
     * facebookUrl
     *
     * @var string
     */
    protected $facebookUrl = '';

    /**
     * twitterUrl
     *
     * @var string
     */
    protected $twitterUrl = '';

    /**
     * xingUrl
     *
     * @var string
     */
    protected $xingUrl = '';

    /**
     * internal
     *
     * @var boolean
     */
    protected $internal = false;

    /**
     * showWork
     *
     * @var boolean
     */
    protected $showWork = false;

    /**
     * imageSmall
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @deprecated
     */
    protected $imageSmall = null;

    /**
     * imageBig
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $imageBig = null;

    /**
     * imageBoxes
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $imageBoxes = null;


    /**
     * imageBoxesIsLogo
     *
     * @var boolean
     */
    protected $imageBoxesIsLogo = false;


    /**
     * department
     *
     * @var \RKW\RkwAuthors\Domain\Model\Department
     */
    protected $department = null;



    /**
     * Returns the firstName
     *
     * @return string $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Sets the firstName
     *
     * @param string $firstName
     * @return void
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Returns the middleName
     *
     * @return string $middleName
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Sets the middleName
     *
     * @param string $middleName
     * @return void
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * Returns the lastName
     *
     * @return string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Sets the lastName
     *
     * @param string $lastName
     * @return void
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Returns the titleAfter
     *
     * @return string $titleAfter
     */
    public function getTitleAfter()
    {
        return $this->titleAfter;
    }

    /**
     * Sets the titleAfter
     *
     * @param string $titleAfter
     * @return void
     */
    public function setTitleAfter($titleAfter)
    {
        $this->titleAfter = $titleAfter;
    }

    /**
     * Returns the titleBefore
     *
     * @return string $titleBefore
     */
    public function getTitleBefore()
    {
        return $this->titleBefore;
    }

    /**
     * Sets the titleBefore
     *
     * @param string $titleBefore
     * @return void
     */
    public function setTitleBefore($titleBefore)
    {
        $this->titleBefore = $titleBefore;
    }

    /**
     * Returns the street
     *
     * @return string $street
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Sets the street
     *
     * @param string $street
     * @return void
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * Returns the company
     *
     * @return string $company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Sets the company
     *
     * @param string $company
     * @return void
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * Returns the number
     *
     * @return string $number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Sets the number
     *
     * @param string $number
     * @return void
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * Returns the city
     *
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Sets the city
     *
     * @param string $city
     * @return void
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Returns the zip
     *
     * @return string $zip
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Sets the zip
     *
     * @param string $zip
     * @return void
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * Returns the functionTitle
     *
     * @return string $functionTitle
     */
    public function getFunctionTitle()
    {
        return $this->functionTitle;
    }

    /**
     * Sets the functionTitle
     *
     * @param string $functionTitle
     * @return void
     */
    public function setFunctionTitle($functionTitle)
    {
        $this->functionTitle = $functionTitle;
    }


    /**
     * Returns the functionTitleShort
     *
     * @return string $functionTitleShort
     */
    public function getFunctionTitleShort()
    {
        return $this->functionTitleShort;
    }

    /**
     * Sets the functionTitleShort
     *
     * @param string $functionTitleShort
     * @return void
     */
    public function setFunctionTitleShort($functionTitleShort)
    {
        $this->functionTitleShort = $functionTitleShort;
    }

    /**
     * Returns the functionDescription
     *
     * @return string $functionDescription
     */
    public function getFunctionDescription()
    {
        return $this->functionDescription;
    }

    /**
     * Sets the functionDescription
     *
     * @param string $functionDescription
     * @return void
     */
    public function setFunctionDescription($functionDescription)
    {
        $this->functionDescription = $functionDescription;
    }

    /**
     * Returns the email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Returns the phone
     *
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Sets the phone
     *
     * @param string $phone
     * @return void
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Returns the phone2
     *
     * @return string $phone2
     */
    public function getPhone2()
    {
        return $this->phone2;
    }

    /**
     * Sets the phone2
     *
     * @param string $phone2
     * @return void
     */
    public function setPhone2($phone2)
    {
        $this->phone2 = $phone2;
    }

    /**
     * Returns the fax
     *
     * @return string $fax
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Sets the fax
     *
     * @param string $fax
     * @return void
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * Returns the url
     *
     * @return string $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the url
     *
     * @param string $url
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Returns the facebookUrl
     *
     * @return string $facebookUrl
     */
    public function getFacebookUrl()
    {
        return $this->facebookUrl;
    }

    /**
     * Sets the facebookUrl
     *
     * @param string $facebookUrl
     * @return void
     */
    public function setFacebookUrl($facebookUrl)
    {
        $this->facebookUrl = $facebookUrl;
    }

    /**
     * Returns the twitterUrl
     *
     * @return string $twitterUrl
     */
    public function getTwitterUrl()
    {
        return $this->twitterUrl;
    }

    /**
     * Sets the twitterUrl
     *
     * @param string $twitterUrl
     * @return void
     */
    public function setTwitterUrl($twitterUrl)
    {
        $this->twitterUrl = $twitterUrl;
    }

    /**
     * Returns the xingUrl
     *
     * @return string $xingUrl
     */
    public function getXingUrl()
    {
        return $this->xingUrl;
    }

    /**
     * Sets the xingUrl
     *
     * @param string $xingUrl
     * @return void
     */
    public function setXingUrl($xingUrl)
    {
        $this->xingUrl = $xingUrl;
    }

    /**
     * Returns the internal
     *
     * @return boolean $internal
     */
    public function getInternal()
    {
        return $this->internal;
    }

    /**
     * Sets the internal
     *
     * @param boolean $internal
     * @return void
     */
    public function setInternal($internal)
    {
        $this->internal = $internal;
    }


    /**
     * Returns the boolean state of internal
     *
     * @return boolean
     */
    public function isInternal()
    {
        return $this->internal;
    }

    /**
     * Returns the showWork
     *
     * @return boolean $showWork
     * @deprecated
     */
    public function getShowWork()
    {
        trigger_error(__CLASS__ .':' . __METHOD__ . ' will be removed soon. Do not use it any more.', E_USER_DEPRECATED);
        return $this->showWork;
    }

    /**
     * Sets the showWork
     *
     * @param boolean $showWork
     * @return void
     * @deprecated
     */
    public function setShowWork($showWork)
    {
        trigger_error(__CLASS__ .':' . __METHOD__ . ' will be removed soon. Do not use it any more.', E_USER_DEPRECATED);
        $this->showWork = $showWork;
    }

    /**
     * Returns the imageSmall
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageSmall
     * @deprecated
     */
    public function getImageSmall()
    {
        trigger_error(__CLASS__ .':' . __METHOD__ . ' will be removed soon. Do not use it any more.', E_USER_DEPRECATED);
        return $this->imageSmall;
    }

    /**
     * Sets the imageSmall
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageSmall
     * @return void
     * @deprecated
     */
    public function setImageSmall(\TYPO3\CMS\Extbase\Domain\Model\FileReference $imageSmall)
    {
        trigger_error(__CLASS__ .':' . __METHOD__ . ' will be removed soon. Do not use it any more.', E_USER_DEPRECATED);
        $this->imageSmall = $imageSmall;
    }

    /**
     * Returns the imageBig
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageBig
     */
    public function getImageBig()
    {
        return $this->imageBig;
    }

    /**
     * Sets the imageBig
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageBig
     * @return void
     */
    public function setImageBig(\TYPO3\CMS\Extbase\Domain\Model\FileReference $imageBig)
    {
        $this->imageBig = $imageBig;
    }

    /**
     * Returns the imageBoxes
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageBoxes
     */
    public function getImageBoxes()
    {
        return $this->imageBoxes;
    }

    /**
     * Sets the imageBoxes
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageBoxes
     * @return void
     */
    public function setImageBoxes(\TYPO3\CMS\Extbase\Domain\Model\FileReference $imageBoxes)
    {
        $this->imageBoxes = $imageBoxes;
    }


    /**
     * Returns the imageBoxesIsLogo
     *
     * @return boolean $imageBoxesIsLogo
     */
    public function getImageBoxesIsLogo()
    {
        return $this->imageBoxesIsLogo;
    }

    /**
     * Sets the imageBoxesIsLogo
     *
     * @param boolean $imageBoxesIsLogo
     * @return void
     */
    public function setImageBoxesIsLogo($imageBoxesIsLogo)
    {
        $this->imageBoxesIsLogo = $imageBoxesIsLogo;
    }


    /**
     * Returns the boolean state of imageBoxesIsLogo
     *
     * @return boolean
     */
    public function isImageBoxesIsLogo()
    {
        return $this->imageBoxesIsLogo;
    }


    /**
     * Returns the department
     *
     * @return \RKW\RkwAuthors\Domain\Model\Department $department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Sets the department
     *
     * @param \RKW\RkwAuthors\Domain\Model\Department $department
     * @return void
     */
    public function setDepartment(\RKW\RkwAuthors\Domain\Model\Department $department)
    {
        $this->department = $department;
    }


}
