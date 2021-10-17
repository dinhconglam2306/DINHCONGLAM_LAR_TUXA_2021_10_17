<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ContactModel extends AdminModel
{
    public function __construct()
    {
        $this->table               = 'contact';
        $this->folderUpload        = 'contact';
        $this->fieldSearchAccepted = ['username', 'email', 'status'];
        $this->crudNotAccepted     = ['_token'];
    }

    public function listItems($params = null, $options = null)
    {

        $result = null;

        if ($options['task'] == "admin-list-items") {
            $query = $this->select('id', 'username', 'email', 'phone', 'contact', 'status', 'created','ip_address');

            if ($params['filter']['status'] !== "all") {
                $query->where('status', '=', $params['filter']['status']);
            }

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }

            $result =  $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }



        return $result;
    }

    public function countItems($params = null, $options  = null)
    {

        $result = null;

        if ($options['task'] == 'admin-count-items-group-by-status') {

            $query = $this::groupBy('status')
                ->select(DB::raw('status , COUNT(id) as count'));

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }
            $result = $query->get()->toArray();
        }
        if ($options['task'] == 'count-item-in-dashboard') {
            $query = $this::groupBy('status')
                ->select(DB::raw('COUNT(id) as count'));
            $result = $query->get()->toArray();
        }

        return $result;
    }

    public function getItem($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'username', 'email', 'status', 'phone')->where('id', $params['id'])->first();
        }

        return $result;
    }

    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'change-status') {
            $status = ($params['currentStatus'] == "active") ? "inactive" : "active";
            self::where('id', $params['id'])->update(['status' => $status]);
        }

        if ($options['task'] == 'add-item') {
            $params['created']    = date('Y-m-d');
            $params['status']     = 'inactive';
            $params['ip_address'] = $_SERVER['SERVER_ADDR'];
            self::insert($this->prepareParams($params));
        }

        // if ($options['task'] == 'edit-item') {
        //     $params['modified_by']   = "hailan";
        //     $params['modified']      = date('Y-m-d');
        //     self::where('id', $params['id'])->update($this->prepareParams($params));
        // }



    }

    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
    }
}
