<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class TagRepository {
    public function getMostExpensiveTags(int $spaceId, int $limit = null, int $year = null, int $month = null) {
        $sql = '
            SELECT
                tags.name AS name,
                tags.color AS color,
                SUM(spendings.amount) AS amount
            FROM
                tags
            LEFT OUTER JOIN
                spendings ON tags.id = spendings.tag_id AND spendings.deleted_at IS NULL
            WHERE
                tags.space_id = ?';

        if ($year) {
            $sql .= ' AND YEAR(happened_on) = ?';
        }

        if ($month) {
            $sql .= ' AND MONTH(happened_on) = ?';
        }

        $sql .= '
            GROUP BY
                tags.id
            ORDER BY
                SUM(spendings.amount) DESC
        ';

        if ($limit) {
            $sql .= ' LIMIT ' . $limit;
        }

        $data = [$spaceId];

        if ($year) {
            $data[] = $year;
        }

        if ($month) {
            $data[] = $month;
        }

        return DB::select($sql . ';', $data);
    }
}
