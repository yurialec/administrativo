<template>
    <section class="perfis-page">
        <Loading :loading="isLoading" fullscreen />
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h4 mb-0">Perfis</h1>
            </div>
            <router-link
                class="btn btn-primary btn-sm d-inline-flex align-items-center gap-2 align-self-start align-self-lg-auto text-white"
                to="/roles/create">
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
                                    <input id="role-name-filter" v-model.trim="filter.term" class="form-control"
                                        type="text" placeholder="Nome ou descricao">
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
                                    type="button" @click="clearFilters">
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
                        <table class="table table-hover align-middle mb-0 perfis-table">
                            <colgroup>
                                <col class="perfis-table-role">
                                <col class="perfis-table-description">
                                <col class="perfis-table-status">
                                <col class="perfis-table-parent">
                                <col class="perfis-table-actions">
                            </colgroup>
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Descrição</th>
                                    <th class="text-center" scope="col">Ativo</th>
                                    <th scope="col">Perfil pai</th>
                                    <th class="text-end" scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="filteredRoles.length === 0">
                                    <td class="text-center text-muted py-5" colspan="5">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                        Nenhum perfil encontrado
                                    </td>
                                </tr>
                                <tr v-for="role in paginatedRoles" :key="role.id">
                                    <th class="role-name-cell" scope="row">
                                        <div class="role-name-content d-flex align-items-center gap-2"
                                            :style="{ paddingLeft: `${role.depth * 1.25}rem` }">
                                            <button v-if="role.hasChildren"
                                                class="btn btn-link btn-sm p-0 role-toggle-button" type="button"
                                                :aria-label="role.isCollapsed ? 'Expandir filhos' : 'Recolher filhos'"
                                                :title="role.isCollapsed ? 'Expandir filhos' : 'Recolher filhos'"
                                                @click="toggleRoleChildren(role.id)">
                                                <i
                                                    :class="role.isCollapsed ? 'bi bi-chevron-right' : 'bi bi-chevron-down'"></i>
                                            </button>
                                            <span v-else class="role-toggle-placeholder"></span>
                                            <i v-if="role.depth" class="bi bi-arrow-return-right text-muted"></i>
                                            <span class="fw-semibold role-name-text">{{ role.name }}</span>
                                        </div>
                                    </th>
                                    <td>
                                        <span class="role-description text-body-secondary">
                                            {{ displayValue(role.description) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill" :class="statusClass(role)">
                                            {{ statusLabel(role) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span v-if="role.parent_id" class="text-body-secondary">
                                            {{ displayValue(role.parentName) }}
                                            <small class="text-muted">(#{{ role.parent_id }})</small>
                                        </span>
                                        <span v-else class="text-muted">-</span>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Ações
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <router-link class="dropdown-item"
                                                    :to="{ name: 'roles.edit', params: { id: role.id } }">
                                                    Editar
                                                </router-link>
                                            </li>
                                            <li>
                                                <button class="dropdown-item" type="button"
                                                    @click="deleteRole(role.id)">
                                                    Excluir
                                                </button>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div
                        class="card-footer bg-white d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                        <Pagination class="flex-grow-1" :menus="filteredRoles" :rows="10"
                            @page-change="setPaginatedRoles" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'Roles',
    data() {
        return {
            isLoading: false,
            filter: {
                term: '',
            },
            roles: [],
            paginatedRoles: [],
            collapsedRoleIds: []
        };
    },
    computed: {
        flattenedRoles() {
            return this.flattenRoleTree(this.roles);
        },
        filteredRoles() {
            const term = this.normalizeText(this.filter.term);

            if (!term) {
                return this.flattenedRoles;
            }

            return this.flattenedRoles.filter(role => {
                return [
                    role.id,
                    role.name,
                    role.description,
                    role.parentName
                ].some(value => this.normalizeText(value).includes(term));
            });
        }
    },
    mounted() {
        this.search();
    },
    methods: {
        search() {
            this.isLoading = true;
            axios.get(`/api/roles/list`)
                .then(response => {
                    this.roles = response.data;
                })
                .catch(error => {
                    alertDanger(error);
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
        clearFilters() {
            this.filter.term = '';
        },
        setPaginatedRoles(roles) {
            this.paginatedRoles = roles;
        },
        flattenRoleTree(items, depth = 0, parentName = '') {
            if (!Array.isArray(items)) {
                return [];
            }

            return items.reduce((roles, item) => {
                const children = Array.isArray(item.children) ? item.children : [];
                const hasChildren = children.length > 0;
                const isCollapsed = this.isRoleCollapsed(item.id);

                roles.push({
                    ...item,
                    depth,
                    parentName,
                    hasChildren,
                    isCollapsed
                });

                if (hasChildren && !isCollapsed) {
                    roles.push(...this.flattenRoleTree(children, depth + 1, item.name));
                }

                return roles;
            }, []);
        },
        toggleRoleChildren(roleId) {
            if (!roleId) {
                return;
            }

            if (this.isRoleCollapsed(roleId)) {
                this.collapsedRoleIds = this.collapsedRoleIds.filter(id => id !== roleId);
                return;
            }

            this.collapsedRoleIds.push(roleId);
        },
        isRoleCollapsed(roleId) {
            return this.collapsedRoleIds.includes(roleId);
        },
        normalizeText(value) {
            return String(value === null || value === undefined ? '' : value).toLowerCase().trim();
        },
        displayValue(value) {
            return value || '-';
        },
        statusClass(role) {
            return role.is_active ? 'text-bg-success' : 'text-bg-secondary';
        },
        statusLabel(role) {
            return role.is_active ? 'Ativo' : 'Inativo';
        },
        deleteRole(id) {
            if (!id) {
                return;
            }

            this.confirm('', 'Deseja excluir este perfil?').then(() => {
                this.isLoading = true;
                axios.delete(`/api/roles/delete/${id}`)
                    .then(response => {
                        alertSuccess('Registro excluido com sucesso!');
                        this.search();
                    })
                    .catch(error => {
                        alertDanger(error);
                    })
                    .finally(() => {
                        this.isLoading = false;
                    });
            });
        }
    }
};
</script>

<style scoped>
.perfis-page .card {
    border-radius: 0.5rem;
}

.perfis-table {
    table-layout: fixed;
    min-width: 58rem;
}

.perfis-table-role {
    width: 30%;
}

.perfis-table-description {
    width: 40%;
}

.perfis-table-status {
    width: 7rem;
}

.perfis-table-parent {
    width: 16rem;
}

.perfis-table-actions {
    width: 7rem;
}

.role-name-cell {
    min-width: 12rem;
}

.role-name-content {
    max-width: 100%;
    min-width: 0;
}

.role-toggle-button,
.role-toggle-placeholder {
    width: 1.25rem;
    height: 1.25rem;
    flex: 0 0 1.25rem;
}

.role-name-text,
.role-description {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.role-name-text {
    min-width: 0;
}

.role-description {
    display: block;
}

.table> :not(caption)>*>* {
    padding: 0.875rem 1rem;
}
</style>
