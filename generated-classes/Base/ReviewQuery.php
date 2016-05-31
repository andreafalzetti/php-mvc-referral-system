<?php

namespace Base;

use \Review as ChildReview;
use \ReviewQuery as ChildReviewQuery;
use \Exception;
use \PDO;
use Map\ReviewTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'review' table.
 *
 *
 *
 * @method     ChildReviewQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildReviewQuery orderByClientId($order = Criteria::ASC) Order by the client_id column
 * @method     ChildReviewQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildReviewQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildReviewQuery orderByMessage($order = Criteria::ASC) Order by the message column
 * @method     ChildReviewQuery orderByCreated($order = Criteria::ASC) Order by the created column
 *
 * @method     ChildReviewQuery groupById() Group by the id column
 * @method     ChildReviewQuery groupByClientId() Group by the client_id column
 * @method     ChildReviewQuery groupByUserId() Group by the user_id column
 * @method     ChildReviewQuery groupByStatus() Group by the status column
 * @method     ChildReviewQuery groupByMessage() Group by the message column
 * @method     ChildReviewQuery groupByCreated() Group by the created column
 *
 * @method     ChildReviewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildReviewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildReviewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildReviewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildReviewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildReviewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildReviewQuery leftJoinClient($relationAlias = null) Adds a LEFT JOIN clause to the query using the Client relation
 * @method     ChildReviewQuery rightJoinClient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Client relation
 * @method     ChildReviewQuery innerJoinClient($relationAlias = null) Adds a INNER JOIN clause to the query using the Client relation
 *
 * @method     ChildReviewQuery joinWithClient($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Client relation
 *
 * @method     ChildReviewQuery leftJoinWithClient() Adds a LEFT JOIN clause and with to the query using the Client relation
 * @method     ChildReviewQuery rightJoinWithClient() Adds a RIGHT JOIN clause and with to the query using the Client relation
 * @method     ChildReviewQuery innerJoinWithClient() Adds a INNER JOIN clause and with to the query using the Client relation
 *
 * @method     ChildReviewQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildReviewQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildReviewQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildReviewQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildReviewQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildReviewQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildReviewQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     \ClientQuery|\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildReview findOne(ConnectionInterface $con = null) Return the first ChildReview matching the query
 * @method     ChildReview findOneOrCreate(ConnectionInterface $con = null) Return the first ChildReview matching the query, or a new ChildReview object populated from the query conditions when no match is found
 *
 * @method     ChildReview findOneById(int $id) Return the first ChildReview filtered by the id column
 * @method     ChildReview findOneByClientId(int $client_id) Return the first ChildReview filtered by the client_id column
 * @method     ChildReview findOneByUserId(int $user_id) Return the first ChildReview filtered by the user_id column
 * @method     ChildReview findOneByStatus(int $status) Return the first ChildReview filtered by the status column
 * @method     ChildReview findOneByMessage(string $message) Return the first ChildReview filtered by the message column
 * @method     ChildReview findOneByCreated(string $created) Return the first ChildReview filtered by the created column *

 * @method     ChildReview requirePk($key, ConnectionInterface $con = null) Return the ChildReview by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReview requireOne(ConnectionInterface $con = null) Return the first ChildReview matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReview requireOneById(int $id) Return the first ChildReview filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReview requireOneByClientId(int $client_id) Return the first ChildReview filtered by the client_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReview requireOneByUserId(int $user_id) Return the first ChildReview filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReview requireOneByStatus(int $status) Return the first ChildReview filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReview requireOneByMessage(string $message) Return the first ChildReview filtered by the message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReview requireOneByCreated(string $created) Return the first ChildReview filtered by the created column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReview[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildReview objects based on current ModelCriteria
 * @method     ChildReview[]|ObjectCollection findById(int $id) Return ChildReview objects filtered by the id column
 * @method     ChildReview[]|ObjectCollection findByClientId(int $client_id) Return ChildReview objects filtered by the client_id column
 * @method     ChildReview[]|ObjectCollection findByUserId(int $user_id) Return ChildReview objects filtered by the user_id column
 * @method     ChildReview[]|ObjectCollection findByStatus(int $status) Return ChildReview objects filtered by the status column
 * @method     ChildReview[]|ObjectCollection findByMessage(string $message) Return ChildReview objects filtered by the message column
 * @method     ChildReview[]|ObjectCollection findByCreated(string $created) Return ChildReview objects filtered by the created column
 * @method     ChildReview[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ReviewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ReviewQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'referral_system', $modelName = '\\Review', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildReviewQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildReviewQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildReviewQuery) {
            return $criteria;
        }
        $query = new ChildReviewQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildReview|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ReviewTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ReviewTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildReview A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, client_id, user_id, status, message, created FROM review WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildReview $obj */
            $obj = new ChildReview();
            $obj->hydrate($row);
            ReviewTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildReview|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildReviewQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ReviewTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildReviewQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ReviewTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReviewQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ReviewTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ReviewTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReviewTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the client_id column
     *
     * Example usage:
     * <code>
     * $query->filterByClientId(1234); // WHERE client_id = 1234
     * $query->filterByClientId(array(12, 34)); // WHERE client_id IN (12, 34)
     * $query->filterByClientId(array('min' => 12)); // WHERE client_id > 12
     * </code>
     *
     * @see       filterByClient()
     *
     * @param     mixed $clientId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReviewQuery The current query, for fluid interface
     */
    public function filterByClientId($clientId = null, $comparison = null)
    {
        if (is_array($clientId)) {
            $useMinMax = false;
            if (isset($clientId['min'])) {
                $this->addUsingAlias(ReviewTableMap::COL_CLIENT_ID, $clientId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($clientId['max'])) {
                $this->addUsingAlias(ReviewTableMap::COL_CLIENT_ID, $clientId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReviewTableMap::COL_CLIENT_ID, $clientId, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReviewQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(ReviewTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(ReviewTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReviewTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param     mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReviewQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(ReviewTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(ReviewTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReviewTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the message column
     *
     * Example usage:
     * <code>
     * $query->filterByMessage('fooValue');   // WHERE message = 'fooValue'
     * $query->filterByMessage('%fooValue%'); // WHERE message LIKE '%fooValue%'
     * </code>
     *
     * @param     string $message The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReviewQuery The current query, for fluid interface
     */
    public function filterByMessage($message = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($message)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $message)) {
                $message = str_replace('*', '%', $message);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReviewTableMap::COL_MESSAGE, $message, $comparison);
    }

    /**
     * Filter the query on the created column
     *
     * Example usage:
     * <code>
     * $query->filterByCreated('2011-03-14'); // WHERE created = '2011-03-14'
     * $query->filterByCreated('now'); // WHERE created = '2011-03-14'
     * $query->filterByCreated(array('max' => 'yesterday')); // WHERE created > '2011-03-13'
     * </code>
     *
     * @param     mixed $created The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReviewQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(ReviewTableMap::COL_CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(ReviewTableMap::COL_CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReviewTableMap::COL_CREATED, $created, $comparison);
    }

    /**
     * Filter the query by a related \Client object
     *
     * @param \Client|ObjectCollection $client The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildReviewQuery The current query, for fluid interface
     */
    public function filterByClient($client, $comparison = null)
    {
        if ($client instanceof \Client) {
            return $this
                ->addUsingAlias(ReviewTableMap::COL_CLIENT_ID, $client->getId(), $comparison);
        } elseif ($client instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ReviewTableMap::COL_CLIENT_ID, $client->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByClient() only accepts arguments of type \Client or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Client relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildReviewQuery The current query, for fluid interface
     */
    public function joinClient($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Client');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Client');
        }

        return $this;
    }

    /**
     * Use the Client relation Client object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ClientQuery A secondary query class using the current class as primary query
     */
    public function useClientQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinClient($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Client', '\ClientQuery');
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildReviewQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(ReviewTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ReviewTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildReviewQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildReview $review Object to remove from the list of results
     *
     * @return $this|ChildReviewQuery The current query, for fluid interface
     */
    public function prune($review = null)
    {
        if ($review) {
            $this->addUsingAlias(ReviewTableMap::COL_ID, $review->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the review table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReviewTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ReviewTableMap::clearInstancePool();
            ReviewTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReviewTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ReviewTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ReviewTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ReviewTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ReviewQuery
