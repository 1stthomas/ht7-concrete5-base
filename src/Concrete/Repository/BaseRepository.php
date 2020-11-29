<?php

namespace Concrete\Package\Ht7Concrete5Base\Repository;

use \Doctrine\ORM\EntityRepository;

class ComposerPackageRepository extends EntityRepository
{

    public function getByFields(array $data)
    {
        $qb = $this->createQueryBuilder('qt')
                ->where('1=1');

        foreach ($data as $key => $value) {
            $where = 'qt.' . $key . ' = :' . $key;

            $qb->andWhere($where)
                    ->setParameter($key, $value);
        }

        return $qb->getResults();
    }

    public function getOrCreate(array $data)
    {
        if (!empty($data['id'])) {
            $entity = $this->find($data['id']);
        }

        if (!is_object($entity)) {
            $entity = $this->getByFields($data);
        }

        if (!is_object($entity)) {
            $entity = new ($this->entityName)($data);
        }

        return $entity;
    }

}
