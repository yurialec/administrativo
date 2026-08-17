<?php

namespace App\Services;

use App\Models\SidebarMenu;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }


    public function all()
    {
        try {
            return $this->roleRepository->all();
        } catch (\Throwable $e) {
            Log::error('Erro ao carregar sidebar menus', [
                'message' => $e->getMessage(),
            ]);
            return collect();
        }
    }

    public function dropdownList()
    {
        try {
            return $this->roleRepository->dropdownList();
        } catch (\Throwable $e) {
            Log::error('Erro ao carregar itens.', [
                'message' => $e->getMessage(),
            ]);
            return collect();
        }
    }

    public function find($id)
    {
        try {
            return $this->roleRepository->find($id);
        } catch (\Throwable $e) {
            Log::error('Erro ao buscar perfil', [
                'message' => $e->getMessage(),
                'role_id' => $id,
            ]);
            return null;
        }
    }


    public function create(array $data)
    {
        try {
            $role = $this->roleRepository->create($data);
            return $role;
        } catch (\Throwable $e) {
            Log::error('Erro ao criar perfil.', [
                'message' => $e->getMessage(),
                'data' => $data,
            ]);
            return null;
        }
    }

    // public function delete($id)
    // {
    //     try {
    //         $deleted = $this->roleRepository->delete($id);

    //         if ($deleted) {
    //             $this->refreshSidebarSession();
    //         }

    //         return $deleted;
    //     } catch (\Throwable $e) {
    //         Log::error('Erro ao excluir menu', [
    //             'message' => $e->getMessage(),
    //             'menu_id' => $id,
    //         ]);
    //         return null;
    //     }
    // }

    public function update(array $data, $id)
    {
        try {
            return $this->roleRepository->update($data, $id);
        } catch (\Throwable $e) {
            Log::error('Erro ao editar perfil.', [
                'message' => $e->getMessage(),
                'role_id' => $id,
            ]);

            return null;
        }
    }

    // {
    //     try {
    //         $menu = DB::transaction(function () use ($data, $id) {
    //             $menu = $this->roleRepository->findOrFail($id);
    //             $children = $data['children'] ?? [];

    //             unset($data['children']);

    //             $this->roleRepository->updateModel($menu, $data);
    //             $this->syncChildren($menu, $children);

    //             return $this->roleRepository->treeFromMenu($menu->id);
    //         });

    //         if ($menu) {
    //             $this->refreshSidebarSession();
    //         }

    //         return $menu;
    //     } catch (\Throwable $e) {
    //         Log::error('Erro ao editar menu', [
    //             'message' => $e->getMessage(),
    //             'menu_id' => $id,
    //         ]);
    //         return null;
    //     }
    // }

    // public function changeMenuOrder($id)
    // {
    //     try {
    //         $menu = DB::transaction(function () use ($id) {
    //             $menu = $this->roleRepository->findOrFail($id);

    //             if ($menu->order <= 1) {
    //                 return $menu;
    //             }

    //             $newOrder = $menu->order - 1;
    //             $menuToReplace = $this->roleRepository->findByParentAndOrder($menu->parent_id, $newOrder);

    //             if (!$menuToReplace) {
    //                 return $menu;
    //             }

    //             $oldOrder = $menu->order;

    //             $this->roleRepository->updateModel($menu, [
    //                 'order' => $newOrder,
    //             ]);

    //             $this->roleRepository->updateModel($menuToReplace, [
    //                 'order' => $oldOrder,
    //             ]);

    //             return $menu->fresh();
    //         });

    //         if ($menu) {
    //             $this->refreshSidebarSession();
    //         }

    //         return $menu;
    //     } catch (\Throwable $e) {
    //         Log::error('Erro ao alterar ordem do menu', [
    //             'message' => $e->getMessage(),
    //             'menu_id' => $id,
    //         ]);
    //         return null;
    //     }
    // }

    // private function syncChildren(SidebarMenu $parent, array $children): void
    // {
    //     $sentIds = collect($children)
    //         ->pluck('id')
    //         ->filter()
    //         ->values()
    //         ->toArray();

    //     $this->roleRepository->deleteChildrenExcept($parent, $sentIds);

    //     foreach ($children as $childData) {
    //         $grandChildren = $childData['children'] ?? [];

    //         unset($childData['children']);

    //         if (!empty($childData['id'])) {
    //             $child = $this->roleRepository->findOrFail($childData['id']);
    //             $this->roleRepository->updateModel($child, $childData);

    //             if (!$child->isChildOf($parent)) {
    //                 $this->roleRepository->appendToParent($child, $parent);
    //             }
    //         } else {
    //             $child = $this->roleRepository->createChild($parent, $childData);
    //         }

    //         $this->syncChildren($child, $grandChildren);
    //     }
    // }
}
