<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SettingModel extends AdminModel
{
    public function __construct()
    {
        $this->table               = 'setting';
        $this->folderUpload        = 'setting';
        $this->fieldSearchAccepted = ['id', 'name', 'description', 'link'];
        $this->crudNotAccepted     = ['_token', 'id'];
    }

    public function listItems($params = null, $options = null)
    {

        $result = null;

        if ($options['task'] == "admin-list-items") {
            $query = $this->select('id', 'name', 'ordering', 'description', 'status', 'link', 'thumb', 'created', 'created_by', 'modified', 'modified_by');

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

        if ($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name', 'description', 'link', 'thumb')
                ->where('status', '=', 'active')
                ->limit(5);

            $result = $query->get()->toArray();
        }

        

        return $result;
    }

    

    public function getItem($params = null, $options = null)
    {
        $result = null;


        if($options['task'] == 'setting-general'){
            $result = self::select('value')->where('key_value', 'setting_general')->first();
            $result = json_decode($result['value'],true);
        }

        if($options['task'] == 'setting-email-bcc'){
            $result = self::select('value')->where('key_value', 'setting_email_bcc')->first();
            $result = json_decode($result['value'],true);
        }

        if($options['task'] == 'setting-email-account'){
            $result = self::select('value')->where('key_value', 'setting_email_account')->first();
            $result = json_decode($result['value'],true);
        }

        if($options['task'] == 'setting-social'){
            $result = self::select('value')->where('key_value', 'setting_social')->first();
            $result = json_decode($result['value'],true);
        }

       

        // in NEWS
        if($options['task'] == 'new-in-contact'){
            $email  =self::select('value')->where('key_value', 'setting_email_account')->first();
            $email = json_decode($email['value'],true);

            $result = self::select('value')->where('key_value', 'setting_general')->first();
            $result = json_decode($result['value'],true);
            $result['email'] = $email['email_account'];
           
        }

        return $result;
    }

    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'setting-general') {
            $params = json_encode($params,JSON_UNESCAPED_UNICODE);
            self::where('key_value', 'setting_general')->update(['value' => $params ]);
        }

        if ($options['task'] == 'setting-email-bcc') {
            $params = json_encode($params,JSON_UNESCAPED_UNICODE);
            self::where('key_value', 'setting_email_bcc')->update(['value' => $params ]);
        }

        if ($options['task'] == 'setting-email-account') {
            $params['password'] = $params['password'];
            $params = json_encode($params,JSON_UNESCAPED_UNICODE);
            self::where('key_value', 'setting_email_account')->update(['value' => $params ]);
        }

        if ($options['task'] == 'setting-social') {
            $params = json_encode($params,JSON_UNESCAPED_UNICODE);
            self::where('key_value', 'setting_social')->update(['value' => $params ]);
        }
    }
    
}
