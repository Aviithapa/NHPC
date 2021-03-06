<?php


namespace App\Modules\Backend\Admin\Level\Repositories;


use App\Models\Admin\Level;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Log;

class EloquentLevelRepository implements LevelRepository
{
    private $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function perPage()
    {
        $page = 10;
        return $page?$page:10;
    }

    public function getModel()
    {
        return new Level();
    }

    public function getAll()
    {
        return $this->getModel()->get();
    }

    public function getAllInActive()
    {
        return $this->getModel()->where('status', 'in-active')->get();
    }

    public function getAllForDataTable()
    {
        return $this->getModel()->query()->with('roles');
    }

    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";
        return $this->getModel()->where('user_username', 'like', $search)->orWhere('user_full_name', 'like', $search)
            ->paginate($this->perPage());
    }

    public function allOrSearch($searchQuery = null)
    {
        if (is_null($searchQuery)) {
            return $this->getAll();
        }
        return $this->search($searchQuery);
    }

    /**
     * Find data by specified column name and value.
     *
     * @param string $key
     * @param string $value
     * @param string $operator
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByFirst($key, $value, $operator = '=')
    {
        return $this->getModel()->where($key, $operator, $value)->first();
    }

    public function getWithPagination()
    {
        return $this->getModel()->latest()->paginate($this->perPage());
    }

    public function findById($id)
    {
        return $this->getModel()->find($id);
    }

    public function findBy($key, $value, $operator = '=',$paginate = true,$limit = null)
    {
        return $this->getModel()->where($key, $operator, $value)->paginate($this->perPage());
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $user = $this->getModel()->create($data);
            if (isset($data['role'])) {
                $user->roles()->sync([$data['role']]);
            }
            if (isset($data['permissions'])) {
                $user->permissions()->sync($data['permissions']);
            }
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            $this->log->error('User create : ' . $e->getMessage());
            return false;

        }

    }
    /**find by data for data-table
     * @param string $key
     * @param string $value
     * @param string $operator
     * @return mixed
     */
    public function findByDataTable($key, $value, $operator = '=')
    {
        $user = Auth::user();
        if($user->isSuperAdmin())
        {
            return $this->getModel()->query()->where($key, $operator, $value);
        }
        else {
            return $this->getModel()->query()->where('user_id', $user->id)->where($key, $operator, $value);

        }
    }

    public function update(array $data, $id)
    {
        DB::beginTransaction();
        try {
            $user = $this->findById($id);
            $user->update($data);
            if (isset($data['role'])) {
                $user->roles()->sync([$data['role']]);
            }
            if (isset($data['permissions'])) {
                $user->permissions()->sync($data['permissions']);
            } else {
                $user->permissions()->detach();

            }
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            $this->log->error('User update : ' . $e->getMessage());
            return false;
        }

    }

    public function delete($id)
    {
        $object = $this->findById($id);
        if (!is_null($object)) {
            $object->delete();
            return true;
        }
        return false;
    }

    public function hardDelete($id)
    {
        $object = $this->findById($id);
        if (!is_null($object)) {
            $object->forcedelete();
            return true;
        }
        return false;
    }
    /**
     * @param $slug
     * @return collection
     */
    public function findBySlug($slug,$status=true)
    {
        return $this->getModel()->where('status', 'published')->where('slug', $slug)->first();
    }
    /**Gets all data for data-table
     * @return mixed
     */
    public function getAllRecruitersForDataTable()
    {
        $user = Auth::user();
        if($user->isSuperAdmin())
        {
            return $this->getModel()->query()->whereHas('roles',function ($query){
                $query->where('id',3);
            })->with('roles');
        }
        else {
            return $this->getModel()->query()->where('user_id', $user->id);

        }
    }

}
