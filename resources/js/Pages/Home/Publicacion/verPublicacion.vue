<template>
    <div class="row">
        <div class="col-12 col-md-8">
            <div id="carouselExampleIndicators" class="carousel slide rounded" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item" :class="{active: key === 0}" v-for="(imagen,key) in publicacion.imagenes">
                        <img :src="imagen.path" style="height: 400px" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="bg-light bg-gradient mt-2 rounded p-4">
                <h1 class="fs-2 text-left">
                    {{publicacion.nombrePublicacion}}
                </h1>
                <p>
                    {{publicacion.publicacion.descripcion}}
                </p>

                <ul class="list-group rounded">
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.created_at">Publicado: {{publicacion.created_at}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.direccion">Ubicacion: {{publicacion.publicacion.direccion}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.km">Kilometraje: {{publicacion.publicacion.km}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.tipovehiculo_id">Tipo de vehiculo: {{publicacion.publicacion.tipovehiculo_id}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.marca_id">Marca: {{publicacion.publicacion.marca_id}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.modelo_id">Modelo: {{publicacion.publicacion.modelo_id}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.ano">Año: {{publicacion.publicacion.ano}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.color">Color: {{publicacion.publicacion.color}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.motor">Motor: {{publicacion.publicacion.motor}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.tipo_combustible">Combustible: {{publicacion.publicacion.tipo_combustible}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.puertas">Puertas: {{publicacion.publicacion.puertas}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.transmision">Transmisión: {{publicacion.publicacion.transmision}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.velocidades">Velocidades: {{publicacion.publicacion.velocidades}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.potencia">Potencia: {{publicacion.publicacion.potencia}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.capacidad_tanque">Capacidad tanque: {{publicacion.publicacion.capacidad_tanque}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.capacidad_balde">Capacidad balde: {{publicacion.publicacion.capacidad_balde}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.capacidad_carga">Capacidad carga: {{publicacion.publicacion.capacidad_carga}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.capacidad_cuchara">Capacidad cuchara: {{publicacion.publicacion.capacidad_cuchara}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.horas_trabajadas">Horas trabajadas: {{publicacion.publicacion.horas_trabajadas}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.tipoinmueble_id">Tipo de inmueble: {{publicacion.publicacion.tipoinmueble_id}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.superficie_total">Superficie total: {{publicacion.publicacion.superficie_total}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.agua">Agua: {{publicacion.publicacion.agua ? 'Si' : 'No'}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.luz">Luz: {{publicacion.publicacion.luz ? 'Si' : 'No'}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.gas">Gas: {{publicacion.publicacion.gas ? 'Si' : 'No'}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.cloaca">Agua: {{publicacion.publicacion.cloaca ? 'Si' : 'No'}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.ambientes">Cantidad ambientes: {{publicacion.publicacion.ambientes}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.dormitorios">Cantidad dormitorios: {{publicacion.publicacion.dormitorios}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.banos">Cantidad baños: {{publicacion.publicacion.banos}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.antiguedad">Antiguedad: {{publicacion.publicacion.antiguedad}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.cantidad_pisos">Cantidad pisos: {{publicacion.publicacion.cantidad_pisos}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.pisos_unidad">Cantidad pisos por unidad: {{publicacion.publicacion.pisos_unidad}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.departamentos_por_piso">Departamentos por piso: {{publicacion.publicacion.departamentos_por_piso}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-secondary" v-if="publicacion.publicacion.pisos_unidad">Cantidad pisos por unidad: {{publicacion.publicacion.pisos_unidad}}</li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12 bg-light bg-gradient border rounded">
                    <div class="text-center fs-4 mb-2" v-if="publicacion.publicacion.latitud && publicacion.publicacion.longitud">
                        Ubicacion:
                        <br />
                        <GMapMap
                            :center="{ lat: Number(publicacion.publicacion.latitud), lng: Number(publicacion.publicacion.longitud) }"
                            class="mt-2"
                            map-type-id="terrain"
                            style="height: 300px"
                            :zoom="10"
                        >
                            <GMapMarker
                                :position="{ lat: Number(publicacion.publicacion.latitud), lng: Number(publicacion.publicacion.longitud) }"
                            />
                        </GMapMap>
                    </div>
                    <hr>
                    <div class="text-center fs-4 mb-2">
                        ¿Estas interesado?
                        <br />
                        <p class="fs-6">Dejanos tus datos</p>
                        <form v-on:submit.prevent>
                            <div class="mb-3">
                                <label for="nombreApellido" class="form-label">Nombre y apellido</label>
                                <input type="text" class="form-control" id="nombreApellido" placeholder="" v-model="consulta.nombreApellido">
                                <p class="text-danger" v-if="consulta.hasErrors && consulta.errors['nombreApellido']">
                                    {{ consulta.errors['nombreApellido'] }}
                                </p>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="name@example.com" v-model="consulta.email">
                                <p class="text-danger" v-if="consulta.hasErrors && consulta.errors['email']">
                                    {{ consulta.errors['email'] }}
                                </p>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Telefono </label><span class="fs-6">(Sin 0 ni 15)</span>
                                <input type="tel" class="form-control" id="telefono" placeholder="2974312322" v-model="consulta.telefono">
                                <p class="text-danger" v-if="consulta.hasErrors && consulta.errors['telefono']">
                                    {{ consulta.errors['telefono'] }}
                                </p>
                            </div>
                            <div class="mb-3">
                                <label for="horarioContacto" class="form-label">Horario de contacto</label>
                                <input type="text" class="form-control" id="horarioContacto" placeholder="18:00 - 19:00" v-model="consulta.horario">
                                <p class="text-danger" v-if="consulta.hasErrors && consulta.errors['horario']">
                                    {{ consulta.errors['horario'] }}
                                </p>
                            </div>
                            <div class="mb-3">
                                <label for="Comentario" class="form-label">Comentario</label>
                                <textarea type="text" class="form-control" id="Comentario" placeholder="" v-model="consulta.comentario" />
                            </div>
                            <button @click="realizarConsulta" type="button" class="btn btn-primary col-12">
                                Enviar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {defineComponent} from "vue";
import WebLayout from "../../../Layouts/WebLayout";
import {useForm} from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2";

export default defineComponent({
    name: 'verPublicacion',
    props:{
        publicacion: Object
    },
    layout: WebLayout,
    setup(props){
        const consulta = useForm({
            nombreApellido: '',
            email: '',
            telefono: '',
            horario: '',
            comentario: ''
        })


        const realizarConsulta = () => {
            consulta.post(`/publicacion/${props.publicacion.id}/consulta`,{
                preserveScroll: true,
                onSuccess: success => {
                    Swal.fire(
                        'Consulta realizada correctamente!',
                        'En breve te estaremos contactando.',
                        'success'
                    )
                    consulta.reset();
                },
                onError: errors => {
                    Swal.fire(
                        'Se encontraron errores!',
                        'Revisar formulario',
                        'error'
                    )
                },
            })
        }

        return {
            consulta,
            realizarConsulta
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

.carousel-control-next{
    opacity: 1;
}
.carousel-control-prev{
    opacity: 1;
}



.carousel-control-prev-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e");
    background-color: white;
    border-radius: 50%;
    padding: 2px;
}

.carousel-control-next-icon{
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    background-color: white;
    border-radius: 50%;
    padding: 2px;
}
</style>
