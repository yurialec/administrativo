<template>
    <div>
        <Loading :loading="isLoading" fullscreen />
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h4 mb-0">Cadastrar Perfil</h1>
            </div>
            <router-link
                class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-2 align-self-start align-self-lg-auto"
                to="/admin/roles">
                <i class="bi bi-arrow-left"></i>
                <span>Voltar</span>
            </router-link>
        </div>
        <form class="row g-4" @submit.prevent="store">
            <div class="col-12 col-xl-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pb-0">
                        <h2 class="h6 mb-0">Dados do perfil</h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="roleName" class="form-label">Nome</label>
                            <input id="roleName" v-model="role.name" class="form-control" type="text"
                                placeholder="Ex.: Auxiliar Administrativo" required>
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
                is_active: '',
            },
        };
    },
    mounted() {
    },
    methods: {
        store(){
            console.log(this.role);
        }
    }
}
</script>