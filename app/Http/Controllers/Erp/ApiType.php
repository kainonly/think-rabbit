<?php

namespace App\Http\Controllers\Erp;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use lumen\bit\curd\AddModel;
use lumen\bit\curd\DeleteModel;
use lumen\bit\curd\EditModel;
use lumen\bit\curd\OriginListsModel;
use lumen\bit\lifecycle\DeleteBeforeHooks;

class ApiType extends Base implements DeleteBeforeHooks
{
    use OriginListsModel, AddModel, EditModel, DeleteModel;
    protected $model = 'api_type';
    protected $add_validate = [
        'name' => 'required|string'
    ];
    protected $edit_validate = [
        'name' => 'sometimes|string'
    ];

    /**
     * Delete pre-processing
     * @return boolean
     */
    public function __deleteBeforeHooks()
    {
        try {
            $exist = DB::table('api')
                ->where('type', '=', $this->post['id'])
                ->exists();

            if ($exist) $this->delete_before_result = [
                'error' => 1,
                'msg' => 'error:api_child'
            ];

            return !$exist;
        } catch (QueryException $e) {
            $this->delete_before_result = [
                'error' => 1,
                'msg' => $e->getMessage()
            ];

            return false;
        }
    }
}
