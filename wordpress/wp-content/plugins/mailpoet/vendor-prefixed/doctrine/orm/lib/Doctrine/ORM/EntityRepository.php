<?php
 namespace MailPoetVendor\Doctrine\ORM; if (!defined('ABSPATH')) exit; use BadMethodCallException; use MailPoetVendor\Doctrine\Common\Collections\Collection; use MailPoetVendor\Doctrine\Common\Collections\Criteria; use MailPoetVendor\Doctrine\Common\Collections\Selectable; use MailPoetVendor\Doctrine\Deprecations\Deprecation; use MailPoetVendor\Doctrine\Inflector\Inflector; use MailPoetVendor\Doctrine\Inflector\InflectorFactory; use MailPoetVendor\Doctrine\ORM\Mapping\ClassMetadata; use MailPoetVendor\Doctrine\ORM\Query\ResultSetMappingBuilder; use MailPoetVendor\Doctrine\Persistence\ObjectRepository; use function array_slice; use function lcfirst; use function sprintf; use function strpos; use function substr; class EntityRepository implements \MailPoetVendor\Doctrine\Persistence\ObjectRepository, \MailPoetVendor\Doctrine\Common\Collections\Selectable { protected $_entityName; protected $_em; protected $_class; private static $inflector; public function __construct(\MailPoetVendor\Doctrine\ORM\EntityManagerInterface $em, \MailPoetVendor\Doctrine\ORM\Mapping\ClassMetadata $class) { $this->_entityName = $class->name; $this->_em = $em; $this->_class = $class; } public function createQueryBuilder($alias, $indexBy = null) { return $this->_em->createQueryBuilder()->select($alias)->from($this->_entityName, $alias, $indexBy); } public function createResultSetMappingBuilder($alias) { $rsm = new \MailPoetVendor\Doctrine\ORM\Query\ResultSetMappingBuilder($this->_em, \MailPoetVendor\Doctrine\ORM\Query\ResultSetMappingBuilder::COLUMN_RENAMING_INCREMENT); $rsm->addRootEntityFromClassMetadata($this->_entityName, $alias); return $rsm; } public function createNamedQuery($queryName) { \MailPoetVendor\Doctrine\Deprecations\Deprecation::trigger('doctrine/orm', 'https://github.com/doctrine/orm/issues/8592', 'Named Queries are deprecated, here "%s" on entity %s. Move the query logic into EntityRepository', $queryName, $this->_class->name); return $this->_em->createQuery($this->_class->getNamedQuery($queryName)); } public function createNativeNamedQuery($queryName) { \MailPoetVendor\Doctrine\Deprecations\Deprecation::trigger('doctrine/orm', 'https://github.com/doctrine/orm/issues/8592', 'Named Native Queries are deprecated, here "%s" on entity %s. Move the query logic into EntityRepository', $queryName, $this->_class->name); $queryMapping = $this->_class->getNamedNativeQuery($queryName); $rsm = new \MailPoetVendor\Doctrine\ORM\Query\ResultSetMappingBuilder($this->_em); $rsm->addNamedNativeQueryMapping($this->_class, $queryMapping); return $this->_em->createNativeQuery($queryMapping['query'], $rsm); } public function clear() { \MailPoetVendor\Doctrine\Deprecations\Deprecation::trigger('doctrine/orm', 'https://github.com/doctrine/orm/issues/8460', 'Calling %s() is deprecated and will not be supported in Doctrine ORM 3.0.', __METHOD__); $this->_em->clear($this->_class->rootEntityName); } public function find($id, $lockMode = null, $lockVersion = null) { return $this->_em->find($this->_entityName, $id, $lockMode, $lockVersion); } public function findAll() { return $this->findBy([]); } public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null) { $persister = $this->_em->getUnitOfWork()->getEntityPersister($this->_entityName); return $persister->loadAll($criteria, $orderBy, $limit, $offset); } public function findOneBy(array $criteria, ?array $orderBy = null) { $persister = $this->_em->getUnitOfWork()->getEntityPersister($this->_entityName); return $persister->load($criteria, null, null, [], null, 1, $orderBy); } public function count(array $criteria) { return $this->_em->getUnitOfWork()->getEntityPersister($this->_entityName)->count($criteria); } public function __call($method, $arguments) { if (\strpos($method, 'findBy') === 0) { return $this->resolveMagicCall('findBy', \substr($method, 6), $arguments); } if (\strpos($method, 'findOneBy') === 0) { return $this->resolveMagicCall('findOneBy', \substr($method, 9), $arguments); } if (\strpos($method, 'countBy') === 0) { return $this->resolveMagicCall('count', \substr($method, 7), $arguments); } throw new \BadMethodCallException(\sprintf('Undefined method "%s". The method name must start with ' . 'either findBy, findOneBy or countBy!', $method)); } protected function getEntityName() { return $this->_entityName; } public function getClassName() { return $this->getEntityName(); } protected function getEntityManager() { return $this->_em; } protected function getClassMetadata() { return $this->_class; } public function matching(\MailPoetVendor\Doctrine\Common\Collections\Criteria $criteria) { $persister = $this->_em->getUnitOfWork()->getEntityPersister($this->_entityName); return new \MailPoetVendor\Doctrine\ORM\LazyCriteriaCollection($persister, $criteria); } private function resolveMagicCall(string $method, string $by, array $arguments) { if (!$arguments) { throw \MailPoetVendor\Doctrine\ORM\ORMException::findByRequiresParameter($method . $by); } if (self::$inflector === null) { self::$inflector = \MailPoetVendor\Doctrine\Inflector\InflectorFactory::create()->build(); } $fieldName = \lcfirst(self::$inflector->classify($by)); if (!($this->_class->hasField($fieldName) || $this->_class->hasAssociation($fieldName))) { throw \MailPoetVendor\Doctrine\ORM\ORMException::invalidMagicCall($this->_entityName, $fieldName, $method . $by); } return $this->{$method}([$fieldName => $arguments[0]], ...\array_slice($arguments, 1)); } } 