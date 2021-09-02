<template>
    <header>
        <div class="px-3 py-2 bg-dark text-white">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
                    </a>

                    <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                        <li>
                            <a href="/" :class="{'text-primary': $page.component === 'Home/Index'}" class="nav-link">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="/admin/dashboard" :class="{'text-primary': $page.component === 'Admin/Index'}" class="nav-link">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="/admin/dashboard/inmuebles" :class="{'text-primary': $page.component === 'Admin/Inmuebles/Index'}" class="nav-link">
                                Inmuebles
                            </a>
                        </li>
                        <li>
                            <a href="/admin/dashboard/vehiculos" :class="{'text-primary': $page.component === 'Admin/Vehiculos/Index'}" class="nav-link">
                                Vehiculos
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid p-5">
        <slot />
    </div>
</template>

<script>
import {defineComponent, computed, onMounted} from "vue";
import Swal from 'sweetalert2'
import { usePage } from '@inertiajs/inertia-vue3'
export default defineComponent({
    name: "AdminLayout",
    props: ['success', 'errors'],
    setup(props){
        const data = computed(()=> usePage() );


        return {
            data
        }
    }
})
</script>

<style>
a{
    color: white;
}
</style>
