<?php
namespace App\Models;
class DBCommon {
    /**
     *  INSERT用の文字列を返す
     *
     * @param   array   &$insertAry  インサート用の配列
     * @return  array   作成した項目と値
     */
    public function makeInsertStr(&$insertAry)
    {
        // 初期化
        $insertColStr = '';
        $insertDataStr = '';
        $insertValue = array();

        // 空でなければ(事前にエスケープ処理)
        if (!empty($insertAry)) {
            foreach ($insertAry as $key => $value) {
                $insertColStr .= $key . ',';
                $insertDataStr .= '?' . ',';
                array_push($insertValue, $value);
            }
            // 最後のカンマを外す
            $insertColStr = rtrim($insertColStr, ',');
            $insertDataStr = rtrim($insertDataStr, ',');
        }

        return array(
            'insertColStr' => $insertColStr,
            'insertDataStr' => $insertDataStr,
            'insertValue' => $insertValue
            );
    }

    /**
     *  UPDATE用の文字列を返す
     *
     * @param   array   &$updateAry  インサート用の配列
     * @return  string   作成した項目と値
     */
    public function makeUpdateStr(&$updateAry)
    {
        // 初期化
        $updateStr = '';

        // 空でなければ(事前にエスケープ処理)
        if (!empty($updateAry)) {
            foreach ($updateAry as $key => $value) {
                $updateStr .= $key . ' =  ?, ';
            }
            // 最後のカンマを外す
            $updateStr = rtrim($updateStr, ', ');
        }

        return $updateStr;
    }

    /**
     *  WHERE句作成
     *  ※LIKE検索はできない
     *
     *  @param array &$whereAry array('key' => 'value')
     *  @retrun string $whereStr
     */
    public function makeWhereStr(&$whereAry)
    {
        // 初期化
        $whereStr = '';

        // where句を作成(事前にエスケープ処理)
        if (!empty($whereAry)) {
            $count = 0;
            foreach ($whereAry as $key => $value) {
                $hasOperator = strpos($key, " ") !== false;

                if ($count == 0) {
                    if ($hasOperator) {
                        $whereStr .= " WHERE {$key} ? ";
                    } else {
                        $whereStr .= " WHERE {$key} = ? ";
                    }
                } else {
                    if ($hasOperator) {
                        $whereStr .= " AND {$key} ? ";
                    } else {
                        $whereStr .= " AND {$key} = ? ";
                    }
                }
                $count++;
            }
        }
        return $whereStr;
    }

    /**
     *  LIMIT句作成
     *
     *  @param array &$limitAry array('offset' =>,'maxRec'=>)
     *  @return void
     */
    public function makeLimitStr(&$limitAry)
    {
        // 初期化
        $limit = '';

        // limit句を作成
        if (!empty($limitAry)) {

            $limit = " LIMIT {$limitAry['offset']} , {$limitAry['maxRec']}";
        }

        return $limit;
    }

    /**
     *  ORDER BY 句作成
     *
     *  @param array $orderByArray (DESC, ACS)
     *  @return void
     */
    public function makeOrderByStr(&$orderByArray)
    {
        // 初期化
        $orderBy = '';

        if (!empty($orderByArray['field'])) {
            $orderBy = ' ORDER BY ' . $orderByArray['field'];
            if ($orderByArray['type'] == 'DESC') {
                $orderBy .= ' ' . $orderByArray['type'];
            }
        }

        return $orderBy;
    }   

    /**
     * Make field clause of query
     * @param array $fields array of fields, should be with table name before each fields
     * @return string
     */
    public function makeFieldsClause($fields)
    {
        $fieldsClause = implode(', ', $fields);
        return $fieldsClause;
    }

