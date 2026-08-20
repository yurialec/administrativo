<template>
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light shadow fixed-top">
        <router-link class="navbar-brand ps-3" to="/">
            Administrativo
        </router-link>

        <button id="sidebarToggle" class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" type="button"
            aria-label="Alternar menu" @click="$emit('toggle-sidebar')">
            <i class="bi bi-list fs-3 text-dark"></i>
        </button>

        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </div>

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-person-circle fs-3"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <!-- <router-link class="dropdown-item" to="/admin/configuracoes"> -->
                            Configuracoes
                        <!-- </router-link> -->
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <button class="dropdown-item" type="button" @click="$emit('logout')">
                            <i class="bi bi-power fs-5 me-2"></i>Sair
                        </button>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: 'AppHeader'
}
</script>