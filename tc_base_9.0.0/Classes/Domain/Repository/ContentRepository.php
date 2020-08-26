<?php

namespace TYPOCONSULT\TcBase\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPOCONSULT\TcBase\Domain\Model\Content;

/**
 * Class ContentRepository
 *
 * @package TYPOCONSULT\TcBase\Domain\Repository
 */
class ContentRepository extends Repository
{
    /**
     * @param $uid
     *
     * @return Content|null
     */
    public function findByUid($uid): ?Content
    {
        $query = $this->createQuery();

        $query->getQuerySettings()->setRespectSysLanguage(false);
        $query->getQuerySettings()->setRespectStoragePage(false);

        $query->matching(
            $query->equals('uid', $uid)
        );

        $result = $query->execute()->getFirst();

        if ($result instanceof Content) {
            return $result;
        }

        return null;
    }

    /**
     * @param int $uid
     *
     * @return Content|null
     */
    public function findByUidRaw(int $uid): ?Content
    {
        $query = $this->createQuery();

        $query->getQuerySettings()->setRespectSysLanguage(false);
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->getQuerySettings()->setIgnoreEnableFields(true);

        $query->matching(
            $query->equals('uid', $uid)
        );

        $result = $query->execute()->getFirst();

        if ($result instanceof Content) {
            return $result;
        }

        return null;
    }
}