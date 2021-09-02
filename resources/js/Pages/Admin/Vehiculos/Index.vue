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
                <th scope="col">Direccion</th>
                <th scope="col">Tipo Vehiculo</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Año</th>
                <th scope="col">Kilometros</th>
                <th scope="col">Color</th>
                <th scope="col">Combustible</th>
                <th scope="col">Puertas</th>
                <th scope="col">Transmision</th>
                <th scope="col">Motor</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="vehiculo in vehiculos.data">
                <th scope="row">{{vehiculo.nombrePublicacion}}</th>
                <td>{{ vehiculo.publicacion.direccion }}</td>
                <td>{{ vehiculo.publicacion.tipovehiculo_id }}</td>
                <td>{{ vehiculo.publicacion.marca_id }}</td>
                <td>{{ vehiculo.publicacion.modelo_id }}</td>
                <td>{{ vehiculo.publicacion.ano }}</td>
                <td>{{ vehiculo.publicacion.km }}</td>
                <td>{{ vehiculo.publicacion.color }}</td>
                <td>{{ vehiculo.publicacion.tipo_combustible }}</td>
                <td>{{ vehiculo.publicacion.puertas }}</td>
                <td>{{ vehiculo.publicacion.transmision }}</td>
                <td>{{ vehiculo.publicacion.motor }}</td>
                <td>
                    <i class="bi bi-pen" @click="editarInmueble(vehiculo)" data-bs-toggle="modal" data-bs-target="#exampleModal" v-if="vehiculo.publicacion.deleted_at == null">Editar</i>
                    <br v-if="vehiculo.publicacion.deleted_at == null">
                    <i class="bi bi-pen" @click="desactivarInmueble(vehiculo)" v-if="vehiculo.publicacion.deleted_at == null">Desactivar</i>
                    <br v-if="vehiculo.publicacion.deleted_at == null">
                    <i class="bi bi-pen" @click="activarInmueble(vehiculo)" v-if="vehiculo.publicacion.deleted_at">Activar</i>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="col-12" v-if="vehiculos.links">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <li class="page-item" :class="{'disabled': !link.url}" v-for="link in vehiculos.links">
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
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Vehiculo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="file" class="form-control" v-on:change="onChange" multiple>

                        <label for="nombre" class="form-label">Nombre Publicacion</label>
                        <input type="text" :class="{'border-danger': form.errors.nombrePublicacion}" class="form-control" id="nombre" v-model="form.nombrePublicacion">
                        <p class="text-danger" v-if="form.hasErrors && form.errors.nombrePublicacion">
                            {{ form.errors.nombrePublicacion }}
                        </p>

                        <label for="descripcion" class="form-label">Descripcion</label>
                        <textarea type="text" :class="{'border-danger': form.errors['vehiculo.descripcion']}" class="form-control" id="descripcion" v-model="form.vehiculo.descripcion" />
                        <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.descripcion']">
                            {{ form.errors['vehiculo.descripcion'] }}
                        </p>

                        <label class="form-label">Seleccionar Tipo</label>
                        <select :class="{'border-danger': form.errors['vehiculo.tipovehiculo_id']}" class="form-select" aria-label="Default select example" v-model="form.vehiculo.tipovehiculo_id">
                            <option selected>Seleccionar</option>
                            <option value="Auto">Auto</option>
                            <option value="Camioneta">Camioneta</option>
                            <option value="Maquina vial">Maquina vial</option>
                        </select>
                        <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.tipovehiculo_id']">
                            {{ form.errors['vehiculo.tipovehiculo_id'] }}
                        </p>

                        <label class="form-label">Direcci&oacute;n</label>
                        <GMapAutocomplete
                            :class="{'border-danger': form.errors['vehiculo.direccion']}"
                            v-model="form.vehiculo.direccion"
                            :value="form.vehiculo.direccion"
                            class="form-control"
                            placeholder="Ingresar dirección"
                            @place_changed="setPlace"
                        >
                        </GMapAutocomplete>
                        <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.direccion']">
                            {{ form.errors['vehiculo.direccion'] }}
                        </p>

                        <label for="año" class="form-label">Año</label>
                        <input type="text" :class="{'border-danger': form.errors['vehiculo.ano']}" class="form-control" id="año" v-model="form.vehiculo.ano">
                        <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.ano']">
                            {{ form.errors['vehiculo.ano'] }}
                        </p>

                        <label for="color" class="form-label">Color</label>
                        <input type="text" :class="{'border-danger': form.errors['vehiculo.color']}" class="form-control" id="color" v-model="form.vehiculo.color">
                        <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.color']">
                            {{ form.errors['vehiculo.color'] }}
                        </p>

                        <label class="form-label">Marca</label>
                        <select @change="marcaSeleccionada" :class="{'border-danger': form.errors['vehiculo.marca_id']}" class="form-select" aria-label="Default select example" v-model="form.vehiculo.marca_id">
                            <option selected>Seleccionar marca</option>
                            <option v-for="marca in marcas" :value="marca.id">{{ marca.id }}</option>
                        </select>
                        <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.marca_id']">
                            {{ form.errors['vehiculo.marca_id'] }}
                        </p>

                        <label class="form-label">Modelo</label>
                        <select :class="{'border-danger': form.errors['vehiculo.modelo_id']}" class="form-select" aria-label="Default select example" v-model="form.vehiculo.modelo_id">
                            <option selected>Seleccionar modelo</option>
                            <option v-for="modelo in modelos" :value="modelo.id">{{ modelo.id }}</option>
                        </select>
                        <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.modelo_id']">
                            {{ form.errors['vehiculo.modelo_id'] }}
                        </p>

                        <label class="form-label">Tipo combustible</label>
                        <select :class="{'border-danger': form.errors['vehiculo.tipo_combustible']}" class="form-select" aria-label="Default select example" v-model="form.vehiculo.tipo_combustible">
                            <option selected>Seleccionar</option>
                            <option value="Nafta">Nafta</option>
                            <option value="Diésel">Diésel</option>
                            <option value="Nafta/GNC">Nafta/GNC</option>
                            <option value="Eléctrico">Eléctrico</option>
                            <option value="GNC">GNC</option>
                            <option value="Híbrido/Nafta">Híbrido/Nafta</option>
                            <option value="Híbridol">Híbrido</option>
                        </select>
                        <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.tipo_combustible']">
                            {{ form.errors['vehiculo.tipo_combustible'] }}
                        </p>

                        <label for="puertas" class="form-label">Puertas</label>
                        <input type="number" :class="{'border-danger': form.errors['vehiculo.puertas']}" class="form-control" id="puertas" v-model="form.vehiculo.puertas">
                        <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.puertas']">
                            {{ form.errors['vehiculo.puertas'] }}
                        </p>

                        <label class="form-label">Transmisión</label>
                        <select :class="{'border-danger': form.errors['vehiculo.transmision']}" class="form-select" aria-label="Default select example" v-model="form.vehiculo.transmision">
                            <option selected>Seleccionar</option>
                            <option value="Manual">Manual</option>
                            <option value="Automática">Automática</option>
                            <option value="Automática secuencial">Automática secuencial</option>
                            <option value="Semiautomática">Semiautomática</option>
                            <option value="Mecánica">Mecánica</option>
                        </select>
                        <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.transmision']">
                            {{ form.errors['vehiculo.transmision'] }}
                        </p>

                        <label for="motor" class="form-label">Motor</label>
                        <input type="text" :class="{'border-danger': form.errors['vehiculo.puertas']}" class="form-control" id="motor" v-model="form.vehiculo.motor">
                        <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.motor']">
                            {{ form.errors['vehiculo.motor'] }}
                        </p>

                        <label for="km" class="form-label">Kilometraje</label>
                        <input type="number" :class="{'border-danger': form.errors['vehiculo.km']}" class="form-control" id="km" v-model="form.vehiculo.km">
                        <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.km']">
                            {{ form.errors['vehiculo.km'] }}
                        </p>

                        <label for="velocidades" class="form-label">Velocidades</label>
                        <input type="number" :class="{'border-danger': form.errors['vehiculo.velocidades']}" class="form-control" id="velocidades" v-model="form.vehiculo.velocidades">
                        <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.velocidades']">
                            {{ form.errors['vehiculo.velocidades'] }}
                        </p>

                        <label for="potencia" class="form-label">Potencia</label>
                        <input type="number" :class="{'border-danger': form.errors['vehiculo.potencia']}" class="form-control" id="potencia" v-model="form.vehiculo.potencia">
                        <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.potencia']">
                            {{ form.errors['vehiculo.potencia'] }}
                        </p>

                        <label for="capacidad_tanque" class="form-label">Capacidad de tanque</label>
                        <input type="number" :class="{'border-danger': form.errors['vehiculo.capacidad_tanque']}" class="form-control" id="capacidad_tanque" v-model="form.vehiculo.capacidad_tanque">
                        <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.capacidad_tanque']">
                            {{ form.errors['vehiculo.capacidad_tanque'] }}
                        </p>

                        <div v-if="form.vehiculo.tipovehiculo_id === 'Maquina vial'">
                            <label for="horas_trabajadas" class="form-label">Horas trabajadas</label>
                            <input type="number" :class="{'border-danger': form.errors['vehiculo.horas_trabajadas']}" class="form-control" id="horas_trabajadas" v-model="form.vehiculo.horas_trabajadas">
                            <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.horas_trabajadas']">
                                {{ form.errors['vehiculo.horas_trabajadas'] }}
                            </p>

                            <label for="capacidad_balde" class="form-label">Capacidad balde</label>
                            <input type="number" :class="{'border-danger': form.errors['vehiculo.capacidad_balde']}" class="form-control" id="capacidad_balde" v-model="form.vehiculo.capacidad_balde">
                            <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.capacidad_balde']">
                                {{ form.errors['vehiculo.capacidad_balde'] }}
                            </p>

                            <label for="capacidad_carga" class="form-label">Capacidad carga</label>
                            <input type="number" :class="{'border-danger': form.errors['vehiculo.capacidad_carga']}" class="form-control" id="capacidad_carga" v-model="form.vehiculo.capacidad_carga">
                            <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.capacidad_carga']">
                                {{ form.errors['vehiculo.capacidad_carga'] }}
                            </p>

                            <label for="capacidad_cuchara" class="form-label">Capacidad cuchara</label>
                            <input type="number" :class="{'border-danger': form.errors['vehiculo.capacidad_cuchara']}" class="form-control" id="capacidad_cuchara" v-model="form.vehiculo.capacidad_cuchara">
                            <p class="text-danger" v-if="form.hasErrors && form.errors['vehiculo.capacidad_cuchara']">
                                {{ form.errors['vehiculo.capacidad_cuchara'] }}
                            </p>

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
import {defineComponent, ref} from "vue";
import AdminLayout from "../../../Layouts/AdminLayout";
import { useForm } from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2";
import { Inertia } from '@inertiajs/inertia'


