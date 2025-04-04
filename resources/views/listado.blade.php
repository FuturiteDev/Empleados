@extends('erp.base')

@section('content')
    <div id="app">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content">
            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Staff</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('home') }}" class="text-muted text-hover-primary">Inicio</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Staff</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->
                </div>
                <!--end::Toolbar container-->
            </div>
            <!--begin::Card-->
            <div class="card card-flush" id="content-card">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title flex-column">
                        <h3 class="ps-2">Listado de Staff</h3>
                    </div>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_empleado" @click="">
                            <i class="ki-outline ki-plus fs-2"></i> Agregar
                        </button>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <v-client-table v-model="empleados" :columns="columns" :options="options">
                        <div slot="acciones" slot-scope="props">
                            <a type="button" title="Ver detalle" class="btn btn-icon btn-sm btn-success" :href="`/empleados/detalle/${props.row.id}`"><i class="fas fa-eye"></i></a>
                            <button type="button" title="Eliminar" class="btn btn-icon btn-sm btn-danger" @click="deleteEmpleado(props.row.id)" :data-kt-indicator="props.row.eliminando ? 'on' : 'off'">
                                <span class="indicator-label"><i class="fas fa-trash-alt"></i></span>
                                <span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle"></span></span>
                            </button>
                        </div>
                    </v-client-table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content-->

        <!--begin::Modal - Add empleado-->
        <div class="modal fade" id="kt_modal_add_empleado" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-focus="false">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <h2 class="fw-bold">Agregar empleado</h2>
                        <!--begin::Close-->
                        <div class="btn btn-close" data-bs-dismiss="modal"></div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body">
                        <!--begin::Form-->
                        <form id="kt_modal_add_empleado_form" novalidate="novalidate" class="form" action="#" @submit.prevent="">
                            <!--begin::Step 1-->
                            <div class="mx-5">
                                <div class="row">
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="required fw-semibold fs-6 ms-2">Número de empleado</label>
                                        <input type="text" class="form-control" v-model="empleado_model.no_empleado" name="num_empleado"/>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="required fw-semibold fs-6 ms-2">Nombre(s)</label>
                                        <input type="text" class="form-control" v-model="empleado_model.nombre" name="nombre"/>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="required fw-semibold fs-6 ms-2">Apellido(s)</label>
                                        <input type="text" class="form-control" v-model="empleado_model.apellidos" name="apellidos"/>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <span>
                                            <label class="fw-semibold fs-6 ms-2">Alias</label>
                                            <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Como le gusta que le digamos"></i>
                                        </span>
                                        <input type="text" class="form-control" v-model="empleado_model.alias" name="alias"/>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="fw-semibold fs-6 ms-2">RFC</label>
                                        <input type="text" class="form-control" v-model="empleado_model.rfc" name="rfc"/>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="fw-semibold fs-6 ms-2">CURP</label>
                                        <input type="text" class="form-control" v-model="empleado_model.curp" name="curp"/>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="fw-semibold fs-6 ms-2">INE</label>
                                        <input type="text" class="form-control" v-model="empleado_model.ine" name="ine"/>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="fw-semibold fs-6 ms-2">Seguro Social(NSS)</label>
                                        <input type="text" class="form-control" v-model="empleado_model.nss" name="nss"/>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <span>
                                            <label class="form-label text-dark mb-0 ms-2">Dirección domicilio</label>
                                            <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Como viene en la INE"></i>
                                        </span>
                                        <textarea rows="5" class="form-control" v-model="empleado_model.domicilio_ine" name="domicilio_ine" style="resize:none;"></textarea>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Dirección fiscal</label>
                                        <textarea rows="5" class="form-control" v-model="empleado_model.domicilio_fiscal" name="domicilio_fiscal" style="resize:none;"></textarea>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="fw-semibold fs-6 ms-2">Dirección donde vive</label>
                                        <textarea rows="5" class="form-control" v-model="empleado_model.domicilio_actual" name="domicilio_actual" style="resize:none;"></textarea>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="fw-semibold fs-6 ms-2">Teléfono casa</label>
                                        <input type="tel" class="form-control" v-model="empleado_model.telefono" name="telefono"/>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="fw-semibold fs-6 ms-2">Teléfono celular</label>
                                        <input type="tel" class="form-control" v-model="empleado_model.celular" name="celular"/>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="fw-semibold fs-6 ms-2">Email personal</label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" v-model="empleado_model.email" name="email"/>
                                            <span class="input-group-text">@</span>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="fw-semibold fs-6 ms-2">Email trabajo</label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" v-model="empleado_model.email_trabajo" name="email_trabajo"/>
                                            <span class="input-group-text">@</span>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="fw-semibold fs-6 ms-2">Fecha de nacimiento</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="empleado_model.fecha_nacimiento" name="fecha_nacimiento" id="fecha_nacimiento"/>
                                            <span class="input-group-text">
                                                <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="fw-semibold fs-6 ms-2">Fecha ingreso a la empresa</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="empleado_model.fecha_ingreso" name="fecha_ingreso" id="fecha_ingreso"/>
                                            <span class="input-group-text">
                                                <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <label class="fw-semibold fs-6 ms-2">Fecha alta en el IMSS</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="empleado_model.fecha_alta_imss" name="fecha_alta_imss" id="fecha_alta_imss"/>
                                            <span class="input-group-text">
                                                <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Actions-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="saveEmpleado" :disabled="loading" :data-kt-indicator="loading ? 'on' : 'off'">
                            <span class="indicator-label">Guardar</span>
                            <span class="indicator-progress">Guardando <span class="spinner-border spinner-border-sm align-middle"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - Add empleado-->

    </div>
