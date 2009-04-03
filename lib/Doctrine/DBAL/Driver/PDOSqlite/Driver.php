<?php
/*
 *  $Id$
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\DBAL\Driver\PDOSqlite;

/**
 * The PDO Sqlite driver.
 *
 * @since 2.0
 */
class Driver implements \Doctrine\DBAL\Driver
{
    /**
     * Tries to establish a database connection to SQLite.
     *
     * @param array $params
     * @param string $username
     * @param string $password
     * @param array $driverOptions
     * @return Connection
     */
    public function connect(array $params, $username = null, $password = null, array $driverOptions = array())
    {
        return new \Doctrine\DBAL\Driver\PDOConnection(
            $this->_constructPdoDsn($params),
            $username,
            $password,
            $driverOptions
        );
    }

    /**
     * Constructs the Sqlite PDO DSN.
     *
     * @return string  The DSN.
     * @override
     */
    protected function _constructPdoDsn(array $params)
    {
        $dsn = 'sqlite:';
        if (isset($params['path'])) {
            $dsn .= $params['path'];
        } else if (isset($params['memory'])) {
            $dsn .= ':memory:';
        }
        
        return $dsn;
    }

    /**
     * Gets the database platform that is relevant for this driver.
     */
    public function getDatabasePlatform()
    {
        return new \Doctrine\DBAL\Platforms\SqlitePlatform();
    }

    /**
     * Gets the schema manager that is relevant for this driver.
     *
     * @param Doctrine\DBAL\Connection $conn
     * @return Doctrine\DBAL\Schema\SqliteSchemaManager
     */
    public function getSchemaManager(\Doctrine\DBAL\Connection $conn)
    {
        return new \Doctrine\DBAL\Schema\SqliteSchemaManager($conn);
    }
}