<?php

namespace App\Models;

use App\Models\AdminModel;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;

class DashboardModel extends AdminModel
{

    public function getTableName($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'list-table-in-admin') {
            $result = DB::select('SHOW TABLES');
        }

        return $result;
    }
}
