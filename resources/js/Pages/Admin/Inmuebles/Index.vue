<template>
    <div class="p-2">
        <div class="d-flex flex-row-reverse">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Agregar
            </button>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Superficie total</th>
                <th scope="col">Direccion</th>
                <th scope="col">Agua</th>
                <th scope="col">Luz</th>
                <th scope="col">Gas</th>
                <th scope="col">Cloaca</th>
                <th scope="col">Ambientes</th>
                <th scope="col">Dormitorios</th>
                <th scope="col">Baños</th>
                <th scope="col">Antiguedad</th>
                <th scope="col">Cantidad pisos</th>
                <th scope="col">Pisos unidad</th>
                <th scope="col">Departamentos por piso</th>
                <th scope="col">Tipo inmueble</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="publicacion in publicaciones.data">
                <th scope="row">{{publicacion.nombrePublicacion}}</th>
                <td>{{ publicacion.publicacion.descripcion }}</td>
                <td>{{ publicacion.publicacion.superficie_total }}</td>
                <td>{{ publicacion.publicacion.direccion }}</td>
                <td>{{ publicacion.publicacion.agua }}</td>
                <td>{{ publicacion.publicacion.luz }}</td>
                <td>{{ publicacion.publicacion.gas }}</td>
                <td>{{ publicacion.publicacion.cloaca }}</td>
                <td>{{ publicacion.publicacion.ambientes }}</td>
                <td>{{ publicacion.publicacion.dormitorios }}</td>
                <td>{{ publicacion.publicacion.banos }}</td>
                <td>{{ publicacion.publicacion.antiguedad }}</td>
                <td>{{ publicacion.publicacion.cantidad_pisos }}</td>
                <td>{{ publicacion.publicacion.pisos_unidad }}</td>
                <td>{{ publicacion.publicacion.departamentos_por_piso }}</td>
                <td>{{ publicacion.publicacion.tipoinmueble_id }}</td>
                <td>
                    <i class="bi bi-pen" @click="editarInmueble(publicacion)" data-bs-toggle="modal" data-bs-target="#exampleModal" v-if="publicacion.publicacion.deleted_at == null">Editar</i>
                    <br v-if="publicacion.publicacion.deleted_at == null">
                    <i class="bi bi-pen" @click="desactivarInmueble(publicacion)" v-if="publicacion.publicacion.deleted_at == null">Desactivar</i>
                    <br v-if="publicacion.publicacion.deleted_at == null">
                    <i class="bi bi-pen" @click="activarInmueble(publicacion)" v-if="publicacion.publicacion.deleted_at">Activar</i>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="col-12" v-if="publicaciones.links">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <li class="page-item" :class="{'disabled': !link.url}" v-for="link in publicaciones.links">
                        <a class="page-link" disabled="link.active == false" :href="link.url" v-html="link.label"></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form v-on:submit.prevent>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Inmueble</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="file" class="form-control" v-on:change="onChange" multiple>

                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" :class="{'border-danger': form.errors.nombrePublicacion}" class="form-control" id="nombre" v-model="form.nombrePublicacion">
                        <p class="text-danger" v-if="form.hasErrors && form.errors.nombrePublicacion">
                            {{ form.errors.nombrePublicacion }}
                        </p>

                        <label for="descripcion" class="form-label">Descripcion</label>
                        <input type="text" :class="{'border-danger': form.errors['inmueble.descripcion']}" class="form-control" id="descripcion" v-model="form.inmueble.descripcion">
                        <p class="text-danger" v-if="form.hasErrors && form.errors['inmueble.descripcion']">
                            {{ form.errors['inmueble.descripcion'] }}
                        </p>

                        <label class="form-label">Seleccionar Tipo</label>
                        <select :class="{'border-danger': form.errors['inmueble.tipoinmueble_id']}" class="form-select" aria-label="Default select example" v-model="form.inmueble.tipoinmueble_id">
                            <option selected>Seleccionar</option>
                            <option value="Terrenos y Lotes">Terrenos y Lotes</option>
                            <option value="Casa">Casa</option>
                            <option value="Departamento">Departamento</option>
                        </select>
                        <p class="text-danger" v-if="form.hasErrors && form.errors['inmueble.tipoinmueble_id']">
                            {{ form.errors['inmueble.tipoinmueble_id'] }}
                        </p>

                        <GMapMap
                            :center="center"
                            class="mt-2"
                            map-type-id="terrain"
                            style="height: 300px"
                            :zoom="zoom"
                        >
                            <GMapMarker
                                :key="index"
                                v-for="(m, index) in markers"
                                :position="m.position"
                            />
                        </GMapMap>

                        <label class="form-label">Direcci&oacute;n</label>
                        <GMapAutocomplete
                            :class="{'border-danger': form.errors['inmueble.direccion']}"
                            v-model="form.inmueble.direccion"
                            :value="form.inmueble.direccion"
                            class="form-control"
                            placeholder="Ingresar dirección"
                            @place_changed="setPlace"
                        >
                        </GMapAutocomplete>
                        <p class="text-danger" v-if="form.hasErrors && form.errors['inmueble.direccion']">
                            {{ form.errors['inmueble.direccion'] }}
                        </p>

                        <label class="form-label">Latitud</label>
                        <input type="text" :class="{'border-danger': form.errors['inmueble.latitud']}" class="form-control" v-model="form.inmueble.latitud">
                        <p class="text-danger" v-if="form.hasErrors && form.errors['inmueble.latitud']">
                            {{ form.errors['inmueble.latitud'] }}
                        </p>

                        <label class="form-label">Longitud</label>
                        <input type="text" :class="{'border-danger': form.errors['inmueble.longitud']}" class="form-control" v-model="form.inmueble.longitud">
                        <p class="text-danger" v-if="form.hasErrors && form.errors['inmueble.longitud']">
                            {{ form.errors['inmueble.longitud'] }}
                        </p>

                        <label for="supTotal" class="form-label">Superficie total</label>
                        <input type="text" :class="{'border-danger': form.errors['inmueble.superficie_total']}" class="form-control" id="supTotal" v-model="form.inmueble.superficie_total">
                        <p class="text-danger" v-if="form.hasErrors && form.errors['inmueble.superficie_total']">
                            {{ form.errors['inmueble.superficie_total'] }}
                        </p>

                        <div v-if="form.inmueble.tipoinmueble_id === 'Terrenos y Lotes'">
                            <div class="form-check form-check-inline mt-2">
                                <input class="form-check-input" type="checkbox" id="agua" v-model="form.inmueble.agua">
                                <label class="form-check-label" for="agua">
                                    Agua
                                </label>
                            </div>

                            <div class="form-check form-check-inline mt-2">
                                <input class="form-check-input" type="checkbox" id="luz" v-model="form.inmueble.luz">
                                <label class="form-check-label" for="luz">
                                    Luz
                                </label>
                            </div>

                            <div class="form-check form-check-inline mt-2">
                                <input class="form-check-input" type="checkbox" id="gas" v-model="form.inmueble.gas">
                                <label class="form-check-label" for="gas">
                                    Gas
                                </label>
                            </div>

                            <div class="form-check form-check-inline mt-2">
                                <input class="form-check-input" type="checkbox" id="Cloaca" v-model="form.inmueble.cloaca">
                                <label class="form-check-label" for="Cloaca">
                                    Cloaca
                                </label>
                            </div>
                        </div>

                        <div v-else-if="form.inmueble.tipoinmueble_id == 'Casa' || form.inmueble.tipoinmueble_id == 'Departamento'">
                            <label class="form-label">Superficie cubierta</label>
                            <input type="text" class="form-control" v-model="form.inmueble.superficie_cubierta">

                            <label class="form-label">Cantidad de ambientes</label>
                            <input type="number" class="form-control" v-model="form.inmueble.ambientes">

                            <label class="form-label">Cantidad de dormitorios</label>
                            <input type="number" class="form-control" v-model="form.inmueble.dormitorios">

                            <label class="form-label">Cantidad de baños</label>
                            <input type="number" class="form-control" v-model="form.inmueble.banos">

                            <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input" type="checkbox" id="Cochera" v-model="form.inmueble.cochera">
                            <label class="form-check-label" for="Cochera">
                                Cochera
                            </label>
                            </div>

                            <br>

                            <label class="form-label">Cantidad de pisos</label>
                            <input type="number" class="form-control" v-model="form.inmueble.cantidad_pisos">

                            <label class="form-label">Antiguedad</label>
                            <input type="number" class="form-control" v-model="form.inmueble.antiguedad">
                        </div>

                        <div v-if="form.inmueble.tipoinmueble_id == 'Departamento'">
                            <label class="form-label">Departamentos por piso</label>
                            <input type="number" class="form-control" v-model="form.inmueble.departamentos_por_piso">

                            <label class="form-label">Cantidad de pisos</label>
                            <input type="number" class="form-control" v-model="form.inmueble.cantidad_pisos">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button ref="buttonCloseModal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button @click="submitEditar" class="btn btn-primary" v-if="modalEditar">Guardar</button>
                    <button @click="submit" class="btn btn-primary" v-else>Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import {defineComponent, onMounted, reactive, ref} from "vue";
