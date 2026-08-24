<template>
    <div>
        <Loading :loading="isLoading" />
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h4 mb-0">Cadastrar Novo Perfil</h1>
            </div>
            <router-link
                class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-2 align-self-start align-self-lg-auto"
                to="/roles">
                <i class="bi bi-arrow-left"></i>
                <span>Voltar</span>
            </router-link>
        </div>
        <form class="row justify-content-center" @submit.prevent="store">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        

                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="roleName" class="form-label">Nome</label>
                                <input id="roleName" v-model="role.name" class="form-control" type="text" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="roleDescription" class="form-label">Descrição</label>
                                <input id="roleDescription" v-model="role.description" class="form-control" type="text"
                                    required>
                            </div>
                            <div class="col-12">
                                <label for="roleParent" class="form-label">Perfil Pai</label>
                                <select id="roleParent" v-model="role.parent_id" name="roleParent"
                                    class="form-select">
                                    <option value="">Nenhum (perfil principal)</option>
                                    <option v-for="r in roles" :key="r.id" :value="r.id">
                                        {{ r.name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-sm btn-primary text-white" :disabled="isLoading">
                                <i class="bi bi-check-lg me-1"></i>
                                Cadastrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    name: 'CreateRole',
    data() {
        return {
            isLoading: false,
            role: {
                name: '',
                description: '',
                parent_id: '',
            },
            roles: [],
        };
    },
    mounted() {
        this.search();
    },
    methods: {
        search() {
            axios.get(`/api/roles/dropdown-list`)
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
        store() {
            axios.post(`/api/roles/store`, this.role)
                .then(response => {
                    alertSuccess('Menu cadastrado com sucesso!');
                })
                .catch(error => {
                    alertDanger(error);
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
    }
}
</script>