    /**
     * Make where clause of query
     * @param array $conditions array of conditions of query, there 3 formats:
     * @param array $params reference array of values, that will be bind to query
     * @return string
     */
    public function makeWhereClause($conditions, &$params)
    {
        $whereClause = ' WHERE 1 = 1';
        if (!empty($conditions)) {
            $whereClause = array();
            foreach ($conditions as $k => $v) {
                if ($k == 'OR' && is_array($v)) {
                    $orClause = array();
                    foreach ($v as $orK => $orV) {
                        $orClause[] = $this->__makeOperatorSegment($orK, $orV, $params);
                    }
                    $whereClause[] = '(' . implode(' OR ', $orClause) . ')';
                } elseif (strpos ($k, 'NOT IN') !== false) {
                    if (is_array($v)) {
                        $notInClause = array();
                        foreach ($v as $notInV) {
                            $notInClause[] = '?';
                            array_push($params, $notInV);
                        }
                        $whereClause[] = $k . ' ' . '(' . implode(', ', $notInV) . ')';
                    } else {
                        $whereClause[] = $k . ' ' . '(' . $v . ')';
                    }
                } elseif (strpos ($k, 'BETWEEN') !== false && is_array($v)) {
                    $betwClause = array();
                    foreach ($v as $betwV) {
                        $betwClause[] = '?';
                        array_push($params, $betwV);
                    }
                    $whereClause[] = $k . ' ' . implode(' AND ', $betwClause);
                } elseif (is_array($v)) {
                    $inClause = array();
                    foreach ($v as $inV) {
                        $inClause[] = '?';
                        array_push($params, $inV);
                    }
                    $whereClause[] = $k . ' IN (' . implode(', ', $inClause) . ')';
                } else {
                    $whereClause[] = $this->__makeOperatorSegment($k, $v, $params);
                }
            }
            $whereClause = ' WHERE ' . implode(' AND ', $whereClause);
        }

        return $whereClause;
    }
    /**
     * Make having clause of query
     * @param array $conditions array of conditions of query, there 3 formats:
     * @param array $params reference array of values, that will be bind to query
     * @return string
     */
    public function makeHavingClause($conditions, &$params)
    {
        $havingClause = ' HAVING 1 = 1';
        if (!empty($conditions)) {
            $havingClause = array();
            foreach ($conditions as $k => $v) {
                if ($k == 'OR' && is_array($v)) {
                    $orClause = array();
                    foreach ($v as $orK => $orV) {
                        $orClause[] = $this->__makeOperatorSegment($orK, $orV, $params);
                    }
                    $havingClause[] = '(' . implode(' OR ', $orClause) . ')';
                } elseif (strpos ($k, 'NOT IN') !== false) {
                    if (is_array($v)) {
                        $notInClause = array();
                        foreach ($v as $notInV) {
                            $notInClause[] = '?';
                            array_push($params, $notInV);
                        }
                        $havingClause[] = $k . ' ' . '(' . implode(', ', $notInV) . ')';
                    } else {
                        $havingClause[] = $k . ' ' . '(' . $v . ')';
                    }
                } elseif (is_array($v)) {
                    $inClause = array();
                    foreach ($v as $inV) {
                        $inClause[] = '?';
                        array_push($params, $inV);
                    }
                    $havingClause[] = $k . ' IN (' . implode(', ', $inClause) . ')';
                } else {
                    $havingClause[] = $this->__makeOperatorSegment($k, $v, $params);
                }
            }
            $havingClause = ' HAVING ' . implode(' AND ', $havingClause);
        }

        return $havingClause;
    }

    /**
     * Make join clause
     * @param array $joins list of tables need to join in query.
     * Keys of joins: table, type, conditions
     * @return string
     */
    public function makeJoinClause($joins)
    {
        $joinClause = '';
        if (!empty($joins)) {
            foreach ($joins as $j) {
                if (isset($j['table']) && isset($j['type']) && isset($j['conditions'])) {
                    $joinClause .= " {$j['type']} JOIN {$j['table']} ON {$j['conditions']}";
                }
            }
        }

        return $joinClause;
    }

    /**
     * Make group clause
     * @param array $groups list of fields will be used to group by
     * @return string
     */
    public function makeGroupClause($groups)
    {
        $groupClause = implode(', ', $groups);
        if (!empty($groupClause)) {
            $groupClause = 'GROUP BY ' . $groupClause;
        }
        return $groupClause;
    }

    /**
     * Make order clause
     * @param array $orders list of fields and order type will be used
     * @example $orders = array('event_tbl.name ASC', 'event_tbl.created DESC')
     * @return string
     */
    public function makeOrderClause($orders)
    {
        $orderClause = implode(', ', $orders);
        if (!empty($orders)) {
            $orderClause = 'ORDER BY ' . $orderClause;
        }
//        dd($orderClause);
        return $orderClause;
    }
     /**
     * Make limit clause
     * @param array $limits
     * @example $limit = array('0', '10')
     * @return string
     */
    public function makeLimitClause($limit)
    {
        $limitClause = implode(', ', $limit);
        if (!empty($limit)) {
            $limitClause = 'LIMIT ' . $limitClause;
        }
        return $limitClause;
    }

    /**
     * Make operator segment in query. field = value or field < value....
     * @param string $k
     * @param string $v
     * @param array $params reference array of values will be bind to query
     * @return string
     */
    private function __makeOperatorSegment($k, $v, &$params)
    {
        $operatorSegment = '';
        if (!is_null($v)) {
            // Has value, that means 2 side operator
            if (strpos($k, ' ')) {
                // Has operator
                $operatorSegment = "$k ?";
            } else {
                $operatorSegment = "$k = ?";
            }
            array_push($params, $v);
        } else {
            // Has not value, that means 1 side operator
            if (strpos($k, '<>')) {
                // has different operator
                $k = str_replace('<>', '', $k);
                $operatorSegment = "$k IS NOT NULL";
            } else {
                $operatorSegment = "$k IS NULL";
            }
        }

        return $operatorSegment;
    }

}
