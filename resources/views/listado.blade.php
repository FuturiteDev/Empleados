@extends('erp.base')

@section('content')
    <style>
        .stepper.stepper-pills .stepper-item.current.mark-completed:last-child .stepper-icon, .stepper.stepper-pills .stepper-item.completed .stepper-icon {
            background-color: var(--bs-gray-200);
        }
        .stepper.stepper-pills .stepper-item.current.mark-completed:last-child .stepper-icon .stepper-check, .stepper.stepper-pills .stepper-item.completed .stepper-icon .stepper-check {
            color: var(--bs-gray-400);
        }
    </style>

    <div id="app">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content">
            <!--begin::Card-->
            <div class="card card-flush" id="content-card">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title flex-column">
                        <h3 class="ps-2">Listado de Empleados</h3>
                    </div>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_empleado">
                            <i class="ki-outline ki-plus fs-2"></i> Agregar Empleado
                        </button>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <v-client-table v-model="empleados" :columns="columns" :options="options">
                        <div slot="acciones" slot-scope="props">
                            <button type="button" class="btn btn-icon btn-sm btn-success" title="Ver/Editar Empleado" data-bs-toggle="modal" data-bs-target="#kt_modal_add_empleado" @click.prevent="selectEmpleado(props.row)">
                                <i class="fas fa-pencil"></i>
                            </button>

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
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <h2 class="fw-bold" v-text="Agregar empleado"></h2>
                        <!--begin::Close-->
                        <div class="btn btn-close" data-bs-dismiss="modal"></div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body stepper stepper-pills" id="stepper">
                        
                        <!--begin::Nav-->
                        <div class="stepper-nav flex-center flex-wrap mb-10">
                            <!--begin::Step 1-->
                            <div class="stepper-item mx-4 current" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                <div class="stepper-wrapper d-flex align-items-center flex-column">
                                    <!--begin::Icon-->
                                    <div class="m-0 p-7 rounded-circle stepper-icon">
                                        <i class="fa-solid fa-user stepper-number fs-6"></i>
                                        <i class="stepper-check fs-6 fa-solid fa-user"></i>
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Label-->
                                    <div class="stepper-label mt-2">
                                        <h3 class="stepper-title fs-4"></h3>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--begin::Line-->
                                <div class="stepper-line h-40px"></div>
                                <!--end::Line-->
                            </div>
                            <!--end::Step 1-->
                            <!--begin::Step 2-->
                            <div class="stepper-item mx-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                <div class="stepper-wrapper d-flex align-items-center flex-column">
                                    <!--begin::Icon-->
                                    <div class="m-0 p-7 rounded-circle stepper-icon">
                                        <i class="fa-solid fa-briefcase stepper-number fs-6"></i>
                                        <i class="stepper-check fs-6 fa-solid fa-briefcase"></i>
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Label-->
                                    <div class="stepper-label mt-2">
                                        <h3 class="stepper-title fs-4"></h3>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--begin::Line-->
                                <div class="stepper-line h-40px"></div>
                                <!--end::Line-->
                            </div>
                            <!--end::Step 2-->
                            <!--begin::Step 3-->
                            <div class="stepper-item mx-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                <div class="stepper-wrapper d-flex align-items-center flex-column">
                                    <!--begin::Icon-->
                                    <div class="m-0 p-7 rounded-circle stepper-icon">
                                        <i class="fas fa-money-check-alt stepper-number fs-6"></i>
                                        <i class="stepper-check fs-6 fas fa-money-check-alt"></i>
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Label-->
                                    <div class="stepper-label mt-2">
                                        <h3 class="stepper-title fs-4"></h3>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--begin::Line-->
                                <div class="stepper-line h-40px"></div>
                                <!--end::Line-->
                            </div>
                            <!--end::Step 3-->
                            <!--begin::Step 4-->
                            <div class="stepper-item mx-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                <div class="stepper-wrapper d-flex align-items-center flex-column">
                                    <!--begin::Icon-->
                                    <div class="m-0 p-7 rounded-circle stepper-icon">
                                        <i class="fas fa-hand-holding-heart stepper-number fs-6"></i>
                                        <i class="stepper-check fs-6 fas fa-hand-holding-heart"></i>
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Label-->
                                    <div class="stepper-label mt-2">
                                        <h3 class="stepper-title fs-4"></h3>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--begin::Line-->
                                <div class="stepper-line h-40px"></div>
                                <!--end::Line-->
                            </div>
                            <!--end::Step 4-->
                        </div>
                        <!--end::Nav-->

                        <!--begin::Form-->
                        <form id="kt_modal_add_empleado_form" novalidate="novalidate" class="form" action="#" @submit.prevent="">
                            <div class="mh-400px scroll">
                                <!--begin::Step 1-->
                                <div class="current mx-5" data-kt-stepper-element="content">
                                    <div class="row">
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Nombre completo</label>
                                            <input type="text" class="form-control" v-model="empleado_model.nombre" name="nombre"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <span>
                                                <label class="required fw-semibold fs-6 ms-2">Alias</label>
                                                <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Como le gusta que le digamos"></i>
                                            </span>
                                            <input type="text" class="form-control" v-model="empleado_model.alias" name="alias"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">RFC</label>
                                            <input type="text" class="form-control" v-model="empleado_model.rfc" name="rfc"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">CURP</label>
                                            <input type="text" class="form-control" v-model="empleado_model.curp" name="curp"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Número de INE</label>
                                            <input type="text" class="form-control" v-model="empleado_model.ine" name="ine"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Número de Seguro Social</label>
                                            <input type="text" class="form-control" v-model="empleado_model.nss" name="nss"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <span>
                                                <label class="required fw-semibold fs-6 ms-2">Dirección domicilio</label>
                                                <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Como viene en la INE"></i>
                                            </span>
                                            <input type="text" class="form-control" v-model="empleado_model.direccion_ine" name="direccion_ine"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Dirección fiscal</label>
                                            <input type="text" class="form-control" v-model="empleado_model.direccion_fiscal" name="direccion_fiscal"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Dirección donde vive</label>
                                            <input type="text" class="form-control" v-model="empleado_model.direccion" name="direccion"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Teléfono casa</label>
                                            <input type="tel" class="form-control" v-model="empleado_model.telefono_casa" name="telefono_casa"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Teléfono celular</label>
                                            <input type="tel" class="form-control" v-model="empleado_model.telefono_celular" name="telefono_celular"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Email trabajo</label>
                                            <div class="input-group">
                                                <input type="email" class="form-control" v-model="empleado_model.email_trabajo" name="email_trabajo" id="email_trabajo"/>
                                                <span class="input-group-text">@</span>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Email personal</label>
                                            <div class="input-group">
                                                <input type="email" class="form-control" v-model="empleado_model.email_personal" name="email_personal" id="email_personal"/>
                                                <span class="input-group-text">@</span>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Fecha de nacimiento</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" v-model="empleado_model.fecha_nacimiento" name="fecha_nacimiento" id="fecha_nacimiento"/>
                                                <span class="input-group-text">
                                                    <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Fecha ingreso a la empresa</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" v-model="empleado_model.fecha_ingreso" name="fecha_ingreso" id="fecha_ingreso"/>
                                                <span class="input-group-text">
                                                    <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Fecha alta en el IMSS</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" v-model="empleado_model.fecha_imss" name="fecha_imss" id="fecha_imss"/>
                                                <span class="input-group-text">
                                                    <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Step 1-->
                                <!--begin::Step 2-->
                                <div class="mx-5" data-kt-stepper-element="content">
                                    <div class="row">
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Área de la empresa</label>
                                            <input type="text" class="form-control" v-model="empleado_model.area" name="area"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Nombre del Puesto</label>
                                            <input type="text" class="form-control" v-model="empleado_model.puesto" name="puesto"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Jefe directo</label>
                                            <input type="text" class="form-control" v-model="empleado_model.jefe" name="jefe"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <span>
                                                <label class="required fw-semibold fs-6 ms-2">Sucursal principal</label>
                                                <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Sucursal donde desempeña sus labores"></i>
                                            </span>
                                            <input type="text" class="form-control" v-model="empleado_model.sucursal" name="sucursal"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <span>
                                                <label class="required fw-semibold fs-6 ms-2">Días de la semana a laborar</label>
                                                <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Lunes a Sábado, Lunes a Viernes, Sábado y Domingo, o poder elegir por día de lunes a domingo"></i>
                                            </span>
                                            <v-select 
                                                v-model="empleado_model.dias_laborar"
                                                name="dias_laborar"
                                                :options="listaDias"
                                                data-minimum-results-for-search="Infinity"
                                                data-allow-clear="true"
                                                data-placeholder="Selecciona los días"
                                                multiple="multiple">
                                            </v-select>
                                        </div>
                                        <div class="col-6 mb-7">
                                            <label class="required fw-semibold fs-6 ms-2">Horario de trabajo</label>
                                            <div class="row">
                                                <div class="col-6 fv-row">
                                                    <div class="input-group">
                                                        <span class="input-group-text p-3">
                                                            <i class="ki-duotone ki-time fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                        </span>
                                                        <input class="form-control" id="horario_trabajo_inicio" placeholder="Fecha inicio" name="horario_trabajo_inicio" v-model="empleado_model.horario_trabajo_inicio"/>
                                                    </div>
                                                </div>
                                                <div class="col-6 fv-row">
                                                    <div class="input-group">
                                                        <span class="input-group-text p-3">
                                                            <i class="ki-duotone ki-time fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                        </span>
                                                        <input class="form-control" id="horario_trabajo_fin" placeholder="Fecha fin" name="horario_trabajo_fin" v-model="empleado_model.horario_trabajo_fin"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Horario de comida</label>
                                            <div class="row">
                                                <div class="col-6 fv-row">
                                                    <div class="input-group">
                                                        <span class="input-group-text p-3">
                                                            <i class="ki-duotone ki-time fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                        </span>
                                                        <input class="form-control" id="horario_comida_inicio" placeholder="Fecha inicio" name="horario_comida_inicio" v-model="empleado_model.horario_comida_inicio"/>
                                                    </div>
                                                </div>
                                                <div class="col-6 fv-row">
                                                    <div class="input-group">
                                                        <span class="input-group-text p-3">
                                                            <i class="ki-duotone ki-time fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                        </span>
                                                        <input class="form-control" id="horario_comida_fin" placeholder="Fecha fin" name="horario_comida_fin" v-model="empleado_model.horario_comida_fin"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Step 2-->
                                <!--begin::Step 3-->
                                <div class="mx-5" data-kt-stepper-element="content">
                                    <div class="row">
                                        <div class="col-6 mb-7 fv-row">
                                            <span>
                                                <label class="required fw-semibold fs-6 ms-2">Sueldo Neto Mensual</label>
                                                <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Incluye pago en transferencia más pago en efectivo"></i>
                                            </span>
                                            <v-currency class="form-control" v-model="empleado_model.suelto_neto_mensual" name="suelto_neto_mensual"></v-currency>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <span>
                                                <label class="required fw-semibold fs-6 ms-2">Sueldo Neto Quincenal</label>
                                                <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Incluye pago en transferencia más pago en efectivo"></i>
                                            </span>
                                            <v-currency class="form-control" v-model="empleado_model.sueldo_neto_quincenal" name="sueldo_neto_quincenal"></v-currency>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Sueldo Bruto mensual (IMSS)</label>
                                            <v-currency class="form-control" v-model="empleado_model.sueldo_bruto_mensual" name="sueldo_bruto_mensual"></v-currency>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Sueldo diario (IMSS)</label>
                                            <v-currency class="form-control" v-model="empleado_model.sueldo_diario" name="sueldo_diario"></v-currency>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Sueldo diario integrado (IMSS)</label>
                                            <v-currency class="form-control" v-model="empleado_model.sueldo_diario_integrado" name="sueldo_diario_integrado"></v-currency>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Sueldo mensual en efectivo</label>
                                            <v-currency class="form-control" v-model="empleado_model.sueldo_efectivo_mensual" name="sueldo_efectivo_mensual"></v-currency>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Sueldo primera quincena del mes en efectivo</label>
                                            <v-currency class="form-control" v-model="empleado_model.sueldo_efectivo_quincena1" name="sueldo_efectivo_quincena1"></v-currency>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Sueldo segunda quincena del mes en efectivo</label>
                                            <v-currency class="form-control" v-model="empleado_model.sueldo_efectivo_quincena2" name="sueldo_efectivo_quincena2"></v-currency>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Gasto del 3% Nómina</label>
                                            <v-currency class="form-control" v-model="empleado_model.gasto_nomina" name="gasto_nomina"></v-currency>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Gasto de Aportación Patronal</label>
                                            <v-currency class="form-control" v-model="empleado_model.gasto_aportacion" name="gasto_aportacion"></v-currency>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Step 3-->
                                <!--begin::Step 4-->
                                <div class="mx-5" data-kt-stepper-element="content">
                                    <div class="row">
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Vehículo</label>
                                            <input type="text" class="form-control" v-model="empleado_model.vehiculo" name="vehiculo"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Gasolina</label>
                                            <input type="text" class="form-control" v-model="empleado_model.gasolina" name="gasolina"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Celular</label>
                                            <input type="text" class="form-control" v-model="empleado_model.celular" name="celular"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Alimentos</label>
                                            <input type="text" class="form-control" v-model="empleado_model.alimentos" name="alimentos"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Seguro Médico Menor</label>
                                            <input type="text" class="form-control" v-model="empleado_model.seguro_menor" name="seguro_menor"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Cursos Desarrollo Profesional</label>
                                            <input type="text" class="form-control" v-model="empleado_model.cursos_profesional" name="cursos_profesional"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Curso Desarrollo Personal</label>
                                            <input type="text" class="form-control" v-model="empleado_model.cursos_personal" name="cursos_personal"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Otros</label>
                                            <input type="text" class="form-control" v-model="empleado_model.otros" name="otros"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <span>
                                                <label class="required fw-semibold fs-6 ms-2">Gasto total de Nómina</label>
                                                <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Suma sueldo bruto más impuestos más aportaciones patronales más pago en efectivo más prestaciones"></i>
                                            </span>
                                            <input type="text" class="form-control" v-model="empleado_model.gasto_total_nomina" name="gasto_total_nomina"/>
                                        </div>

                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Banco</label>
                                            <input type="text" class="form-control" v-model="empleado_model.banco" name="banco"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Número de cuenta</label>
                                            <input type="text" class="form-control" v-model="empleado_model.num_cuenta" name="num_cuenta"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Número CLABE</label>
                                            <input type="text" class="form-control" v-model="empleado_model.num_clabe" name="num_clabe"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Número tarjeta</label>
                                            <input type="text" class="form-control" v-model="empleado_model.num_tarjeta" name="num_tarjeta"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Papelería recibida:</label>
                                            <input type="text" class="form-control" v-model="empleado_model.papeleria_recibida" name="papeleria_recibida"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Solicitud de empleo</label>
                                            <input type="text" class="form-control" v-model="empleado_model.solicitud_empleo" name="solicitud_empleo"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Currículum</label>
                                            <input type="text" class="form-control" v-model="empleado_model.curriculum" name="curriculum"/>
                                        </div>
                                        <div class="col-6 mb-7 fv-row">
                                            <label class="required fw-semibold fs-6 ms-2">Acta Nacimiento</label>
                                            <input type="text" class="form-control" v-model="empleado_model.acta_nacimiento" name="acta_nacimiento"/>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Step 4-->
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Actions-->
                    <div class="modal-footer flex-stack">
                        <div>
                            <button type="button" class="btn btn-secondary" data-kt-stepper-action="previous" v-show="stepper?.getCurrentStepIndex() > 1" :disabled="loading">Anterior</button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" data-kt-stepper-action="submit" @click="saveEmpleado" :disabled="loading" :data-kt-indicator="loading ? 'on' : 'off'" v-show="stepper?.getNextStepIndex() == stepper?.getCurrentStepIndex()">
                                <span class="indicator-label" v-text="Guardar"></span>
                                <span class="indicator-progress">Guardando <span class="spinner-border spinner-border-sm align-middle"></span></span>
                            </button>
                            <button type="button" class="btn btn-success" data-kt-stepper-action="next" v-show="stepper?.getNextStepIndex() != stepper?.getCurrentStepIndex()" :disabled="loading">Siguiente</button>
                        </div>
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
    <script src="/assets-1/js/vue2-filters.min.js"></script>

    <script>
        const app = new Vue({
            el: '#app',
            delimiters: ['[[', ']]'],
            data: () => ({
                empleados: [],
                columns: ['id', 'nombre', 'direccion', 'acciones'],
                options: {
                    headings: {
                        id: 'ID',
                        nombre: 'Empleado',
                        direccion: 'Dirección',
                        acciones: 'Acciones',
                    },
                    columnsClasses: {
                        id: 'align-middle px-2 ',
                        nombre: 'align-middle ',
                        direccion: 'align-middle ',
                        acciones: 'align-middle text-center px-2 ',
                    },
                    sortable: ['nombre', 'direccion'],
                    filterable: ['nombre', 'direccion'],
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

                stepper: null,

                validator1: null,
                validator2: null,
                validator3: null,
                validator4: null,
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
                vm.initformValidate();
                vm.initStepper();
                vm.initPickers();

                $("#kt_modal_add_empleado").on('hidden.bs.modal', event => {
                    vm.validator1.resetForm();
                    vm.validator2.resetForm();
                    vm.validator3.resetForm();
                    vm.validator4.resetForm();
                    vm.empleado_model = {};
                });
                $("#kt_modal_add_empleado").on('shown.bs.modal', () => {
                    vm.stepper.goFirst();
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
                    $("#fecha_imss").flatpickr({
                        dateFormat: "d/m/Y"
                    });
                    $("#horario_trabajo_inicio").flatpickr({
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                    });
                    $("#horario_trabajo_fin").flatpickr({
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                    });
                    $("#horario_comida_inicio").flatpickr({
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                    });
                    $("#horario_comida_fin").flatpickr({
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                    });
                },
                initStepper() {
                    let vm = this;

                    const element = document.querySelector('#kt_modal_add_empleado');
                    vm.stepper = new KTStepper(element);

                    vm.stepper.on("kt.stepper.next", function(stepper) {
                        switch (stepper.getCurrentStepIndex()) {
                            case 1:
                                if (vm.validator1) {
                                    vm.validator1.validate().then(function(status) {
                                        if (status === 'Valid') {
                                            vm.stepper.goNext();
                                        }
                                    });
                                }
                                break;
                            case 2:
                                if (vm.validator2) {
                                    vm.validator2.validate().then(function(status) {
                                        if (status === 'Valid') {
                                            vm.stepper.goNext();
                                        }
                                    });
                                }
                                break;
                            case 3:
                                if (vm.validator3) {
                                    vm.validator3.validate().then(function(status) {
                                        if (status === 'Valid') {
                                            vm.stepper.goNext();
                                        }
                                    });
                                }
                                break;
                            case 4:
                                if (vm.validator4) {
                                    vm.validator4.validate().then(function(status) {
                                        if (status === 'Valid') {
                                            vm.stepper.goNext();
                                        }
                                    });
                                }
                                break;
                            case 5:
                                if (vm.validator5) {
                                    vm.validator5.validate().then(function(status) {
                                        if (status === 'Valid') {
                                            vm.stepper.goNext();
                                        }
                                    });
                                }
                                break;
                            case 6:
                                if (vm.validator6) {
                                    vm.validator6.validate().then(function(status) {
                                        if (status === 'Valid') {
                                            vm.stepper.goNext();
                                        }
                                    });
                                }
                                break;
                            case 7:
                                if (vm.validator7) {
                                    vm.validator7.validate().then(function(status) {
                                        if (status === 'Valid') {
                                            vm.stepper.goNext();
                                        }
                                    });
                                }
                                break;
                            case 8:
                                if (vm.validator8) {
                                    vm.validator8.validate().then(function(status) {
                                        if (status === 'Valid') {
                                            vm.stepper.goNext();
                                        }
                                    });
                                }
                                break;
                        }
                    });

                    vm.stepper.on("kt.stepper.previous", function(stepper) {
                        vm.stepper.goPrevious(); // go previous step
                    });

                    vm.stepper.on("kt.stepper.click", function (stepper) {
                        if(stepper.getCurrentStepIndex() < stepper.getClickedStepIndex()){
                            switch (stepper.getCurrentStepIndex()) {
                                case 1:
                                    if (vm.validator1) {
                                        vm.validator1.validate().then(function(status) {
                                            if (status === 'Valid') {
                                                stepper.goTo(stepper.getClickedStepIndex());
                                            }
                                        });
                                    }
                                    break;
                                case 2:
                                    if (vm.validator2) {
                                        vm.validator2.validate().then(function(status) {
                                            if (status === 'Valid') {
                                                stepper.goTo(stepper.getClickedStepIndex());
                                            }
                                        });
                                    }
                                    break;
                                case 3:
                                    if (vm.validator3) {
                                        vm.validator3.validate().then(function(status) {
                                            if (status === 'Valid') {
                                                stepper.goTo(stepper.getClickedStepIndex());
                                            }
                                        });
                                    }
                                    break;
                                case 4:
                                    if (vm.validator4) {
                                        vm.validator4.validate().then(function(status) {
                                            if (status === 'Valid') {
                                                vm.stepper.goNext();
                                            }
                                        });
                                    }
                                    break;
                                case 5:
                                    if (vm.validator5) {
                                        vm.validator5.validate().then(function(status) {
                                            if (status === 'Valid') {
                                                vm.stepper.goNext();
                                            }
                                        });
                                    }
                                    break;
                                case 6:
                                    if (vm.validator6) {
                                        vm.validator6.validate().then(function(status) {
                                            if (status === 'Valid') {
                                                stepper.goTo(stepper.getClickedStepIndex());
                                            }
                                        });
                                    }
                                    break;
                                case 7:
                                    if (vm.validator7) {
                                        vm.validator7.validate().then(function(status) {
                                            if (status === 'Valid') {
                                                stepper.goTo(stepper.getClickedStepIndex());
                                            }
                                        });
                                    }
                                    break;
                                case 8:
                                    if (vm.validator8) {
                                        vm.validator8.validate().then(function(status) {
                                            if (status === 'Valid') {
                                                stepper.goTo(stepper.getClickedStepIndex());
                                            }
                                        });
                                    }
                                    break;
                            }
                            stepper.goTo(stepper.getClickedStepIndex());
                        } else {
                            stepper.goTo(stepper.getClickedStepIndex());
                        }
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

                    this.validator1 = FormValidation.formValidation(
                        document.getElementById('kt_modal_add_empleado_form'), {
                            fields: {
                                'nombre': genValidator,
                                'alias': genValidator,
                                'rfc': genValidator,
                                'curp': genValidator,
                                'ine': numValidator,
                                'nss': numValidator,
                                'direccion_ine': genValidator,
                                'direccion_fiscal': genValidator,
                                'direccion': genValidator,
                                'telefono_casa': numValidator,
                                'telefono_celular': numValidator,
                                'email_trabajo': emailValidator,
                                'email_personal': emailValidator,
                                'fecha_nacimiento': fechaValidator,
                                'fecha_ingreso': fechaValidator,
                                'fecha_imss': fechaValidator
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
                    this.validator2 = FormValidation.formValidation(
                        document.getElementById('kt_modal_add_empleado_form'), {
                            fields: {
                                'area': genValidator,
                                'puesto': genValidator,
                                'jefe': genValidator,
                                'sucursal': genValidator,
                                'dias_laborar': numValidator,
                                'horario_comida_inicio': genValidator,
                                'horario_comida_fin': genValidator,
                                'horario_trabajo_inicio': genValidator,
                                'horario_trabajo_fin': genValidator,
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
                    this.validator3 = FormValidation.formValidation(
                        document.getElementById('kt_modal_add_empleado_form'), {
                            fields: {
                                'suelto_neto_mensual': numValidator,
                                'sueldo_neto_quincenal': numValidator,
                                'sueldo_bruto_mensual': numValidator,
                                'sueldo_diario': numValidator,
                                'sueldo_diario_integrado': numValidator,
                                'sueldo_efectivo_mensual': numValidator,
                                'sueldo_efectivo_quincena1': numValidator,
                                'sueldo_efectivo_quincena2': numValidator,
                                'gasto_nomina': numValidator,
                                'gasto_aportacion': numValidator
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
                    this.validator4 = FormValidation.formValidation(
                        document.getElementById('kt_modal_add_empleado_form'), {
                            fields: {
                                'vehiculo': genValidator,
                                'gasolina': genValidator,
                                'celular': genValidator,
                                'alimentos': genValidator,
                                'seguro_menor': genValidator,
                                'cursos_profesional': genValidator,
                                'cursos_personal': genValidator,
                                'otros': genValidator,
                                'gasto_total_nomina': genValidator,
                                'banco': genValidator,
                                'num_cuenta': genValidator,
                                'num_clabe': genValidator,
                                'num_tarjeta': genValidator,
                                'papeleria_recibida': genValidator,
                                'solicitud_empleo': genValidator,
                                'curriculum': genValidator,
                                'acta_nacimiento': genValidator,
                                'rfc': genValidator,
                                'curp': genValidator,
                                'ine': genValidator,
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
                                    url: "/api/empleados/save",
                                    data: {
                                        nombre: vm.empleado_model.nombre,
                                        direccion: vm.empleado_model.direccion
                                    }
                                }).done(function (res) {
                                    if (res.status === true) {
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
                                if (res.status === true) {
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
