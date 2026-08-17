<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function all()
    {
        return $this->role
            ->query()
            ->get()
            ->toTree();
    }

    public function dropdownList()
    {
        return $this->role
            ->select([
                'id',
                'name'
            ])
            ->defaultOrder()
            ->get();
    }

    public function find($id)
    {
        return $this->role
            ->query()
            ->find($id);
    }

    public function findOrFail($id)
    {
        return $this->role->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->role->create($data);
    }

    public function delete($id)
    {
        return $this->role->destroy($id);
    }

    public function update($data, $id)
    {
        $role = $this->findOrFail($id);

        return $this->updateModel($role, $data);
    }

    public function updateModel(Role $role, array $data)
    {
        $role->update($data);

        return $role;
    }

    public function deleteChildrenExcept(Role $parent, array $ids): void
    {
        $parent->children()
            ->when(!empty($ids), function ($query) use ($ids) {
                $query->whereNotIn('id', $ids);
            })
            ->delete();
    }

    public function createChild(Role $parent, array $data)
    {
        return $parent->children()->create($data);
    }

    public function appendToParent(Role $child, Role $parent)
    {
        $child->appendToNode($parent)->save();

        return $child;
    }

    public function findByParentAndOrder($parentId, $order)
    {
        return $this->role
            ->query()
            ->where('parent_id', $parentId)
            ->where('order', $order)
            ->first();
    }

    public function treeFromMenu($id)
    {
        return $this->role
            ->defaultOrder()
            ->descendantsAndSelf($id)
            ->toTree()
            ->first();
    }
}
