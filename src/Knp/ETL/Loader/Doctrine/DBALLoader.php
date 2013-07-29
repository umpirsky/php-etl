<?php

namespace Knp\ETL\Loader\Doctrine;

use Doctrine\DBAL\Connection;
use Knp\ETL\ContextInterface;

/**
 * @author     Florian Klein <florian.klein@free.fr>
 */
class DBALLoader
{
    private $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    public function load($data, ContextInterface $context)
    {
        if ($id = $context->getIdentifier()) {
            return $this->conn->update($context->getTableName(), $data, ['id' => $id]);
        }

        // @TODO get id
        //$context->setIdentifier($id);
        //$data['id'] = $this->conn->fetchColumn("SELECT NEXTVAL('fos_user_id_seq')", [], 0);

        return $this->conn->insert($context->getTableName(), $data);
    }
}

