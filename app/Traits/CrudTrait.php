<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 10/21/18
 * Time: 5:07 PM
 */

namespace App\Traits;

use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait CrudTrait
 */
trait CrudTrait
{
    /**
     * Instance that extends App\Repositories\AbstractBaseRepository;
     *
     * @var BaseRepository
     */
    private $actionRepository;

    public function setActionRepository(BaseRepository $actionRepository): void
    {
        $this->actionRepository = $actionRepository;
    }

    /**
     * @param  null  $relation
     * @return Model|null
     */
    public function findOne($id, $relation = null)
    {
        return $this->actionRepository->findOne($id, $relation);
    }

    /**
     * Search All resources by any values of a key
     *
     * @param  string  $key
     * @param  null  $relation
     * @return Collection
     */
    public function findIn($key, array $values, $relation = null, ?array $orderBy = null)
    {
        return $this->actionRepository->findIn($key, $values, $relation, $orderBy);
    }

    /**
     * @param  null  $perPage
     * @param  null  $relation
     * @param  array|null  $orderBy  [[column], [direction]]
     * @return \App\Repositories\Contracts\Collection|LengthAwarePaginator|Builder[]|Collection|Model[]
     */
    public function findAll($perPage = null, $relation = null, ?array $orderBy = null)
    {
        return $this->actionRepository->findAll($perPage, $relation, $orderBy);
    }

    /**
     * @param  null  $relation
     * @return Collection
     */
    public function findBy(array $searchCriteria = [], $relation = null, ?array $orderBy = null)
    {
        return $this->actionRepository->findBy($searchCriteria, $relation, $orderBy);
    }

    /**
     * @return Model|mixed
     */
    public function update(Model $model, array $data)
    {
        return $this->actionRepository->update($model, $data);
    }

    /**
     * @return bool|mixed|null
     *
     * @throws Exception
     */
    public function delete($id)
    {
        $model = $this->actionRepository->findOrFail($id);

        return $model->delete();
    }

    /**
     * @param  null  $relation
     * @return Builder|Builder[]|Collection|Model|Model[]|mixed
     */
    public function findOrFail($id, $relation = null, ?array $orderBy = null)
    {
        return $this->actionRepository->findOrFail($id);
    }

    /**
     * @return Model
     */
    public function save(array $data)
    {
        return $this->actionRepository->save($data);
    }

    /**
     * @param  null  $relation
     * @return Collection
     */
    public function findSelected(array $selectedColumns = [], $relation = null, ?array $orderBy = null)
    {
        return $this->actionRepository->findSelected($selectedColumns, $relation, $orderBy);
    }

    public function max($column = 'id')
    {
        return $this->actionRepository->max($column);
    }
}