export default defineComponent({
    name: 'IndexVehiculos',
    layout: AdminLayout,
    props:{
        vehiculos: Object,
        marcas: Object,
    },
    setup(props){
        const form = useForm({
            vehiculo: {
                marca_id: null,
                modelo_id: null,
                direccion: null,
                ano: null,
                color: null,
                latitud: null,
                longitud: null,
                tipo_combustible: null,
                puertas: null,
                transmision: null,
                motor: null,
                km: null,
                velocidades: null,
                capacidad_tanque: null,
                potencia: null,
                peso: null,
                capacidad_balde: null,
                capacidad_carga: null,
                capacidad_cuchara: null,
                horas_trabajadas: null,
                tipovehiculo_id: null,
            },
            nombrePublicacion: null,
            fotos: [],
        })

        const modelos = ref([]);


        const buttonCloseModal = ref(null)
        const modalEditar = ref(false)

        const submit = () => {
            form.post('/admin/dashboard/vehiculos',{
                onSuccess: success => {
                    Swal.fire(
                        'Vehiculo agregado correctamente!',
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
            form.put('/admin/dashboard/vehiculo/'+form.vehiculo.id,{
                onSuccess: success => {
                    Swal.fire(
                        'Vehiculo modificado correctamente!',
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
            form.vehiculo.direccion = place.formatted_address;
            form.vehiculo.latitud = Number(place.geometry.location.lat());
            form.vehiculo.longitud = Number(place.geometry.location.lng());
        }

        const onChange = (e) =>{
            for (var i = 0; i < e.target.files.length; i++) {
                form.fotos.push(e.target.files[i]);
            }
        }

        const editarInmueble = (data) =>{
            form.vehiculo = Object.assign({},data.publicacion);
            form.nombrePublicacion = data.nombrePublicacion;
            marcaSeleccionada();
            modalEditar.value = true;
        }

        const desactivarInmueble = (data)=>{
            form.vehiculo = Object.assign({},data.publicacion);
            Swal.fire({
                title: 'Queres desactivar este Vehiculo?',
                text: "Va a desaparecer de las publicaciones!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, desactivar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.delete('/admin/dashboard/vehiculo/'+form.vehiculo.id,{
                        onSuccess: success => {
                            Swal.fire(
                                'Vehiculo desactivado correctamente!',
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
            form.vehiculo = Object.assign({},data.publicacion);
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
                    form.post('/admin/dashboard/vehiculo/'+form.vehiculo.id,{
                        onSuccess: success => {
                            Swal.fire(
                                'Vehiculo activado correctamente!',
                                '',
                                'success'
                            )
                            Inertia.reload({ only: ['vehiculos'] });
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

        const marcaSeleccionada = (event) =>{
            axios.post(`/marca/${form.vehiculo.marca_id}/modelos`)
            .then(resp=>{
                console.log(resp.data);
                modelos.value = resp.data;
            })
        }


        return{
            form,
            submit,
            setPlace,
            onChange,
            buttonCloseModal,
            editarInmueble,
            modalEditar,
            submitEditar,
            desactivarInmueble,
            activarInmueble,
            modelos,
            marcaSeleccionada
        }
    }
})
</script>
<style>
.pac-container.pac-logo {
    z-index: 999999;
}
</style>
