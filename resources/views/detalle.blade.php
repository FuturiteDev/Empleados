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
                        <h2 class="ps-2">[[empleado.nombre]]</h2>
                    </div>
                    <div class="card-toolbar">
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Navs-->
					<ul class="nav nav-tabs nav-pills" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">Información General</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="puesto-tab" data-bs-toggle="tab" data-bs-target="#puesto" type="button" role="tab" aria-controls="puesto" aria-selected="false">Puesto</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="sueldo-tab" data-bs-toggle="tab" data-bs-target="#sueldo" type="button" role="tab" aria-controls="sueldo" aria-selected="false">Sueldo</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="prestaciones-tab" data-bs-toggle="tab" data-bs-target="#prestaciones" type="button" role="tab" aria-controls="prestaciones" aria-selected="false">Prestaciones</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="entrevistas-tab" data-bs-toggle="tab" data-bs-target="#entrevistas" type="button" role="tab" aria-controls="entrevistas" aria-selected="false">Entrevistas</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="contratos-tab" data-bs-toggle="tab" data-bs-target="#contratos" type="button" role="tab" aria-controls="contratos" aria-selected="false">Contratos</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="vacaciones-tab" data-bs-toggle="tab" data-bs-target="#vacaciones" type="button" role="tab" aria-controls="vacaciones" aria-selected="false">Vacaciones</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="asistencias-tab" data-bs-toggle="tab" data-bs-target="#asistencias" type="button" role="tab" aria-controls="asistencias" aria-selected="false">Asistencias</button>
						</li>
					</ul>
                    <!--end::Navs-->
					<div class="tab-content" id="myTabContent">
                        <div class="tab-pane p-5 mt-5 fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success btn-sm" @click="isEdit = true" v-if="!isEdit">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="isEdit = false" v-else>Cancelar</button>
                            </div>
                            <div class="row" v-if="!isEdit">
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Nombre completo</div>
                                    <div v-text="empleado.nombre"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <span>
                                        <span class="fw-semibold fs-6 ms-2">Alias</span>
                                        <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Como le gusta que le digamos"></i>
                                    </span>
                                    <div v-text="empleado.alias"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">RFC</div>
                                    <div v-text="empleado.rfc"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">CURP</div>
                                    <div v-text="empleado.curp"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Número de INE</div>
                                    <div v-text="empleado.ine"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Número de Seguro Social</div>
                                    <div v-text="empleado.nss"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <span>
                                        <span class="fw-semibold fs-6 ms-2">Dirección domicilio</span>
                                        <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Como viene en la INE"></i>
                                    </span>
                                    <div v-text="empleado.direccion_ine"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Dirección fiscal</div>
                                    <div v-text="empleado.direccion_fiscal"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Dirección donde vive</div>
                                    <div v-text="empleado.direccion"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Teléfono casa</div>
                                    <div v-text="empleado.telefono_casa"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Teléfono celular</div>
                                    <div v-text="empleado.telefono_celular"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Email trabajo</div>
                                    <div v-text="empleado.email_trabajo"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Email personal</div>
                                    <div v-text="empleado.email_personal"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Fecha de nacimiento</div>
                                    <div v-text="empleado.fecha_nacimiento"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Fecha ingreso a la empresa</div>
                                    <div v-text="empleado.fecha_ingreso"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Fecha alta en el IMSS</div>
                                    <div v-text="empleado.fecha_imss"></div>
                                </div>
                            </div>
                            <div class="row" v-else>
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
                                <div class="text-center mt-10">
                                    <button type="button" class="btn btn-primary" @click="">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane p-5 mt-5 fade" id="puesto" role="tabpanel" aria-divledby="puesto-tab">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success btn-sm" @click="isEdit = true" v-if="!isEdit">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="isEdit = false" v-else>Cancelar</button>
                            </div>
                            <div class="row" v-if="!isEdit">
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Área de la empresa</div>
                                    <div v-text="empleado.area"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Nombre del Puesto</div>
                                    <div v-text="empleado.puesto"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Jefe directo</div>
                                    <div v-text="empleado.jefe"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <span>
                                        <span class="fw-semibold fs-6 ms-2">Sucursal principal</span>
                                        <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Sucursal donde desempeña sus labores"></i>
                                    </span>
                                    <div v-text="empleado.sucursal"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <span>
                                        <span class="fw-semibold fs-6 ms-2">Días de la semana a laborar</span>
                                        <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Lunes a Sábado, Lunes a Viernes, Sábado y Domingo, o poder elegir por día de lunes a domingo"></i>
                                    </span>
                                    <div v-text="empleado.dias_laborar"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Horario de trabajo</div>
                                    <div v-text="empleado.horario_trabajo"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Horario de comida</div>
                                    <div v-text="empleado.horario_comida"></div>
                                </div>
                            </div>
                            <div class="row" v-else>
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
                                <div class="text-center mt-10">
                                    <button type="button" class="btn btn-primary" @click="">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane p-5 mt-5 fade" id="sueldo" role="tabpanel" aria-divledby="sueldo-tab">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success btn-sm" @click="isEdit = true" v-if="!isEdit">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="isEdit = false" v-else>Cancelar</button>
                            </div>
                            <div class="row" v-if="!isEdit">
                                <div class="col-6 mb-7 fv-row">
                                    <span>
                                        <span class="fw-semibold fs-6 ms-2">Sueldo Neto Mensual</span>
                                        <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Incluye pago en transferencia más pago en efectivo"></i>
                                    </span>
                                    <div v-text="empleado.suelto_neto_mensual"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <span>
                                        <span class="fw-semibold fs-6 ms-2">Sueldo Neto Quincenal</span>
                                        <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Incluye pago en transferencia más pago en efectivo"></i>
                                    </span>
                                    <div v-text="empleado.sueldo_neto_quincenal"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Sueldo Bruto mensual (IMSS)</div>
                                    <div v-text="empleado.sueldo_bruto_mensual"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Sueldo diario (IMSS)</div>
                                    <div v-text="empleado.sueldo_diario"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Sueldo diario integrado (IMSS)</div>
                                    <div v-text="empleado.sueldo_diario_integrado"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Sueldo mensual en efectivo</div>
                                    <div v-text="empleado.sueldo_efectivo_mensual"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Sueldo primera quincena del mes en efectivo</div>
                                    <div v-text="empleado.sueldo_efectivo_quincena1"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Sueldo segunda quincena del mes en efectivo</div>
                                    <div v-text="empleado.sueldo_efectivo_quincena2"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Gasto del 3% Nómina</div>
                                    <div v-text="empleado.gasto_nomina"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Gasto de Aportación Patronal</div>
                                    <div v-text="empleado.gasto_aportacion"></div>
                                </div>
                            </div>
                            <div class="row" v-else>
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
                                <div class="text-center mt-10">
                                    <button type="button" class="btn btn-primary" @click="">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane p-5 mt-5 fade" id="prestaciones" role="tabpanel" aria-divledby="prestaciones-tab">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success btn-sm" @click="isEdit = true" v-if="!isEdit">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="isEdit = false" v-else>Cancelar</button>
                            </div>
                            <div class="row" v-if="!isEdit">
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Vehículo</div>
                                    <div v-text="empleado.vehiculo"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Gasolina</div>
                                    <div v-text="empleado.gasolina"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Celular</div>
                                    <div v-text="empleado.celular"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Alimentos</div>
                                    <div v-text="empleado.alimentos"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Seguro Médico Menor</div>
                                    <div v-text="empleado.seguro_menor"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Cursos Desarrollo Profesional</div>
                                    <div v-text="empleado.cursos_profesional"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Curso Desarrollo Personal</div>
                                    <div v-text="empleado.cursos_personal"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Otros</div>
                                    <div v-text="empleado.otros"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <span>
                                        <span class="fw-semibold fs-6 ms-2">Gasto total de Nómina</span>
                                        <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Suma sueldo bruto más impuestos más aportaciones patronales más pago en efectivo más prestaciones"></i>
                                    </span>
                                    <div v-text="empleado.gasto_nomina"></div>
                                </div>

                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Banco</div>
                                    <div v-text="empleado.banco"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Número de cuenta</div>
                                    <div v-text="empleado.num_cuenta"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Número CLABE</div>
                                    <div v-text="empleado.num_clabe"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Número tarjeta</div>
                                    <div v-text="empleado.num_tarjeta"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Papelería recibida:</div>
                                    <div v-text="empleado.papeleria_recibida"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Solicitud de empleo</div>
                                    <div v-text="empleado.solicitud_empleo"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Currículum</div>
                                    <div v-text="empleado.curriculum"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Acta Nacimiento</div>
                                    <div v-text="empleado.acta_nacimiento"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">RFC</div>
                                    <div v-text="empleado.rfc"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">CURP</div>
                                    <div v-text="empleado.curp"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">INE</div>
                                    <div v-text="empleado.ine"></div>
                                </div>
                            </div>
                            <div class="row" v-else>
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
                                <div class="text-center mt-10">
                                    <button type="button" class="btn btn-primary" @click="">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane p-5 mt-5 fade" id="entrevistas" role="tabpanel" aria-divledby="entrevistas-tab">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success btn-sm" @click="isEdit = true" v-if="!isEdit">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="isEdit = false" v-else>Cancelar</button>
                            </div>
                            <div class="row" v-if="!isEdit">
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Entrevista telefónica o de primer contacto</div>
                                    <div v-text="empleado.todo"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Entrevista Top Grading</div>
                                    <div v-text="empleado.todo"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Score Card llena</div>
                                    <div v-text="empleado.todo"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Autorización del jefe de área para firma del contrato de 1 mes</div>
                                    <div v-text="empleado.todo"></div>
                                </div>
                            </div>
                            <div class="row" v-else>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Entrevista telefónica o de primer contacto</div>
                                    <div v-text="empleado.todo"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Entrevista Top Grading</div>
                                    <div v-text="empleado.todo"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Score Card llena</div>
                                    <div v-text="empleado.todo"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Autorización del jefe de área para firma del contrato de 1 mes</div>
                                    <div v-text="empleado.todo"></div>
                                </div>
                                <div class="text-center mt-10">
                                    <button type="button" class="btn btn-primary" @click="">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane p-5 mt-5 fade" id="contratos" role="tabpanel" aria-divledby="contratos-tab">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success btn-sm" @click="isEdit = true" v-if="!isEdit">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="isEdit = false" v-else>Cancelar</button>
                            </div>
                            <div v-if="!isEdit">
                                <div class="fw-bold fs-6">1 mes</div>
                                <div class="row">
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Perfil del puesto entregado al empleado</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">5 actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Formato Junta Retroalimentación llenado por parte del jefe directo</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Autorización del jefe de área para firma del siguiente contrato</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                </div>
                                <div class="fw-bold fs-6">3 meses</div>
                                <div class="row">
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">15 actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Formatos Junta Retroalimentación llenado (uno por mes) por parte del jefe directo</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Autorización del jefe de área para firma del siguiente contrato</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                </div>
                                <div class="fw-bold fs-6">1 año</div>
                                <div class="row">
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">20 actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Formato Junta Retroalimentación llenado (1 por mes) por parte del jefe directo</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Autorización del jefe de área para firma del siguiente contrato</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Autorización del CEO para firma del siguiente contrato</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="fw-semibold col-form-label fs-6 ms-2">Contrato indefinido (sin fecha de terminación)</div>
                                    <div v-text="empleado.todo"></div>
                                </div>
                                <div class="row">
                                    <div class="fw-semibold col-form-label fs-6 ms-2">Actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo</div>
                                    <div v-text="empleado.todo"></div>
                                </div>
                                <div class="row">
                                    <div class="fw-semibold col-form-label fs-6 ms-2">Formato Junta Retroalimentación llenado (1 por mes) por parte del jefe directo</div>
                                    <div v-text="empleado.todo"></div>
                                </div>
                            </div>
                            <div v-else>
                                <div class="fw-bold fs-6">1 mes</div>
                                <div class="row">
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Perfil del puesto entregado al empleado</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">5 actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Formato Junta Retroalimentación llenado por parte del jefe directo</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Autorización del jefe de área para firma del siguiente contrato</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                </div>
                                <div class="fw-bold fs-6">3 meses</div>
                                <div class="row">
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">15 actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Formatos Junta Retroalimentación llenado (uno por mes) por parte del jefe directo</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Autorización del jefe de área para firma del siguiente contrato</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                </div>
                                <div class="fw-bold fs-6">1 año</div>
                                <div class="row">
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">20 actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Formato Junta Retroalimentación llenado (1 por mes) por parte del jefe directo</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Autorización del jefe de área para firma del siguiente contrato</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                    <div class="col-6 mb-7 fv-row">
                                        <div class="fw-semibold col-form-label fs-6 ms-2">Autorización del CEO para firma del siguiente contrato</div>
                                        <div v-text="empleado.todo"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="fw-semibold col-form-label fs-6 ms-2">Contrato indefinido (sin fecha de terminación)</div>
                                    <div v-text="empleado.todo"></div>
                                </div>
                                <div class="row">
                                    <div class="fw-semibold col-form-label fs-6 ms-2">Actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo</div>
                                    <div v-text="empleado.todo"></div>
                                </div>
                                <div class="row">
                                    <div class="fw-semibold col-form-label fs-6 ms-2">Formato Junta Retroalimentación llenado (1 por mes) por parte del jefe directo</div>
                                    <div v-text="empleado.todo"></div>
                                </div>
                                <div class="text-center mt-10">
                                    <button type="button" class="btn btn-primary" @click="">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane p-5 mt-5 fade" id="vacaciones" role="tabpanel" aria-divledby="vacaciones-tab">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success btn-sm" @click="isEdit = true" v-if="!isEdit">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="isEdit = false" v-else>Cancelar</button>
                            </div>
                            <div class="row" v-if="!isEdit">
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Días de vacaciones que le corresponden en el año</div>
                                    <div v-text="empleado.dias_vacaciones"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Fechas de vacaciones tomadas durante el año</div>
                                    <div v-text="empleado.fechas_vacaciones"></div>
                                </div>
                            </div>
                            <div class="row" v-else>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Días de vacaciones que le corresponden en el año</div>
                                    <div v-text="empleado.dias_vacaciones"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Fechas de vacaciones tomadas durante el año</div>
                                    <div v-text="empleado.fechas_vacaciones"></div>
                                </div>
                                <div class="text-center mt-10">
                                    <button type="button" class="btn btn-primary" @click="">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane p-5 mt-5 fade" id="asistencias" role="tabpanel" aria-divledby="asistencias-tab">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success btn-sm" @click="isEdit = true" v-if="!isEdit">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="isEdit = false" v-else>Cancelar</button>
                            </div>
                            <div class="row" v-if="!isEdit">
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Entradas y salidas diarias</div>
                                    <div v-text="empleado.entradas_salidas"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Llegadas tarde</div>
                                    <div v-text="empleado.llegadas_tarde"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Faltas justificadas</div>
                                    <div v-text="empleado.faltas_justificadas"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Faltas injustificadas</div>
                                    <div v-text="empleado.faltas_injustificadas"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Horas extras</div>
                                    <div v-text="empleado.horas_extra"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Días festivos trabajados</div>
                                    <div v-text="empleado.festivos"></div>
                                </div>
                            </div>
                            <div class="row" v-else>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Entradas y salidas diarias</div>
                                    <div v-text="empleado.entradas_salidas"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Llegadas tarde</div>
                                    <div v-text="empleado.llegadas_tarde"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Faltas justificadas</div>
                                    <div v-text="empleado.faltas_justificadas"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Faltas injustificadas</div>
                                    <div v-text="empleado.faltas_injustificadas"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Horas extras</div>
                                    <div v-text="empleado.horas_extra"></div>
                                </div>
                                <div class="col-6 mb-7 fv-row">
                                    <div class="fw-semibold fs-6 ms-2">Días festivos trabajados</div>
                                    <div v-text="empleado.festivos"></div>
                                </div>
                                <div class="text-center mt-10">
                                    <button type="button" class="btn btn-primary" @click="">Guardar</button>
                                </div>
                            </div>
                        </div>
					</div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content-->

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
                empleado: {},
                empleado_model: {},
                listaDias: [
                    {id:'lunes', text:'Lunes'},
                    {id:'martes', text:'Martes'},
                    {id:'miercoles', text:'Miercoles'},
                    {id:'jueves', text:'Jueves'},
                    {id:'viernes', text:'Viernes'},
                    {id:'sabado', text:'Sabado'},
                    {id:'domingo', text:'Domingo'},
                ],

                isEdit: false,
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

                const tabList = document.querySelectorAll('button[data-bs-toggle="tab"]')
                tabList.forEach(tabEl => {
                    tabEl.addEventListener('shown.bs.tab', event => {
                        //event.target // newly activated tab
                        //event.relatedTarget // previous active tab
                        vm.isEdit = false;
                    })
                })
            },
            methods: {
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
                                        empleado_id: vm.isEdit ? vm.empleado_model.id : null,
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
            },
        });

        Vue.use(VueTables.ClientTable);
    </script>
@endsection
