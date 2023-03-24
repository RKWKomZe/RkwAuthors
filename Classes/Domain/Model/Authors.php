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

use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Class Authors
 *
 * @author Maximilian Fäßler <maximilian@faesslerweb.de>
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright RKW Kompetenzzentrum
 * @package RKW_RkwAuthors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Authors extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * @var string
     */
    protected string $firstName = '';


    /**
     * @var string
     */
    protected string $middleName = '';


    /**
     * @var string
     */
    protected string $lastName = '';


    /**
     * @var string
     */
    protected string $titleAfter = '';


    /**
     * @var string
     */
    protected string $titleBefore = '';


    /**
     * @var string
     */
    protected string $street = '';


    /**
     * @var string
     */
    protected string $company = '';


    /**
     * @var string
     */
    protected string $number = '';


    /**
     * @var string
     */
    protected string $city = '';


    /**
     * @var string
     */
    protected string $zip = '';


    /**
     * @var string
     */
    protected string $functionTitle = '';


    /**
     * @var string
     */
    protected string $functionTitleShort = '';

    /**
     * @var string
     */
    protected string $functionDescription = '';


    /**
     * @var string
     */
    protected string $email = '';


    /**
     * @var string
     */
    protected string $phone = '';


    /**
     * @var string
     */
    protected string $phone2 = '';


    /**
     * @var string
     */
    protected string $fax = '';


    /**
     * @var string
     */
    protected string $url = '';


    /**
     * @var string
     */
    protected string $facebookUrl = '';


    /**
     * @var string
     */
    protected string $twitterUrl = '';


    /**
     * @var string
     */
    protected string $xingUrl = '';


    /**
     * @var bool
     */
    protected bool $internal = false;


    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
     */
    protected ?FileReference $imageBig = null;


    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
     */
    protected ?FileReference $imageBoxes = null;


    /**
     * imageBoxesIsLogo
     *
     * @var bool
     */
    protected bool $imageBoxesIsLogo = false;


    /**
     * department
     *
     * @var \RKW\RkwAuthors\Domain\Model\Department|null
     */
    protected ?Department $department = null;


    /**
     * Returns the firstName
     *
     * @return string $firstName
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }


    /**
     * Sets the firstName
     *
     * @param string $firstName
     * @return void
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }


    /**
     * Returns the middleName
     *
     * @return string $middleName
     */
    public function getMiddleName(): string
    {
        return $this->middleName;
    }


    /**
     * Sets the middleName
     *
     * @param string $middleName
     * @return void
     */
    public function setMiddleName(string $middleName)
    {
        $this->middleName = $middleName;
    }


    /**
     * Returns the lastName
     *
     * @return string $lastName
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }


    /**
     * Sets the lastName
     *
     * @param string $lastName
     * @return void
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }


    /**
     * Returns the titleAfter
     *
     * @return string $titleAfter
     */
    public function getTitleAfter(): string
    {
        return $this->titleAfter;
    }


    /**
     * Sets the titleAfter
     *
     * @param string $titleAfter
     * @return void
     */
    public function setTitleAfter(string $titleAfter)
    {
        $this->titleAfter = $titleAfter;
    }


    /**
     * Returns the titleBefore
     *
     * @return string $titleBefore
     */
    public function getTitleBefore(): string
    {
        return $this->titleBefore;
    }


    /**
     * Sets the titleBefore
     *
     * @param string $titleBefore
     * @return void
     */
    public function setTitleBefore(string $titleBefore)
    {
        $this->titleBefore = $titleBefore;
    }


    /**
     * Returns the street
     *
     * @return string $street
     */
    public function getStreet(): string
    {
        return $this->street;
    }


    /**
     * Sets the street
     *
     * @param string $street
     * @return void
     */
    public function setStreet(string $street)
    {
        $this->street = $street;
    }


    /**
     * Returns the company
     *
     * @return string $company
     */
    public function getCompany(): string
    {
        return $this->company;
    }


    /**
     * Sets the company
     *
     * @param string $company
     * @return void
     */
    public function setCompany(string $company)
    {
        $this->company = $company;
    }


    /**
     * Returns the number
     *
     * @return string $number
     */
    public function getNumber(): string
    {
        return $this->number;
    }


    /**
     * Sets the number
     *
     * @param string $number
     * @return void
     */
    public function setNumber(string $number)
    {
        $this->number = $number;
    }


    /**
     * Returns the city
     *
     * @return string $city
     */
    public function getCity(): string
    {
        return $this->city;
    }


    /**
     * Sets the city
     *
     * @param string $city
     * @return void
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }


    /**
     * Returns the zip
     *
     * @return string $zip
     */
    public function getZip(): string
    {
        return $this->zip;
    }


    /**
     * Sets the zip
     *
     * @param string $zip
     * @return void
     */
    public function setZip(string $zip)
    {
        $this->zip = $zip;
    }


    /**
     * Returns the functionTitle
     *
     * @return string $functionTitle
     */
    public function getFunctionTitle(): string
    {
        return $this->functionTitle;
    }


    /**
     * Sets the functionTitle
     *
     * @param string $functionTitle
     * @return void
     */
    public function setFunctionTitle(string $functionTitle)
    {
        $this->functionTitle = $functionTitle;
    }


    /**
     * Returns the functionTitleShort
     *
     * @return string $functionTitleShort
     */
    public function getFunctionTitleShort(): string
    {
        return $this->functionTitleShort;
    }


    /**
     * Sets the functionTitleShort
     *
     * @param string $functionTitleShort
     * @return void
     */
    public function setFunctionTitleShort(string $functionTitleShort)
    {
        $this->functionTitleShort = $functionTitleShort;
    }


    /**
     * Returns the functionDescription
     *
     * @return string $functionDescription
     */
    public function getFunctionDescription(): string
    {
        return $this->functionDescription;
    }


    /**
     * Sets the functionDescription
     *
     * @param string $functionDescription
     * @return void
     */
    public function setFunctionDescription(string $functionDescription)
    {
        $this->functionDescription = $functionDescription;
    }


    /**
     * Returns the email
     *
     * @return string $email
     */
    public function getEmail(): string
    {
        return $this->email;
    }


    /**
     * Sets the email
     *
     * @param string $email
     * @return void
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }


    /**
     * Returns the phone
     *
     * @return string $phone
     */
    public function getPhone(): string
    {
        return $this->phone;
    }


    /**
     * Sets the phone
     *
     * @param string $phone
     * @return void
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }


    /**
     * Returns the phone2
     *
     * @return string $phone2
     */
    public function getPhone2(): string
    {
        return $this->phone2;
    }


    /**
     * Sets the phone2
     *
     * @param string $phone2
     * @return void
     */
    public function setPhone2(string $phone2)
    {
        $this->phone2 = $phone2;
    }


    /**
     * Returns the fax
     *
     * @return string $fax
     */
    public function getFax(): string
    {
        return $this->fax;
    }


    /**
     * Sets the fax
     *
     * @param string $fax
     * @return void
     */
    public function setFax(string $fax)
    {
        $this->fax = $fax;
    }


    /**
     * Returns the url
     *
     * @return string $url
     */
    public function getUrl(): string
    {
        return $this->url;
    }


    /**
     * Sets the url
     *
     * @param string $url
     * @return void
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }


    /**
     * Returns the facebookUrl
     *
     * @return string $facebookUrl
     */
    public function getFacebookUrl(): string
    {
        return $this->facebookUrl;
    }


    /**
     * Sets the facebookUrl
     *
     * @param string $facebookUrl
     * @return void
     */
    public function setFacebookUrl(string $facebookUrl)
    {
        $this->facebookUrl = $facebookUrl;
    }


    /**
     * Returns the twitterUrl
     *
     * @return string $twitterUrl
     */
    public function getTwitterUrl(): string
    {
        return $this->twitterUrl;
    }


    /**
     * Sets the twitterUrl
     *
     * @param string $twitterUrl
     * @return void
     */
    public function setTwitterUrl(string $twitterUrl)
    {
        $this->twitterUrl = $twitterUrl;
    }


    /**
     * Returns the xingUrl
     *
     * @return string $xingUrl
     */
    public function getXingUrl(): string
    {
        return $this->xingUrl;
    }


    /**
     * Sets the xingUrl
     *
     * @param string $xingUrl
     * @return void
     */
    public function setXingUrl(string $xingUrl)
    {
        $this->xingUrl = $xingUrl;
    }


    /**
     * Returns the internal
     *
     * @return boolean $internal
     */
    public function getInternal(): string
    {
        return $this->internal;
    }


    /**
     * Sets the internal
     *
     * @param bool $internal
     * @return void
     */
    public function setInternal(bool $internal)
    {
        $this->internal = $internal;
    }


    /**
     * Returns the boolean state of internal
     *
     * @return bool
     */
    public function isInternal(): bool
    {
        return $this->internal;
    }


    /**
     * Returns the imageBig
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageBig
     */
    public function getImageBig():? FileReference
    {
        return $this->imageBig;
    }


    /**
     * Sets the imageBig
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageBig
     * @return void
     */
    public function setImageBig(FileReference $imageBig): void
    {
        $this->imageBig = $imageBig;
    }


    /**
     * Returns the imageBoxes
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageBoxes
     */
    public function getImageBoxes() :? FileReference
    {
        return $this->imageBoxes;
    }


    /**
     * Sets the imageBoxes
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageBoxes
     * @return void
     */
    public function setImageBoxes(FileReference $imageBoxes): void
    {
        $this->imageBoxes = $imageBoxes;
    }


    /**
     * Returns the imageBoxesIsLogo
     *
     * @return boolean $imageBoxesIsLogo
     */
    public function getImageBoxesIsLogo(): bool
    {
        return $this->imageBoxesIsLogo;
    }


    /**
     * Sets the imageBoxesIsLogo
     *
     * @param boolean $imageBoxesIsLogo
     * @return void
     */
    public function setImageBoxesIsLogo(bool $imageBoxesIsLogo): void
    {
        $this->imageBoxesIsLogo = $imageBoxesIsLogo;
    }


    /**
     * Returns the boolean state of imageBoxesIsLogo
     *
     * @return boolean
     */
    public function isImageBoxesIsLogo(): bool
    {
        return $this->imageBoxesIsLogo;
    }


    /**
     * Returns the department
     *
     * @return \RKW\RkwAuthors\Domain\Model\Department $department
     */
    public function getDepartment():? Department
    {
        return $this->department;
    }


    /**
     * Sets the department
     *
     * @param \RKW\RkwAuthors\Domain\Model\Department $department
     * @return void
     */
    public function setDepartment(\RKW\RkwAuthors\Domain\Model\Department $department): void
    {
        $this->department = $department;
    }
}