@endsection

@section('scripts')
    <script src="/common_assets/js/vue-tables-2.min.js"></script>
    <script src="/common_assets/js/vue2-filters.min.js"></script>
    <script src="/common_assets/js/vue_components/v-select.js"></script>
    <script src="/common_assets/js/vue_components/v-currency.js"></script>

    <script>
        const app = new Vue({
            el: '#app',
            delimiters: ['[[', ']]'],
            data: () => ({
                empleados: [],
                columns: ['no_empleado', 'nombre_completo', 'telefono', 'celular', 'acciones'],
                options: {
                    headings: {
                        no_empleado: 'Número empleado',
                        nombre_completo: 'Empleado',
                        telefono: 'Teléfono',
                    },
                    columnsClasses: {
                        no_empleado: 'align-middle px-2 ',
                        nombre_completo: 'align-middle ',
                        domicilio_actual: 'align-middle ',
                        telefono: 'align-middle ',
                        celular: 'align-middle ',
                        acciones: 'align-middle text-center px-2 ',
                    },
                    sortable: ['nombre_completo', 'no_empleado'],
                    filterable: ['nombre_completo', 'no_empleado'],
                    skin: 'table table-sm table-rounded table-striped border align-middle table-row-bordered fs-6',
                    columnsDropdown: true,
                    resizableColumns: false,
                    sortIcon: {
                        base: 'ms-3 fas',
                        up: 'fa-sort-asc text-gray-400',
                        down: 'fa-sort-desc text-gray-400',
                        is: 'fa-sort text-gray-400',
                    },
                    texts: {
                        count: "Mostrando {from} de {to} de {count} registros|{count} registros|Un registro",
                        first: "Primera",
                        last: "Última",
                        filterPlaceholder: "Buscar...",
                        limit: "Registros:",
                        page: "Página:",
                        noResults: "No se encontraron resultados",
                        loading: "Cargando...",
                        columns: "Columnas",
                    },
                },
                listaDias: [
                    {id:'lunes', text:'Lunes'},
                    {id:'martes', text:'Martes'},
                    {id:'miercoles', text:'Miercoles'},
                    {id:'jueves', text:'Jueves'},
                    {id:'viernes', text:'Viernes'},
                    {id:'sabado', text:'Sabado'},
                    {id:'domingo', text:'Domingo'},
                ],

                empleado_model: {},

                isEdit: false,
                validator: null,
                loading: false,
                blockUI: null,
                requestGet: null,

            }),
            mounted() {
                let vm = this;
                vm.$forceUpdate();

                let container = document.querySelector('#content-card');
                if (container) {
                    vm.blockUI = new KTBlockUI(container);
                }
                vm.getEmpleados(true);
                vm.initPickers();
                vm.initformValidate();

                $("#kt_modal_add_empleado").on('hidden.bs.modal', event => {
                    vm.initformValidate();
                    vm.empleado_model = {};
                });
                $("#kt_modal_add_empleado").on('shown.bs.modal', () => {

                });
            },
            methods: {
                // Init
                initPickers(){
                    $("#fecha_nacimiento").flatpickr({
                        dateFormat: "d/m/Y"
                    });
                    $("#fecha_ingreso").flatpickr({
                        dateFormat: "d/m/Y"
                    });
                    $("#fecha_alta_imss").flatpickr({
                        dateFormat: "d/m/Y"
                    });
                },
                initformValidate() {
                    let genValidator = {
                        validators: {
                            notEmpty: {
                                message: 'Campo requerido',
                                trim: true
                            }
                        }
                    };
                    let emailValidator = {
                        validators: {
                            notEmpty: {
                                message: 'Campo requerido',
                                trim: true
                            }
                        },
                        emailAddress: {
                            message: 'Correo invalido',
                        },
                    };
                    let numValidator = {
                        validators: {
                            notEmpty: {
                                message: 'Campo requerido',
                                trim: true
                            }
                        },
                        integer: {
                            message: 'Valor invalido',
                            thousandsSeparator: '',
                            decimalSeparator: '.',
                        },
                    };
                    let fechaValidator = {
                        callback: {
                            callback: function (input) {
                                if(!input.value || input.value==null || input.value==""){
                                    return {
                                        valid: false,
                                        message: 'Fecha invalida'
                                    };
                                }
                                let today = moment();
                                let value = moment(input.value, "DD/MM/Y");

                                if(!value.isValid()){
                                    return {
                                        valid: false,
                                        message: 'Fecha invalida'
                                    };
                                }
                                return { valid: true, message: '' };
                            },
                        },
                    };

                    if(this.validator){
                        this.validator.destroy();
                        this.validator = null;
                    }

                    this.validator = FormValidation.formValidation(
                        document.getElementById('kt_modal_add_empleado_form'), {
                            fields: {
                                'nombre': genValidator,
                                'apellidos': genValidator,
                                'no_empleado': numValidator,
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap: new FormValidation.plugins.Bootstrap5({
                                    rowSelector: '.fv-row',
                                    eleInvalidClass: '',
                                    eleValidClass: ''
                                })
                            },
                        }
                    );
                },
                getEmpleados(showLoader) {
                    let vm = this;
                    if (showLoader) {
                        if (!vm.blockUI) {
                            let container = document.querySelector('#content-card');
                            if (container) {
                                vm.blockUI = new KTBlockUI(container);
                                vm.blockUI.block();
                            }
                        } else {
                            if (!vm.blockUI.isBlocked()) {
                                vm.blockUI.block();
                            }
                        }
                    }

                    if (vm.requestGet) {
                        vm.requestGet.abort();
                        vm.requestGet = null;
                    }

                    vm.loading = true;

                    vm.requestGet = $.ajax({
                        url: '/api/empleados/all',
                        type: 'GET',
                    }).done(function (res) {
                        vm.empleados = res.results;
                    }).fail(function (jqXHR, textStatus) {
                        if (textStatus != 'abort') {
                            console.log("Request failed getEmpleados: " + textStatus, jqXHR);
                        }
                    }).always(function () {
                        vm.loading = false;

                        if (vm.blockUI && vm.blockUI.isBlocked()) {
                            vm.blockUI.release();
                        }
                    });
                },
                saveEmpleado() {
                    let vm = this;
                    if (vm.validator) {
                        vm.validator.validate().then(function (status) {
                            if (status == 'Valid') {
                                vm.loading = true;
                                $.ajax({
                                    method: "POST",
                                    url: "/api/empleados/save-empleado",
                                    data: {
                                        no_empleado: vm.empleado_model.no_empleado,
                                        nombre: vm.empleado_model.nombre,
                                        apellidos: vm.empleado_model.apellidos,
                                        alias: vm.empleado_model.alias,
                                        rfc: vm.empleado_model.rfc,
                                        curp: vm.empleado_model.curp,
                                        ine: vm.empleado_model.ine,
                                        nss: vm.empleado_model.nss,
                                        domicilio_ine: vm.empleado_model.domicilio_ine,
                                        domicilio_actual: vm.empleado_model.domicilio_actual,
                                        domicilio_fiscal: vm.empleado_model.domicilio_fiscal,
                                        telefono: vm.empleado_model.telefono,
                                        celular: vm.empleado_model.celular,
                                        email: vm.empleado_model.email,
                                        email_trabajo: vm.empleado_model.email_trabajo,
                                        fecha_nacimiento: vm.empleado_model.fecha_nacimiento,
                                        fecha_ingreso: vm.empleado_model.fecha_ingreso,
                                        fecha_alta_imss: vm.empleado_model.fecha_alta_imss,
                                    }
                                }).done(function (res) {
                                    if (res.success === true) {
                                        Swal.fire(
                                            "¡Guardado!",
                                            "Los datos de la empleado se han almacenado con éxito",
                                            "success"
                                        );
                                        vm.empleados = res.results;
                                        $('#kt_modal_add_empleado').modal('hide');
                                    } else {
                                        Swal.fire(
                                            "¡Error!",
                                            res?.message ?? "No se pudo crear la empleado",
                                            "warning"
                                        );
                                    }
                                }).fail(function (jqXHR, textStatus) {
                                    console.log("Request failed saveEmpleado: " + textStatus, jqXHR);
                                    Swal.fire("¡Error!", "Ocurrió un error inesperado al procesar la solicitud. Por favor, inténtelo nuevamente.", "error");
                                }).always(function (event, xhr, settings) {
                                    vm.loading = false;
                                });
                            }
                        });
                    }
                },
                deleteEmpleado(idEmpleado) {
                    let vm = this;
                    Swal.fire({
                        title: '¿Estas seguro de que deseas eliminar el registro de la empleado?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, eliminar',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            vm.loading = true;
                            let index = vm.empleados.findIndex(item => item.id == idEmpleado);
                            if(index >= 0){
                                vm.$set(vm.empleados[index], 'eliminando', true);
                            }
                            $.ajax({
                                method: "POST",
                                url: "/api/empleados/delete",
                                data: {
                                    empleado_id: idEmpleado
                                }
                            }).done(function (res) {
                                if (res.success === true) {
                                    Swal.fire(
                                        'Registro eliminado',
                                        'El registro de la empleado ha sido eliminado con éxito',
                                        'success'
                                    );
                                    vm.empleados = res.results;
                                } else {
                                    Swal.fire(
                                        "¡Error!",
                                        res?.message ?? "No se pudo crear la empleado",
                                        "warning"
                                    );
                                }
                            }).fail(function (jqXHR, textStatus) {
                                console.log("Request failed deleteEmpleado: " + textStatus, jqXHR);
                                Swal.fire("¡Error!", "Ocurrió un error inesperado al procesar la solicitud. Por favor, inténtelo nuevamente.", "error");

                                index = vm.empleados.findIndex(item => item.id == idEmpleado);
                                if(index >= 0){
                                    vm.$set(vm.empleados[index], 'eliminando', false);
                                }
                            }).always(function (event, xhr, settings) {
                                vm.loading = false;
                            });
                        }
                    })
                },
            },
        });

        Vue.use(VueTables.ClientTable);
    </script>
@endsection
