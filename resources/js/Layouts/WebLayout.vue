<template>
    <div class="container">
        <header class="mt-2">
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center text-white text-decoration-none">
                    <img src="/images/logo.png" >
                </a>

                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="me-3 py-2 text-white text-decoration-none" href="#">Publicaciones</a>
                    <a class="me-3 py-2 text-white text-decoration-none" href="#">Quien soy?</a>
                </nav>
            </div>

            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-4 fw-normal">Acompañandote en tus decisiones.</h1>
                <p class="fs-5 text-white">Más de 10 años trabajando junto a vos.</p>
            </div>
        </header>
        <slot>

        </slot>
    </div>
    <footer class="footer mt-2 py-3">
        <div class="container text-center">
            <span class="text-white">Powered by Ariel Triviño.</span>
        </div>
    </footer>
</template>

<script>
import {defineComponent, computed, onMounted} from "vue";
import Swal from 'sweetalert2'
import { usePage } from '@inertiajs/inertia-vue3'
export default defineComponent({
    name: "WebLayout",
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