import AdminLayout from "../../../Layouts/AdminLayout";
import { useForm } from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2";
import { Inertia } from '@inertiajs/inertia'


export default defineComponent({
    name: 'IndexInmueble',
    layout: AdminLayout,
    props:{
      publicaciones: Object,
    },
    setup(props){
        const form = useForm({
            inmueble: {
                descripcion: null,
                superficie_total: null,
                superficie_cubierta: null,
                direccion: null,
                latitud: null,
                longitud: null,
                agua: false,
                luz: false,
                gas: false,
                cloaca: false,
                cochera: false,
                ambientes: null,
                dormitorios: null,
                banos: null,
                antiguedad: null,
                pisos_unidad: null,
                cantidad_pisos: null,
                departamentos_por_piso: null,
                tipoinmueble_id: null,
            },
            nombrePublicacion: null,
            fotos: [],
        })


        const markers = ref([
            {
                position: {
                    lat: -45.86413, lng: -67.49656
                },
            }
        ]);

        const zoom = ref(6);
        const center = ref({ lat: -45.86413, lng: -67.49656 });

        const buttonCloseModal = ref(null)
        const modalEditar = ref(false)

        const submit = () => {
            form.post('/admin/dashboard/inmuebles',{
                onSuccess: success => {
                    Swal.fire(
                        'Inmueble agregado correctamente!',
                        '',
                        'success'
                    )
                    form.reset();
                    buttonCloseModal.value.click();
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

        const submitEditar = () => {
            form.put('/admin/dashboard/inmueble/'+form.inmueble.id,{
                onSuccess: success => {
                    Swal.fire(
                        'Inmueble modificado correctamente!',
                        '',
                        'success'
                    )
                    form.reset();
                    buttonCloseModal.value.click();
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



        const setPlace = (place) => {
            form.inmueble.direccion = place.formatted_address;
            form.inmueble.latitud = Number(place.geometry.location.lat());
            form.inmueble.longitud = Number(place.geometry.location.lng());
            markers.value[0].position.lat = Number(place.geometry.location.lat());
            markers.value[0].position.lng = Number(place.geometry.location.lng());
            zoom.value = 10;
            center.value.lat = Number(place.geometry.location.lat());
            center.value.lng = Number(place.geometry.location.lng());
        }

        const onChange = (e) =>{
            for (var i = 0; i < e.target.files.length; i++) {
                form.fotos.push(e.target.files[i]);
            }
        }

        const editarInmueble = (data) =>{
            form.inmueble = Object.assign({},data.publicacion);
            form.nombrePublicacion = data.nombrePublicacion;
            modalEditar.value = true;
        }

        const desactivarInmueble = (data)=>{
            form.inmueble = Object.assign({},data.publicacion);
            Swal.fire({
                title: 'Queres desactivar este inmueble?',
                text: "Va a desaparecer de las publicaciones!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, desactivar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.delete('/admin/dashboard/inmueble/'+form.inmueble.id,{
                        onSuccess: success => {
                            Swal.fire(
                                'Inmueble desactivado correctamente!',
                                '',
                                'success'
                            )
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
            })
        }

        const activarInmueble = (data)=>{
            form.inmueble = Object.assign({},data.publicacion);
            Swal.fire({
                title: 'Queres activar este inmueble?',
                text: "Va a aparecer nuevamanente en las publicaciones!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, activar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.post('/admin/dashboard/inmueble/'+form.inmueble.id,{
                        onSuccess: success => {
                            Swal.fire(
                                'Inmueble activado correctamente!',
                                '',
                                'success'
                            )
                            Inertia.reload({ only: ['publicaciones'] });
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
            })
        }


        return{
            form,
            submit,
            setPlace,
            markers,
            zoom,
            center,
            onChange,
            buttonCloseModal,
            editarInmueble,
            modalEditar,
            submitEditar,
            desactivarInmueble,
            activarInmueble
        }
    }
})
</script>
<style>
.pac-container.pac-logo {
    z-index: 999999;
}
</style>
