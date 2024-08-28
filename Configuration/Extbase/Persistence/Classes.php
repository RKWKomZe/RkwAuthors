<?php
declare(strict_types = 1);

return [
    \RKW\RkwAuthors\Domain\Model\Pages::class => [
        'tableName' => 'pages',
    ],
    \RKW\RkwAuthors\Domain\Model\News::class => [
        'tableName' => 'tx_news_domain_model_news',
    ],
    \RKW\RkwEvents\Domain\Model\Authors::class => [
        'tableName' => 'tx_rkwauthors_domain_model_authors',
    ],
    \RKW\RkwShop\Domain\Model\Author::class => [
        'tableName' => 'tx_rkwauthors_domain_model_authors',
    ],
];
