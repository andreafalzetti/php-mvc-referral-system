<?php

namespace Map;

use \Client;
use \ClientQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'client' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ClientTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ClientTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'referral_system';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'client';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Client';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Client';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    const COL_ID = 'client.id';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'client.title';

    /**
     * the column name for the first_name field
     */
    const COL_FIRST_NAME = 'client.first_name';

    /**
     * the column name for the last_name field
     */
    const COL_LAST_NAME = 'client.last_name';

    /**
     * the column name for the dob field
     */
    const COL_DOB = 'client.dob';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'client.email';

    /**
     * the column name for the mobile field
     */
    const COL_MOBILE = 'client.mobile';

    /**
     * the column name for the address field
     */
    const COL_ADDRESS = 'client.address';

    /**
     * the column name for the notes field
     */
    const COL_NOTES = 'client.notes';

    /**
     * the column name for the created field
     */
    const COL_CREATED = 'client.created';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Title', 'FirstName', 'LastName', 'Dob', 'Email', 'Mobile', 'Address', 'Notes', 'Created', ),
        self::TYPE_CAMELNAME     => array('id', 'title', 'firstName', 'lastName', 'dob', 'email', 'mobile', 'address', 'notes', 'created', ),
        self::TYPE_COLNAME       => array(ClientTableMap::COL_ID, ClientTableMap::COL_TITLE, ClientTableMap::COL_FIRST_NAME, ClientTableMap::COL_LAST_NAME, ClientTableMap::COL_DOB, ClientTableMap::COL_EMAIL, ClientTableMap::COL_MOBILE, ClientTableMap::COL_ADDRESS, ClientTableMap::COL_NOTES, ClientTableMap::COL_CREATED, ),
        self::TYPE_FIELDNAME     => array('id', 'title', 'first_name', 'last_name', 'dob', 'email', 'mobile', 'address', 'notes', 'created', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Title' => 1, 'FirstName' => 2, 'LastName' => 3, 'Dob' => 4, 'Email' => 5, 'Mobile' => 6, 'Address' => 7, 'Notes' => 8, 'Created' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'title' => 1, 'firstName' => 2, 'lastName' => 3, 'dob' => 4, 'email' => 5, 'mobile' => 6, 'address' => 7, 'notes' => 8, 'created' => 9, ),
        self::TYPE_COLNAME       => array(ClientTableMap::COL_ID => 0, ClientTableMap::COL_TITLE => 1, ClientTableMap::COL_FIRST_NAME => 2, ClientTableMap::COL_LAST_NAME => 3, ClientTableMap::COL_DOB => 4, ClientTableMap::COL_EMAIL => 5, ClientTableMap::COL_MOBILE => 6, ClientTableMap::COL_ADDRESS => 7, ClientTableMap::COL_NOTES => 8, ClientTableMap::COL_CREATED => 9, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'title' => 1, 'first_name' => 2, 'last_name' => 3, 'dob' => 4, 'email' => 5, 'mobile' => 6, 'address' => 7, 'notes' => 8, 'created' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('client');
        $this->setPhpName('Client');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Client');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 10, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', true, 45, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', true, 45, null);
        $this->addColumn('dob', 'Dob', 'VARCHAR', false, 10, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 45, null);
        $this->addColumn('mobile', 'Mobile', 'VARCHAR', false, 15, null);
        $this->addColumn('address', 'Address', 'VARCHAR', false, 256, null);
        $this->addColumn('notes', 'Notes', 'VARCHAR', false, 45, null);
        $this->addColumn('created', 'Created', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Review', '\\Review', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':client_id',
    1 => ':id',
  ),
), null, null, 'Reviews', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? ClientTableMap::CLASS_DEFAULT : ClientTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Client object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ClientTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ClientTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ClientTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ClientTableMap::OM_CLASS;
            /** @var Client $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ClientTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ClientTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ClientTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Client $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ClientTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ClientTableMap::COL_ID);
            $criteria->addSelectColumn(ClientTableMap::COL_TITLE);
            $criteria->addSelectColumn(ClientTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(ClientTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(ClientTableMap::COL_DOB);
            $criteria->addSelectColumn(ClientTableMap::COL_EMAIL);
            $criteria->addSelectColumn(ClientTableMap::COL_MOBILE);
            $criteria->addSelectColumn(ClientTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(ClientTableMap::COL_NOTES);
            $criteria->addSelectColumn(ClientTableMap::COL_CREATED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.dob');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.mobile');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.notes');
            $criteria->addSelectColumn($alias . '.created');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(ClientTableMap::DATABASE_NAME)->getTable(ClientTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ClientTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ClientTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ClientTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Client or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Client object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClientTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Client) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ClientTableMap::DATABASE_NAME);
            $criteria->add(ClientTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ClientQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ClientTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ClientTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the client table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ClientQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Client or Criteria object.
     *
     * @param mixed               $criteria Criteria or Client object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClientTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Client object
        }

        if ($criteria->containsKey(ClientTableMap::COL_ID) && $criteria->keyContainsValue(ClientTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ClientTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ClientQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ClientTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ClientTableMap::buildTableMap();
