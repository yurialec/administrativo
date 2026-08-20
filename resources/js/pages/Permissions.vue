<template>
    <section class="page">
        <Loading :loading="isLoading" fullscreen />
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h4 mb-0">Permissões</h1>
            </div>
            <router-link
                class="btn btn-primary btn-sm d-inline-flex align-items-center gap-2 align-self-start align-self-lg-auto text-white"
                to="/permissions/create">
                <i class="bi bi-plus"></i><span>Cadastrar</span>
            </router-link>
        </div>
        <div class="row g-4">
            <div class="col-12 col-xl-2">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 pb-0">
                        <h2 class="h6 mb-0">Filtros</h2>
                    </div>
                    <div class="card-body">
                        <form class="vstack gap-3" @submit.prevent="search">
                            <div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input v-model.trim="filter.name" class="form-control" type="text"
                                        placeholder="Nome da permissão" />
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button
                                    class="btn btn-primary btn-sm d-inline-flex align-items-center justify-content-center gap-2 text-white"
                                    type="submit" :disabled="isLoading">
                                    <i class="bi bi-search"></i>
                                    <span>Pesquisar</span>
                                </button>
                                <button
                                    class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center justify-content-center gap-2"
                                    type="button">
                                    <i class="bi bi-x-lg"></i>
                                    <span>Limpar filtros</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-10">
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap" scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">slug</th>
                                    <th class="text-center" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td class="text-center text-muted py-5" colspan="7">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                        Nenhum resultado encontrado
                                    </td>
                                </tr> -->
                                <tr>
                                    <td>123</td>
                                    <td>Menus</td>
                                    <td>menus</td>
                                    <td class="text-end">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Ações
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <router-link class="dropdown-item"
                                                    :to="{ name: 'permissions.edit', params: { id: 123 } }">
                                                    Editar
                                                </router-link>
                                            </li>
                                            <li>
                                                <button class="dropdown-item" @click="delete (123)">
                                                    Excluir
                                                </button>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- <div
                        class="card-footer bg-white d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                        <Pagination class="flex-grow-1" :permissions="permissions" :rows="10"
                            @page-change="setPaginatedPermissions" />
                    </div> -->
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    name: 'Permissions',
    data() {
        return {
            isLoading: false,
            filter: {
                name: '',
            },
            permissions: [],
            paginatedPermissions: [],
        };
    },
    methods: {
        search() {
            // Implement search logic here
        },
        delete(id) {
            // Implement delete logic here
        },
        setPaginatedPermissions(page) {
            // Implement pagination logic here
        },
    },
}
</script>
<style>
.page .card {
    border-radius: 0.5rem;
}
</style>