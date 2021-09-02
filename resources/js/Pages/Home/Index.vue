<template>
    <div class="row justify-content-center">
        <div @click="verPublicacion(publicacion)" class="card m-1 col-3" v-for="publicacion in publicaciones">
            <div class="card-body">
                <img :src="publicacion.imagenes[0].path" class="card-img-top" alt="...">
                <h5 class="card-title">{{ publicacion.nombrePublicacion }}</h5>
                <p class="card-text">{{publicacion.publicacion.descripcion}}</p>
                <p class="card-text" v-if="publicacion.publicacion?.tipovehiculo_id">Tipo vehiculo: {{publicacion.publicacion.tipovehiculo_id}}</p>
                <p class="card-text" v-if="publicacion.publicacion?.direccion">Ubicación: {{publicacion.publicacion.direccion}}</p>
                <p class="card-text"><small class="text-muted">Publicado el {{publicacion.created_at}}</small></p>
            </div>
        </div>
    </div>
</template>

<script>
import {defineComponent} from "vue";
import WebLayout from "../../Layouts/WebLayout";
import { Inertia } from "@inertiajs/inertia";

export default defineComponent({
    name: 'IndexHome',
    props:{
      publicaciones: Object
    },
    layout: WebLayout,
    setup(){

        const verPublicacion = (data) => {
            Inertia.visit(`/publicacion/${data.id}`);
        }

        return{
            verPublicacion
        }
    }
})
</script>

<style>
#app{
    background-color: slategray;
}
html{
    background-color: slategray;
}

.card:hover{
    background-color: slategray;
    border-color: black;
    color: white !important;
}
.card:hover .card-text .text-muted{
    border-color: black;
    color: white !important;
}
</style>
