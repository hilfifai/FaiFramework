<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DB
{

    public $conn;
    public $database_provider;
    public $error;
    public function __construct()
    {
        //session_start();
    }
    // public static function connection($page)
    // {
    //     global $conn;
    //     global $host;
    //     global $dbname;
    //     global $user;
    //     global $password;
    //     global $database_provider;

    //     $host = $page['conection_server'];
    //     $dbname = $page['conection_name_database'];
    //     $user = $page['conection_user'];
    //     $password = $page['conection_password'];
    //     $port = isset($page['conection_port']) ? $page['conection_port'] : '5432';
    //     $key = md5($host . $dbname . $user);
    //     $connected = false;

    //     if (isset($page['database_connected']) && $page['database_connected'] === $key) {
    //         $connected = true;
    //     }

    //     if (!$connected) {
    //         $database_provider = $page['database_provider'] ?? 'postgres';
    //         try {
    //             if ($database_provider === 'mysql') {
    //                 $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    //             } else {
    //                 $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    //             }

    //             $pdo = new PDO($dsn, $user, $password);
    //             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //             $conn = $pdo;
    //         } catch (PDOException $e) {
    //             die("Database connection failed: " . $e->getMessage());
    //         }
    //     }

    //     return $key;
    // }
    // public static function query($query, $type = '', $table = '')
    // {
    //     global $conn;
    //     global $queries;
    //     global $database_provider;
    //     global $host, $dbname, $user, $password;

    //     try {
    //         $queries = $query;

    //         if (trim($query)) {
    //             $isModifying = preg_match('/^\s*(INSERT|UPDATE|DELETE)/i', $query);
    //             $result = null;

    //             if ($isModifying) {
    //                 $conn->beginTransaction();

    //                 // Eksekusi query utama
    //                 $affectedRows = $conn->exec($query);

    //                 // Persiapan data historis
    //                 $page['conection_server'] = $host;
    //                 $page['conection_name_database'] = $dbname;
    //                 $page['conection_user'] = $user;
    //                 $page['conection_password'] = $password;
    //                 $page['database_provider'] = $database_provider;

    //                 $ID = DB::lastInsertId($page, $table); // pastikan ini bisa digunakan dengan PDO

    //                 $tipeTransaksi = '';
    //                 if (stripos(trim($query), 'INSERT') === 0) {
    //                     $tipeTransaksi = 'Penambahan';
    //                 } elseif (stripos(trim($query), 'UPDATE') === 0) {
    //                     $tipeTransaksi = 'Perubahan';
    //                 } elseif (stripos(trim($query), 'DELETE') === 0) {
    //                     $tipeTransaksi = 'Penghapusan';
    //                 }

    //                 // Koneksi ke database historis (jika berbeda)
    //                 $pdoLog = new PDO("pgsql:host=$host;dbname=" . $dbname . '_json', $user, $password);
    //                 $pdoLog->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //                 $logQuery = "INSERT INTO apps_data__historis (database_utama, database_id, tipe_transaksi, waktu_perubahan)
    //                          VALUES (:table, :id, :tipe, :waktu)";
    //                 $stmt = $pdoLog->prepare($logQuery);
    //                 $stmt->execute([
    //                     ':table' => $table,
    //                     ':id' => $ID,
    //                     ':tipe' => $tipeTransaksi,
    //                     ':waktu' => date('Y-m-d H:i:s')
    //                 ]);

    //                 $conn->commit();
    //                 return $affectedRows;
    //             } else {
    //                 $stmt = $conn->query($query);
    //                 return $stmt;
    //             }
    //         }
    //     } catch (Exception $e) {
    //         if ($conn && $conn->inTransaction()) {
    //             $conn->rollBack();
    //         }

    //         echo '<pre>';
    //         echo ("Query Execution Failed: " . $e->getMessage() . '<BR> File: ' . $e->getFile() . '<br> Line: ' . $e->getLine());
    //         echo "Stack trace:<br>";

    //         $trace = $e->getTrace();
    //         foreach ($trace as $index => $traceItem) {
    //             echo "#$index " . (isset($traceItem['file']) ? $traceItem['file'] : '[internal function]') .
    //                 " (Line: " . (isset($traceItem['line']) ? $traceItem['line'] : '?') . ")<br>";
    //         }
    //         echo '<br> query:' . $queries;
    //         die;
    //     }

    //     return null;
    // }

    public static function connection($page)
    {
        global $conn, $host, $dbname, $user, $password, $database_provider;
        $host = $page['conection_server'];
        $dbname = $page['conection_name_database'];
        $user = $page['conection_user'];
        $password = $page['conection_password'];
        $port = "5432";
        $key = md5($host . $dbname . $user);
        $conected = false;
        // echo 'KONEKSI';
        if (isset($page['database_connected'])) {
            if (($page['database_connected'] == $key)) {
                $conected = true;
            }
        }
        if (!$conected) {

            $database_provider = isset($page['database_provider']) ? $page['database_provider'] : 'postgres';
            // $database_provider = 'postgres';
            // $database_provider;
            if ($database_provider == 'mysql') {
                $mysqli = mysqli_connect($host, $user, $password, $dbname);
                $mysqli = new mysqli($host, $user, $password, $dbname);
                $conn = $mysqli;
            } else {
                $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
                $pgsql = pg_connect($connection_string);
                $conn = $pgsql;
            }
        }
        return $key;
    }
    public static function getConn()
    {
        global $conn;
        return $conn;
    }
    public static function beginTransaction()
    {
        global $conn, $database_provider;

        if ($database_provider === 'postgres') {
            pg_query($conn, "BEGIN");
        } elseif ($database_provider === 'mysql') {
            mysqli_begin_transaction($conn);
        }
    }

    public static function commit()
    {
        global $conn, $database_provider;

        if ($database_provider === 'postgres') {
            pg_query($conn, "COMMIT");
        } elseif ($database_provider === 'mysql') {
            mysqli_commit($conn);
        }
    }

    public static function rollBack()
    {
        global $conn, $database_provider;

        if ($database_provider === 'postgres') {
            pg_query($conn, "ROLLBACK");
        } elseif ($database_provider === 'mysql') {
            mysqli_rollback($conn);
        }
    }
    public static function query($query, $type = '', $table = '', $transaction = 1)
    {
        global $conn, $queries, $database_provider, $host, $dbname, $user, $password;

        try {
            $queries = $query;
            if (trim($query)) {
                if ($database_provider == 'postgres') {
                    $query = str_replace("`", "", $query);

                    // if ($transaction) {
                    //     pg_query($conn, "BEGIN");
                    // }

                    $result = pg_query($conn, $query);
                    if (!$result) {
                        // if ($transaction) {
                        //     pg_query($conn, "ROLLBACK");
                        // }
                        throw new Exception("Error executing PostgreSQL query: " . pg_last_error($conn));
                    }

                    // logging hanya jika INSERT / UPDATE / DELETE
                    if (preg_match('/^(INSERT|UPDATE|DELETE)/i', $query, $match)) {
                        $page['conection_server'] = $host;
                        $page['conection_name_database'] = $dbname;
                        $page['conection_user'] = $user;
                        $page['conection_password'] = $password;
                        $page['database_provider'] = $database_provider;
                        $ID = DB::lastInsertId($page, $table);

                        // $dbjson = $dbname . '_json';
                        // $userjson = $database_provider=='postgres'?$user:$user . '_json';
                        // $logConn = pg_connect("host=$host dbname=$dbjson user=$userjson password=$password");

                        // $jenis = [
                        //     'INSERT' => 'Penambahan',
                        //     'UPDATE' => 'Perubahan',
                        //     'DELETE' => 'Penghapusan'
                        // ][$match[1]] ?? 'TidakDiketahui';

                        // $logSql = "INSERT INTO apps_data__historis (database_utama, database_id, tipe_transaksi, waktu_perubahan)
                        //        VALUES ('$table', '$ID', '$jenis', '" . date('Y-m-d H:i:s') . "')";
                        // pg_query($logConn, $logSql);
                    }

                    // if ($transaction) {
                    //     pg_query($conn, "COMMIT");
                    // }

                    return $result;
                } else {
                    // MySQL
                    $result = $conn->query($query);
                    if (!$result) throw new Exception($conn->error);
                    return $result;
                }
            }
        } catch (Exception $e) {
            echo '<pre>';
            echo ("Query Execution Failed: " . $e->getMessage() . '<BR> FIle' . $e->getFile() . '<br> Line:' . $e->getLine());
            echo "Stack trace:<br>";

            // Menampilkan seluruh stack trace, termasuk file-file yang dipanggil sebelumnya
            $trace = $e->getTrace();
            foreach ($trace as $index => $traceItem) {
                echo "#$index " . (isset($traceItem['file']) ? $traceItem['file'] : '[internal function]') .
                    " (Line: " . (isset($traceItem['line']) ? $traceItem['line'] : '?') . ")<br>";
            }
            echo '<br> query(' . $dbname . '):' . $queries;
            die;
        }
    }

    public static function query2($query, $type = '', $table = '')
    {

        global $conn;
        global $queries;
        global $database_provider;
        global $host;
        global $dbname;
        global $user;
        global $password;

        try {
            // echo $query;
            $queries = $query;
            // $query;
            $database_provider;
            if (trim($query)) {
                if ($database_provider == 'postgres') {
                    $result = pg_query($conn, str_replace("`", "", $query));
                    if (!$result) {
                        throw new Exception("Error executing PostgreSQL query: " . pg_last_error($conn) . " on query($dbname) " . $query);
                    } else {
                        if (substr($query, 0, strlen('INSERT')) == 'INSERT') {

                            $page['conection_server'] = $host;
                            $page['conection_name_database'] = $dbname;
                            $page['conection_user'] = $user;
                            $page['conection_password'] = $password;
                            $page['database_provider'] = $database_provider;
                            $ID = DB::lastInsertId($page, $table);
                            $pdo = $pdoPg = new PDO("pgsql:host=$host dbname=" . $dbname . '_json', $user, $password);
                            $insertSql = "INSERT INTO apps_data__historis (database_utama, database_id, tipe_transaksi, waktu_perubahan)
                            VALUES ('$table', '$ID', 'Penambahan', '" . date('Y-m-d H:i:s') . "')";
                            try {

                                $pdo->exec($insertSql);
                            } catch (PDOException $e) {

                                echo "Gagal: " . $e->getMessage();
                            }
                        } else
                        if (substr($query, 0, strlen('UPDATE')) == 'UPDATE') {

                            $page['conection_server'] = $host;
                            $page['conection_name_database'] = $dbname;
                            $page['conection_user'] = $user;
                            $page['conection_password'] = $password;
                            $page['database_provider'] = $database_provider;
                            $ID = DB::lastInsertId($page, $table);
                            $pdo = $pdoPg = new PDO("pgsql:host=$host dbname=" . $dbname . '_json', $user, $password);
                            $insertSql = "INSERT INTO apps_data__historis (database_utama, database_id, tipe_transaksi, waktu_perubahan)
                            VALUES ('$table', '$ID', 'Perubahan', '" . date('Y-m-d H:i:s') . "')";
                            try {

                                $pdo->exec($insertSql);
                            } catch (PDOException $e) {

                                echo "Gagal: " . $e->getMessage();
                            }
                        } else
                        if (substr($query, 0, strlen('DELETE')) == 'DELETE') {

                            $page['conection_server'] = $host;
                            $page['conection_name_database'] = $dbname;
                            $page['conection_user'] = $user;
                            $page['conection_password'] = $password;
                            $page['database_provider'] = $database_provider;
                            $ID = DB::lastInsertId($page, $table);
                            $pdo = $pdoPg = new PDO("pgsql:host=$host dbname=" . $dbname . '_json', $user, $password);
                            $insertSql = "INSERT INTO apps_data__historis (database_utama, database_id, tipe_transaksi, waktu_perubahan)
                            VALUES ('$table', '$ID', 'Penghapusan', '" . date('Y-m-d H:i:s') . "')";
                            try {

                                $pdo->exec($insertSql);
                            } catch (PDOException $e) {

                                echo "Gagal: " . $e->getMessage();
                            }
                        }
                    }
                    return $result;
                } else {
                    $result = $conn->query($query);
                    if (!$result) {
                        throw new Exception("<pre>Error executing MySQL query: <br> " . $conn->error);
                    }
                    return $result;
                }
            }

            //  return !$conn->query($query)?$conn->query($query):$conn->error;

        } catch (Exception $e) {
            echo '<pre>';
            echo ("Query Execution Failed: " . $e->getMessage() . '<BR> FIle' . $e->getFile() . '<br> Line:' . $e->getLine());
            echo "Stack trace:<br>";

            // Menampilkan seluruh stack trace, termasuk file-file yang dipanggil sebelumnya
            $trace = $e->getTrace();
            foreach ($trace as $index => $traceItem) {
                echo "#$index " . (isset($traceItem['file']) ? $traceItem['file'] : '[internal function]') .
                    " (Line: " . (isset($traceItem['line']) ? $traceItem['line'] : '?') . ")<br>";
            }
            echo '<br> query:' . $queries;
            die;


            return null;
        }
    }

    /**
     * Execute prepared queries.
     *
     * @param string $query      → query
     * @param array  $statements → array with prepared parameters
     *
     * @return object|null → returns the object with the connection or null
     */
    public static function last_query()
    {
        global $queries;
        return $queries;
    }
    public static function statements($query, $statements)
    {
        try {
            global $conn;
            $query = $conn->prepare($query);

            foreach ($statements as $key => $value) {
                $param = $statements[$key][0];
                $value = $statements[$key][1];
                $ifExists = (isset($statements[$key][2]));
                $dataType = $ifExists ? $statements[$key][2] : false;

                switch ($dataType) {
                    case 'bool':
                    case 'boolean':
                        $query->bindValue($param, $value, \PDO::PARAM_BOOL);
                        break;
                    case 'null':
                        $query->bindValue($param, $value, \PDO::PARAM_NULL);
                        break;
                    case 'int':
                    case 'integer':
                        $query->bindValue($param, $value, \PDO::PARAM_INT);
                        break;
                    case 'str':
                    default:
                        $query->bindValue($param, $value, \PDO::PARAM_STR);
                        break;
                    case false:
                        $query->bindValue($param, $value);
                        break;
                }
            }

            $query->execute();

            return $query;
        } catch (\PDOException $e) {
            echo '<pre>';
            echo ("Prepared Query Execution Failed: " . $e->getMessage() . '<BR> FIle' . $e->getFile() . '<br> Line:' . $e->getLine());

            return null;
        }
    }
    public static function getColumnListing($page, $database_provider, $database_utama, $return_result = null)
    {
        if (substr(trim($database_utama), 0, 1) == '(') {
        } else
        if ($database_utama) {
            DB::connection($page);
            $schame = $page['conection_scheme'];
            $database_provider;
            if ($database_provider == 'postgres') {
                $query = "SELECT attname AS field, format_type(atttypid, atttypmod) AS type
                    FROM   pg_attribute
                    WHERE  attrelid = '$schame.$database_utama'::regclass
                    -- AND    NOT attisdropped
                    -- AND    attnum > 0
                    ORDER  BY attnum;";
            } else {

                $query = "SHOW COLUMNS FROM $database_utama;";
            }
            $data = DB::fetchResponse(DB::query(trim($query), 'SELECT'));
            $type = [];
            foreach ($data as $list) {
                if ($database_provider == 'mysql') {
                    $list->type = $list->Type;
                    $list->field = $list->Field;
                }
                $to_type = explode("(", $list->type);
                $list->type = $to_type[0];
                if ($database_provider == 'postgres') {
                    $column[] = $list->field;
                    $type[$list->field] = $list->type;
                } else {
                    $column[] = $list->field;
                    $type[$list->field] = $list->type;
                }
            }
            if ($return_result) {
                return $type;
            } else
                return $column;
        }
        return array();
    }
    public static function select($querys, $statements = '')
    {

        $query = $querys;
        if ($query) {
            $query = str_replace('`', '', $query); // Buang backtick dari MySQL-style syntax
            return DB::query(trim($query), 'SELECT');
        } else
            return null;
    }

    public static function select_object($querys, $statements = '')
    {

        $query = $querys;
        if ($query)
            return DB::fetchResponse(DB::query(trim($query), 'SELECT'));
        else
            return null;
    }
    public static function select_database($columns = '', $from = '', $where = '', $order = '', $limit = '', $statements = '')
    {
        $query = 'SELECT ';
        $query .= (is_array($columns)) ? implode(', ', $columns) : $columns;
        $query .= ' FROM `' . $from . '` ';
        $query .= (!is_null($where)) ? ' WHERE ' : '';
        $query .= (is_string($where)) ? $where . ' ' : '';

        if (is_array($where)) {
            foreach ($where as $clause) {
                $query .= $clause . ' AND ';
            }
            $query = rtrim(trim($query), 'AND');
        }

        $query .= (!is_null($order)) ? ' ORDER BY ' : '';
        $query .= (is_string($order)) ? $order . ' ' : '';

        if (is_array($order)) {
            foreach ($order as $value) {
                $query .= $value . ', ';
            }
            $query = rtrim(trim($query), ',');
        }

        $query .= (!is_null($limit)) ? ' LIMIT ' : '';
        $query .= (is_int($limit)) ? $limit . ' ' : '';

        if (!is_null($statements) && is_array($statements)) {
            return DB::statements(trim($query), $statements);
        }

        return DB::query(trim($query), 'SELECT');
    }
    /**
     * Insert into statement.
     *
     * @param string $table      → table name
     * @param array  $data       → column name and value
     * @param array  $statements → array with prepared parameters
     *
     * @return object → query response
     */
    public static function insert($table, $data, $statements = null)
    {
        $input = [
            'columns' => '',
            'values' => ''
        ];

        $query = 'INSERT INTO `' . $table . '` ';

        foreach ($data as $column => $value) {
            $input['columns'] .= $column . ', ';

            $value = (is_null($statements) && is_string($value)) ? "'$value'" : $value;

            $value = is_null($value) ? 'NULL' : $value;
            $value = is_bool($value) ? ($value ? 'true' : 'false') : $value;

            $input['values'] .= $value . ', ';
        }

        $query .= '(' . rtrim(trim($input['columns']), ',') . ') ';

        $query .= 'VALUES (' . rtrim(trim($input['values']), ',') . ')';

        if (!is_null($statements) && is_array($statements)) {
            return DB::statements($query, $statements);
        }
        $query = str_replace('`', '', $query); // Buang backtick dari MySQL-style syntax
        return DB::query($query, 'INSERT', $table);
    }

    /**
     * Update statement.
     *
     * @param string $table      → table name
     * @param array  $data       → column name and value
     * @param array  $statements → array with prepared parameters
     * @param mixed  $where      → where clauses
     *
     * @return object → query response
     */
    public static function update($table, $data,  $where, $statements = null)
    {

        $query = 'UPDATE `' . $table . '`  SET ';

        // $columns = DB::getColumnListing($page, $page['database_provider'], $database_utama_sub_kategori);
        foreach ($data as $column => $value) {
            $value = (is_null($statements) && is_string($value)) ? "'$value'" : $value;

            $value = is_null($value) ? 'NULL' : $value;
            $value = is_bool($value) ? ($value ? 'true' : 'false') : $value;

            $query .= $column . '=' . $value . ', ';
        }

        $query = rtrim(trim($query), ',');

        $query .= (!is_null($where)) ? ' WHERE ' : '';

        $query .= (is_string($where)) ? $where . ' ' : '';

        if (is_array($where)) {
            if ($statements == 'Where Array') {
                for ($i = 0; $i < count($where); $i++) {
                    $query .= $where[$i][0] . $where[$i][1] . $where[$i][2] . ' AND ';
                }
            } else {
                foreach ($where as $clause) {
                    $query .= $clause . ' AND ';
                }
            }
            $query = rtrim(trim($query), 'AND');
        }

        // echo $query;

        return DB::query($query, '', $table);
    }

    /**
     * Replace a row in a table if it exists or insert a new row if not exist.
     *
     * @param string $table      → table name
     * @param array  $data       → column name and value
     * @param array  $statements → array with prepared parameters
     *
     * @return object → query response
     */
    public function replace($table, $data, $statements)
    {
        $columns = array_keys($data);
        $columnIdName = $columns[0];

        if (isset($statements[0][1]) && count($data) == count($statements)) {
            $id = $statements[0][1];
        } else {
            $id = array_shift($data);
        }

        $where = $columnIdName . ' = ' . $id;

        $result = $this->select(
            $columns,
            $table,
            $where,
            null,
            1,
            $statements
        );

        if ($this->rowCount($result)) {
            return $this->update($table, $data, $statements, $where);
        }

        return $this->insert($table, $data, $statements);
    }

    /**
     * Delete statement.
     *
     * @param string $table      → table name
     * @param array  $statements → array with prepared parameters
     * @param mixed  $where      → where clauses
     *
     * @return object → query response
     */
    public static function delete($table,  $where)
    {
        $query = 'DELETE FROM `' . $table . '` ';

        $query .= (!is_null($where)) ? ' WHERE ' : '';

        $query .= (is_string($where)) ? $where . ' ' : '';

        if (is_array($where)) {
            foreach ($where as $clause) {
                $query .= $clause . ' AND ';
            }

            $query = rtrim(trim($query), 'AND');
        }



        return DB::query($query, 'INSERT');
    }

    /**
     * Truncate table statement.
     *
     * @param string $table → table name
     *
     * @return int → 0
     */
    public function truncate($table)
    {
        $query = 'TRUNCATE TABLE `' . $table . '`';

        return $this->query($query);
    }

    /**
     * Drop table statement.
     *
     * @param string $table → table name
     *
     * @return int → 0
     */
    public function drop($table)
    {
        $query = 'DROP TABLE IF EXISTS `' . $table . '`';

        return $this->query($query);
    }

    /**
     * Process query as object or numeric or associative array.
     *
     * @param object $response → query result
     * @param string $result   → result as an object or array
     *
     * @return object|array → object or array with results
     */
    // public static function fetchResponse($response, $result = 'obj')
    // {
    //     global $conn;
    //     global $query;
    //     global $database_provider;

    //     if (!$response) {
    //         echo "<span style='color:red'>" . ($conn->errorInfo()[2] ?? 'Unknown Error') . "</span> 
    //           <span style='color:blue'><pre>on query(\n\n" . $query . "\n\n)</pre></span>";
    //         die;
    //     }

    //     try {
    //         switch ($result) {
    //             case 'obj':
    //                 $return = $response->fetchAll(PDO::FETCH_OBJ);
    //                 break;

    //             case 'array_num':
    //                 $return = $response->fetchAll(PDO::FETCH_NUM);
    //                 break;

    //             case 'array_assoc':
    //                 $return = $response->fetchAll(PDO::FETCH_ASSOC);
    //                 break;

    //             case 'num_rows':
    //                 $return = $response->rowCount();
    //                 break;

    //             default:
    //                 $return = $response->fetchAll(PDO::FETCH_OBJ);
    //         }

    //         return json_decode(json_encode($return));
    //     } catch (PDOException $e) {
    //         echo "<span style='color:red'>PDO Exception: " . $e->getMessage() . "</span> 
    //           <span style='color:blue'><pre>on query(\n\n" . $query . "\n\n)</pre></span>";
    //         die;
    //     }
    // }

    public static function fetchResponse($response, $result = 'obj')
    {
        global $database_provider;
        if ($response) {
            if ($database_provider == 'postgres') {
                if ($result == 'obj')
                    $return =  pg_fetch_all($response);
                else  if ($result == 'num_rows')
                    $return =  pg_num_rows($response);
            } else {


                if ($result == 'obj') {
                    $return =  $response->fetch_all(MYSQLI_ASSOC);
                } elseif ($result == 'array_num') {
                    $return = $response->fetchAll(\PDO::FETCH_NUM);
                } elseif ($result == 'array_assoc') {
                    $return = $response->fetchAll(\PDO::FETCH_ASSOC);
                } elseif ($result == 'num_rows') {
                    $return = $response->num_rows;
                }
            }
        } else {
            global $conn;
            global $query;;
            echo "<span style='color:red'>" . $conn->error . "</span> <span style='color:blue'><pre>on query(

            " . $query . "

            )></pre></span>";
            die;
        }
        return json_decode(json_encode($return));
    }

    /**
     * Get the last id of the query object.
     *
     * @return int → last row id modified or added
     */
    // public static function lastInsertId($page, $database_utama)
    // {
    //     global $conn;

    //     if ($page['database_provider'] === 'mysql') {
    //         return (int) $conn->lastInsertId();
    //     } elseif ($page['database_provider'] === 'postgres' && $database_utama) {
    //         // Misalnya ada sequence bernama seq_namatabel
    //         $stmt = $conn->query("SELECT last_value FROM seq_$database_utama");
    //         $row = $stmt->fetch(PDO::FETCH_OBJ);
    //         return (int) $row->last_value;
    //     }

    //     return null;
    // }

    public static function lastInsertId($page, $database_utama)
    {
        global $conn;
        if ($page['database_provider'] == 'mysql')
            return (int) $conn->insert_id;
        else if ($database_utama)
            return (DB::fetchResponse(DB::query("select * from seq_$database_utama", 'SELECT')))[0]->last_value;
    }

    /**
     * Get rows number.
     *
     * @param object $response → query result
     *
     * @return int → rows number in query object
     */
    public function rowCount($response)
    {
        if (is_object($response)) {
            return (int) $response->rowCount();
        }

        return (int) $response;
    }

    /**
     * Get errors.
     *
     * @return string → get the message if there has been any error
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Check database connection state.
     *
     * @return bool true|false → check the connection and return true or false
     */
    public function isConnected()
    {
        return !is_null($this->conn);
    }

    /**
     * Close/delete database connection.
     */
    public function kill()
    {
        $this->conn = null;
    }

    public static function get_clear()
    {
        global $db;
        $db_get = $db;
        unset($db);
        return $db_get;
    }
    public static function set_db($to_db)
    {
        global $db;
        $db = $to_db;
    }
    public static function table($table)
    {
        global $db;
        $db['table'] = $table;
    }
    public static function selectRaw($select)
    {
        global $db;
        $db['select'][] = $select;
    }
    public static function whereRaw($where)
    {
        global $db;
        $db['where'][] = $where;
    }
    public static function whereRawPage($page, $where)
    {
        global $db;
        $db['where'][] = Database::string_database($page, new MainFaiFramework(), $where);
    }
    public static function joinRaw($join, $mode = '')
    {
        global $db;
        $db['join'][] = $join;
        $db['mode_join'][] = $mode;
    }
    public static function withRaw($join, $mode = '')
    {
        global $db;

        $db['with'][] = $join;
    }
    public static function procedureRaw($join, $mode = '')
    {
        global $db;

        $db['procedure'][] = $join;
    }
    public static function functionRaw($join, $mode = '')
    {
        global $db;

        $db['function'][] = $join;
    }
    public static function viewRaw($join, $mode = '')
    {
        global $db;

        $db['view'][] = $join;
    }
    public static function limitRaw($page, $start, $total_from_start = '')
    {
        global $db;
        $page['database_provider'] = isset($page['database_provider']) ? $page['database_provider'] : 'mysql';
        if ($total_from_start < 0) {
            $total_from_start = 0;
        }
        if ($page['database_provider'] == 'mysql') {
            if ($total_from_start)
                $db['limit'] = "$start,$total_from_start";
            else
                $db['limit'] = "$start";
        } else {
            if ($total_from_start)
                $db['limit'] = "$start offset $total_from_start";
            else
                $db['limit'] = "$start";
        }
    }
    public static function orderRaw($page, $order_by)
    {
        global $db;
        $fai = new MainFaiFramework();
        $order_by = Database::string_database($page, $fai, $order_by);;
        $db['order'][] = array($order_by);
    }
    public static function orderByRaw($page, $order_by)
    {
        global $db;
        $fai = new MainFaiFramework();
        for ($i = 0; $i < count($order_by); $i++) {
            $order_by[$i][0] = Database::string_database($page, $fai, $order_by[$i][0]);;
            $db['order'][] = $order_by[$i];
        }
    }
    public static function orderByFilterRaw($page, $order_by)
    {
        global $db;
        $fai = new MainFaiFramework();
        $order_by = Database::string_database($page, $fai, $order_by);;
        $db['order_filter'] = $order_by;
    }
    public static function groupByRaw($page, $group_by)
    {
        global $db;
        $fai = new MainFaiFramework();
        for ($i = 0; $i < count($group_by); $i++) {

            $db['group'][] = Database::string_database($page, $fai, $group_by[$i]);;;;
        }
    }
    public static function queryRaw($page, $queryRaw)
    {
        global $db;

        $fai = new MainFaiFramework();

        $db['query'] = Database::string_database($page, $fai, $queryRaw);;
    }
    public static function get($exec = 'exec', $page = [])
    {
        global $db;
        global $query;
        global $conn;
        global $host;
        global $dbname;
        global $user;
        global $password;
        global $database_provider;
        $select = '';
        // if($page){
        //      $page['conection_name_database'];
        //     DB::connection($page); 
        // }
        // print_R($db);
        $page['load']['database']['id'] = $page['load']['database']['id'] ?? [
            'text'     => 'id',
            'type'     => 'prefix',
            'on_table' => false,
        ];

        $select_udah = [];
        if (isset($db['select'][0])) {
            for ($i = 0; $i < count($db['select']); $i++) {
                if (isset($db['select'][$i]) and !in_array($db['select'][$i], $select_udah)) {
                    $select_udah[] = $db['select'][$i];
                    if ($select)
                        $select .= ',
                     ';
                    $select .= $db['select'][$i];
                }
            }
        }
        $where[] = '';
        if (isset($db['where'][0])) {
            //$db['where'] = array_unique($db['where']);
            for ($i = 0; $i < count($db['where']); $i++) {
                if (isset($db['where'][$i])) {
                    if (($db['where'][$i])) {


                        $where[] = '
                        ' . $db['where'][$i];
                    }
                }
            }
        }
        $where = array_filter($where);
        $where = implode(' AND ', $where);
        $join = '';
        if (isset($db['join'][0])) {
            $db['join'] = array_unique($db['join']);
            foreach ($db['join'] as $i => $getjoin) {
                if ($db['join'][$i])
                    $join .= '
                  ' . strtoupper($db['mode_join'][$i]) . ' JOIN ' . $db['join'][$i];
            }
        }
        $order = "";
        if (isset($db['order'][0])) {
            // $db['order']= array_unique($db['order']);
            for ($i = 0; $i < count($db['order']); $i++) {
                if ($order)
                    $order .= ',';
                if ($db['order'][$i][0])
                    $order .= '
                  ' . ($db['order'][$i][0]) . ' ' . (isset($db['order'][$i][1]) ? $db['order'][$i][1] : '');
            }
        }
        $order_filter = "";
        if (isset($db['order_filter'])) {
            $order = $db['order_filter'];
        }
        $group = "";
        if (isset($db['group'][0])) {
            // $db['group']= array_unique($db['group']);
            for ($i = 0; $i < count($db['group']); $i++) {
                if ($group)
                    $group .= ',';
                if ($db['group'][$i])
                    $group .= '  ' . ($db['group'][$i]) . ' ';
            }
        }

        if (!$select)
            $select = '*';

        if (!isset($db['query'])) {
            $query = "SELECT 
                $select ";
            $query_non_limit = "SELECT count(*) as count";
            if (!empty($db['table'])) {
                $query .= " 
                FROM " . $db['table'] . ' ';
                $query_non_limit .= " FROM " . $db['table'] . "";
                $query .= $join;
                $query_non_limit .= $join;
                if ($where) {
                    $query .= "
                 WHERE $where ";
                    $query_non_limit .= "
                 WHERE $where ";
                }
                if ($group) {
                    $query .= "
                 GROUP BY $group ";
                    $query_non_limit .= "
                  GROUP BY $group ";
                }
                if ($order) $query .= "
                 ORDER BY $order ";
            }
            $non_limit = 1;
        } else {
            $query = $db['query'];

            if ($where) $where = " WHERE $where ";

            $query = str_replace('|WHERE|', $where, $query);
            $query_non_limit =  "$query";
            $non_limit = 2;
        }

        $limit = "";
        if (isset($db['limit']))
            $limit = $db['limit'];


        if ($limit) $query .= "  LIMIT $limit ";



        if (isset($db['with'])) {

            // foreach($db['with'] as $with){
            //     $query = '
            //     '.$with.$query;
            // }
            $query = 'WITH 
            ' . implode(',', $db['with']) . $query;
        }
        if (isset($db['procedure'])) {
            $procedure = "";
            for ($i = 0; $i < count($db['procedure']); $i++) {
                $procedure_query = $db['procedure'][$i][0];
                $procedure_name = $db['procedure'][$i][1];
                $parameter = $db['procedure'][$i][2];
                $fieldparameter = $db['procedure'][$i][3];
                $procedure_query = str_replace("<PROCEDURE-WHERE>", "$fieldparameter=$parameter", $procedure_query);
                if ($database_provider == 'postgres') {
                    $procedure .= "CREATE OR REPLACE PROCEDURE $procedure_name(
                    $parameter INTEGER
                )
                LANGUAGE SQL
                AS $$
                    $procedure_query
                $$;";
                } else {

                    $procedure .= 'DELIMITER $$
                    
                    DROP PROCEDURE IF EXISTS ' . $procedure_name . '$$
                    
                    CREATE PROCEDURE ' . $procedure_name . '(IN ' . $parameter . ' INT)
                    BEGIN
                      ' . $procedure_query . ';
                    END$$
                    
                    DELIMITER ;
                    
                    ';
                }
            }

            // $query =$procedure.$query;
        }
        if (isset($db['function'])) {
            $procedure = "";
            for ($i = 0; $i < count($db['function']); $i++) {
                $procedure_query = $db['function'][$i][0];
                $procedure_name = $db['function'][$i][1];
                $parameter = $db['function'][$i][2];
                $fieldparameter = $db['function'][$i][3];
                $procedure_query = str_replace("<PROCEDURE-WHERE>", "$fieldparameter=$parameter", $procedure_query);
                if ($database_provider == 'postgres') {
                    $procedure .= "CREATE OR REPLACE PROCEDURE $procedure_name(
                    $parameter INTEGER
                )
                LANGUAGE SQL
                AS $$
                    $procedure_query
                $$;";
                } else {

                    $procedure .= 'DELIMITER $$
                    
                    DROP FUNCTION IF EXISTS ' . $procedure_name . '$$
                    
                    CREATE FUNCTION ' . $procedure_name . '(IN ' . $parameter . ' INT)
                    BEGIN
                      ' . $procedure_query . ';
                    END$$
                    
                    DELIMITER ;
                    
                    ';
                }
            }
            $procedure;
            // $query =$procedure.$query;
        }
        if (isset($db['view'])) {
            for ($i = 0; $i < count($db['view']); $i++) {
                $procedure = "";
                $procedure_query = $db['view'][$i][0];
                $procedure_name = $db['view'][$i][1];
                $parameter = $db['view'][$i][2];
                $fieldparameter = $db['view'][$i][3];
                $procedure_query = str_replace("<PROCEDURE-WHERE>", "1=1", $procedure_query);
                if ($database_provider == 'postgres') {
                    $procedure .= "CREATE OR REPLACE PROCEDURE $procedure_name(
                    $parameter INTEGER
                )
                LANGUAGE SQL
                AS $$
                    $procedure_query
                $$;";
                } else {

                    $procedure .= 'CREATE VIEW IF NOT EXISTS ' . $procedure_name . ' as 
                      ' . $procedure_query . ';
                    
                
                    ';
                }
                // DB::query(trim($procedure), 'SELECT');
            }

            // $query =$procedure.$query;
        }
        $db = array();
        $query = str_replace('`', '', $query); // Buang backtick dari MySQL-style syntax
        //  echo $query;
        // echo '<br>';
        if ($exec == 'source')
            return $query;
        else if ($exec == 'all') {
            $get = DB::query(trim($query), 'SELECT');
            $get_non_limit = DB::query(trim($query_non_limit), 'SELECT');
            $return['utama'] =  isset($db['table']) ? $db['table'] : '';
            $return['row'] =  DB::fetchResponse($get);
            // $return['row_non_limit'] =  DB::fetchResponse($get_non_limit);

            $return['result'] =  ($get);
            $return['num_rows'] =  DB::fetchResponse($get, 'num_rows');;
            if ($non_limit == 1)
                $return['num_rows_non_limit'] =  DB::fetchResponse($get_non_limit)[0]->count;;
            if ($non_limit == 2)
                $return['num_rows_non_limit'] =  DB::fetchResponse($get_non_limit, 'num_rows');;
            $return['db'] =  ($db);

            $return['query'] =  ($query);
            if ($database_provider == 'postgres') {
                pg_close($conn);


                $page['conection_server'] = $host;
                $page['conection_name_database'] = $dbname;
                $page['conection_user'] = $user;
                $page['conection_password'] = $password;
                DB::connection($page);
            } else {
                //   // mysqli_close($conn);


                //     $page['conection_server'] = $host;
                //     $page['conection_name_database'] = $dbname;
                //     $page['conection_user'] = $user;
                //     $page['conection_password'] = $password;
                //     DB::connection($page);
            }
            return $return;
        } else {

            $return = DB::fetchResponse(DB::query(trim($query), 'SELECT'));
            if ($database_provider == 'postgres') {
                pg_close($conn);


                $page['conection_server'] = $host;
                $page['conection_name_database'] = $dbname;
                $page['conection_user'] = $user;
                $page['conection_password'] = $password;
                DB::connection($page);
            }
            return $return;
        }
    }
}
