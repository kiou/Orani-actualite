<?php

namespace ActualiteBundle\Repository;

/**
 * ActualiteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActualiteRepository extends \Doctrine\ORM\EntityRepository
{

    public function getAllActualites($recherche = null, $categorie = null, $admin = false, $limit = null)
    {
        $qb = $this->createQueryBuilder('a');

        /**
         * recherche via le titre
         */
        if(!empty($recherche)){
            $qb->andWhere('a.titre LIKE :recherche')
               ->setParameter('recherche', '%'.$recherche.'%');
        }

        /**
         * recherche via la catégorie
         */
        if(!empty($categorie)){
            $qb->andWhere('a.categorie = :categorie')
               ->setParameter('categorie', $categorie);
        }

        if($admin) $qb->orderBy('a.id', 'DESC');
        else{
            $qb->andWhere('a.isActive =  :isActive')
               ->setParameter('isActive', true)
               ->andWhere('a.avant LIKE :avant')
               ->setParameter('avant', false)
               ->andWhere('a.debut <=  :debut')
               ->setParameter('debut', new \DateTime('now'))
               ->orderBy('a.poid', 'DESC');
        }

        if(!empty($limit)){
            $qb->setMaxResults($limit);
        }

        return $query = $qb->getQuery()->getResult();
    }

    public function getAvantActualite()
    {
        $qb = $this->createQueryBuilder('a')
                   ->andWhere('a.isActive =  :isActive')
                   ->setParameter('isActive', true)
                   ->andWhere('a.avant LIKE :avant')
                   ->setParameter('avant', true)
                   ->andWhere('a.debut <=  :debut')
                   ->setParameter('debut', new \DateTime('now'))
                   ->setMaxResults(1)
                   ->orderBy('a.poid', 'DESC');

        return $query = $qb->getQuery()->getOneOrNullResult();
    }

    public function getCurrentActualite($id)
    {
        $qb = $this->createQueryBuilder('a')
                   ->andWhere('a.isActive =  :isActive')
                   ->setParameter('isActive', true)
                   ->andWhere('a.debut <=  :debut')
                   ->setParameter('debut', new \DateTime('now'))
                   ->andWhere('a.id = :id')
                   ->setParameter('id', $id);

        return $query = $qb->getQuery()->getOneOrNullResult();

    }

}
