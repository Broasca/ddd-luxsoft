<?php

namespace App\Repository;

use App\Service\SystemMetricsService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use function get_class;
use function str_replace;

abstract class ExtendedEntityRepository extends ServiceEntityRepository
{

	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, $this->getEntityNameFromRepositoryName());
	}

//    public function find($id, $lockMode = null, $lockVersion = null)
//    {
//        if ($id === null) {
//            return null;
//        }
//
//        return parent::find($id, $lockMode, $lockVersion);
//    }

    public function getEntityNameFromRepositoryName()
	{
		$class = get_class($this);
		return str_replace(['App\\Repository\\', 'Repository'], ['App\\Entity\\', ''], $class);
	}

	/**
	 * Executes a DDL query and returns the first object returned by that query
	 * @param string $query The DDL query to execute
	 * @param array $params The params for the DDL query
	 * @return mixed
	 * @throws NonUniqueResultException
	 */
	protected function getOne($query, $params = [])
	{
		/** @var $q Query */
		$q = $this->getEntityManager()->createQuery($query);
		$q->setParameters($params);
		$q->setMaxResults(1);
		try {
			$res = $q->getSingleResult();
			return $res;
		} catch (NoResultException $e) {
			return null;
		}
	}

	/**
	 * Executes a DDL query and returns an array with all the objects returned
	 * @param string $query The DDL query to execute
	 * @param array $params The params for the DDL query
	 * @param int $limit    The maximum number of results to return
	 * @param int $offset   The offset to start from when returning results
	 * @return array
	 * @throws Exception
	 */
    protected function getAll($query, $params = [], $limit = 0, $offset = 0)
    {
        /** @var $q Query */
        $q = $this->getEntityManager()->createQuery($query);
        $q->setParameters($params);
        if ($limit) $q->setMaxResults($limit);
        if ($offset) $q->setFirstResult($offset);
        return $q->getResult();
    }

    /**
     * @param string $sql
     * @param array $params
     * @return mixed
     * @throws DBALException
     */
    public function fetchOne(string $sql, array $params = [])
    {
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetch();
    }

    /**
     * @param string $sql
     * @param array $params
     * @return false|mixed
     * @throws DBALException
     */
    public function fetchOneAsValue(string $sql, array $params = [])
    {
        $result = $this->fetchOne($sql, $params);
        if (!empty($result) && is_array($result)) {
            return reset($result);
        }

        return $result;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return array
     * @throws DBALException
     */
    public function fetchAll(string $sql, array $params = [])
    {
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    /**
     * @param string $sql
     * @param array $params
     * @return int
     * @throws DBALException
     * @throws Exception
     */
    public function executeSql(string $sql, array $params = [])
    {
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute($params);

        return $stmt->rowCount();
    }

	/**
	 * Persist an object to the database
	 * @param $object
	 * @throws ORMException
	 */
	public function persist($object)
	{
		$this->getEntityManager()->persist($object);
	}

	/**
	 * Remove an object from the database
	 * @param $object
	 * @throws ORMException
	 */
	public function remove($object)
	{
		$this->getEntityManager()->remove($object);
	}

	/**
	 * Refresh the object by reading new data from the database
	 * @param $object
	 * @throws ORMException
	 */
	public function refresh($object)
	{
		$this->getEntityManager()->refresh($object);
	}

	/**
	 * Detach the object from the entity manager
	 * @param $object
	 * @throws Exception
	 */
	public function detach($object)
	{
		$this->getEntityManager()->detach($object);
	}

	/**
	 * Flush one object or all objects from the entity manager to the database
	 * @param $object
	 */
	public function flush($object = null)
	{
		$this->getEntityManager()->flush($object);
	}

	/**
	 * Start a database transaction
	 */
	public function begin()
	{
		$this->getEntityManager()->getConnection()->beginTransaction();
	}

	/**
	 * Commit the database transaction
	 */
	public function commit()
	{
		$this->getEntityManager()->getConnection()->commit();
	}

	/**
	 * Rollback the database transaction
	 */
	public function rollback()
	{
		$this->getEntityManager()->getConnection()->rollback();
	}

	/**
	 * @return EntityManager
	 * @throws Exception
	 */
	public function getEntityManager()
	{
		return $this->_em;
	}

	public function findAllFiltered($limit, $offset, $orderType, $orderField)
	{
		$orderByArray = [];
		if ($orderField && $orderType) {
			$orderByArray[$orderField] = $orderType;
		}

		return parent::findBy(['status' => SystemMetricsService::STATUS_ACTIVE], $orderByArray, $limit ?: null, $offset ?: null);
	}

	/**
	 * @param mixed $id
	 * @return object|null
	 */
	public function findOne($id)
	{
		return parent::findOneBy([
			'id' => $id,
			'status' => SystemMetricsService::STATUS_ACTIVE
		]);
	}

    /**
     * @param string $column
     * @param array $arr
     * @return string
     */
    protected function sql_and_in(string $column, array $arr)
    {
        $values = array_map(function ($val) {
            if (is_int($val)) {
                return $val;
            }
            return sprintf("'%s'", $val);
        }, $arr);

        return sprintf(' AND %s IN (%s)', $column, implode(", ", $values));
    }

    /**
     * @param string $column
     * @param string $inclusion IN or NOT IN
     * @param array $values
     * @return string
     */
    public function sql_in(string $column, string $inclusion, array $values)
    {
        $values = array_map(function ($val) {
            if (is_int($val)) {
                return $val;
            }
            return sprintf("'%s'", $val);
        }, $values);
        $inclusion = in_array($inclusion, ['IN', 'NOT IN']) ? $inclusion : 'IN';

        return sprintf(' %s %s (%s)', $column, $inclusion, implode(", ", $values));
    }

    /**
     * Builds the where clause for containing a value in a json_value column.
     * Joins the query parts with "OR" by default, add another parameter if "AND" condition is needed
     * @param string $column
     * @param array $values
     * @return string
     */
    protected function sql_build_json_contains(string $column, array $values)
    {
        $parts = [];
        foreach ($values as $value) {
            $parts[] = "JSON_CONTAINS($column, '{$value}')";
        }

        return implode(' OR ', $parts);
    }
}
