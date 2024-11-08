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
            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Expediente</h1>
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
                            <li class="breadcrumb-item text-muted">Empleados</li>
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
                        <h2 class="ps-2">[[empleado.nombre_completo]]</h2>
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
							<button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">Información</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="puesto-tab" data-bs-toggle="tab" data-bs-target="#puesto" type="button" role="tab" aria-controls="puesto" aria-selected="false">Puesto</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="nomina-tab" data-bs-toggle="tab" data-bs-target="#nomina" type="button" role="tab" aria-controls="nomina" aria-selected="false">Nomina</button>
						</li>
                        <li class="nav-item" role="presentation">
							<button class="nav-link" id="papeleria-tab" data-bs-toggle="tab" data-bs-target="#papeleria" type="button" role="tab" aria-controls="papeleria" aria-selected="false">Papelería</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="entrevistas-tab" data-bs-toggle="tab" data-bs-target="#entrevistas" type="button" role="tab" aria-controls="entrevistas" aria-selected="false">Entrevistas</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="contratos-tab" data-bs-toggle="tab" data-bs-target="#contratos" type="button" role="tab" aria-controls="contratos" aria-selected="false">Contratos</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="asistencias-tab" data-bs-toggle="tab" data-bs-target="#asistencias" type="button" role="tab" aria-controls="asistencias" aria-selected="false">Asistencias</button>
						</li>
					</ul>
                    <!--end::Navs-->
					<div class="tab-content" id="myTabContent">
                        <div class="tab-pane p-5 mt-5 fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success btn-sm" @click="isEditInfo = true" v-if="!isEditInfo">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="isEditInfo = false" v-else>Cancelar</button>
                            </div>
                            <div class="row" v-if="!isEditInfo">
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Número de empleado</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.no_empleado ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Fecha ingreso a la empresa</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.fecha_ingreso ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Fecha alta en el IMSS</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.fecha_alta_imss ?? ""]]</div>
                                </div>
                                <div class="separator mt-3 mb-5 border-gray-300"></div>
                                <h3 class="mb-5">Información General</h3>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Nombre completo</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.nombre_completo ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <span>
                                        <span class="form-label text-dark mb-0">Alias</span>
                                        <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Como le gusta que le digamos"></i>
                                    </span>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.alias ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">CURP</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.curp ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">INE</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.ine ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Seguro Social(NSS)</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.nss ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <span>
                                        <span class="form-label text-dark mb-0">Dirección domicilio</span>
                                        <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Como viene en la INE"></i>
                                    </span>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.domicilio_ine ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Dirección donde vive</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.domicilio_actual ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Teléfono casa</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.telefono ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Teléfono celular</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.celular ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Email trabajo</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.email_trabajo ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Email personal</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.email ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Fecha de nacimiento</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.fecha_nacimiento ?? ""]]</div>
                                </div>
                                <div class="separator mt-3 mb-5 border-gray-300"></div>
                                <h3 class="mb-5">Información Fiscal</h3>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">RFC</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.rfc ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Dirección fiscal</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.domicilio_fiscal ?? ""]]</div>
                                </div>
                                <div class="separator mt-3 mb-5 border-gray-300"></div>
                                <h3 class="mb-5">Banco</h3>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Número de cuenta</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.no_cuenta ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Número CLABE</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.no_clabe ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Número tarjeta</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.no_tarjeta ?? ""]]</div>
                                </div>
                            </div>
                            <form id="info_tab_form" novalidate="novalidate" class="form" action="#" @submit.prevent="" v-show="isEditInfo">
                                <div class="row">
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="required form-label text-dark mb-0 ms-2">Número de empleado</label>
                                        <input type="text" class="form-control" v-model="info_model.no_empleado" name="no_empleado"/>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Fecha ingreso a la empresa</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="info_model.fecha_ingreso" name="fecha_ingreso" id="fecha_ingreso"/>
                                            <span class="input-group-text">
                                                <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Fecha alta en el IMSS</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="info_model.fecha_alta_imss" name="fecha_alta_imss" id="fecha_alta_imss"/>
                                            <span class="input-group-text">
                                                <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="separator mt-3 mb-5 border-gray-300"></div>
                                    <h3 class="mb-5">Información General</h3>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="required form-label text-dark mb-0 ms-2">Nombre(s)</label>
                                        <input type="text" class="form-control" v-model="info_model.nombre" name="nombre"/>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="required form-label text-dark mb-0 ms-2">Apellido(s)</label>
                                        <input type="text" class="form-control" v-model="info_model.apellidos" name="apellidos"/>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <span>
                                            <label class="form-label text-dark mb-0 ms-2">Alias</label>
                                            <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Como le gusta que le digamos"></i>
                                        </span>
                                        <input type="text" class="form-control" v-model="info_model.alias" name="alias"/>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">CURP</label>
                                        <input type="text" class="form-control" v-model="info_model.curp" name="curp"/>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">INE</label>
                                        <input type="text" class="form-control" v-model="info_model.ine" name="ine"/>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Seguro Social(NSS)</label>
                                        <input type="text" class="form-control" v-model="info_model.nss" name="nss"/>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <span>
                                            <label class="form-label text-dark mb-0 ms-2">Dirección domicilio</label>
                                            <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Como viene en la INE"></i>
                                        </span>
                                        <textarea rows="5" class="form-control" v-model="info_model.domicilio_ine" name="domicilio_ine" style="resize:none;"></textarea>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Dirección donde vive</label>
                                        <textarea rows="5" class="form-control" v-model="info_model.domicilio_actual" name="domicilio_actual" style="resize:none;"></textarea>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Teléfono casa</label>
                                        <input type="tel" class="form-control" v-model="info_model.telefono" name="telefono"/>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Teléfono celular</label>
                                        <input type="tel" class="form-control" v-model="info_model.celular" name="celular"/>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Email trabajo</label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" v-model="info_model.email_trabajo" name="email_trabajo" id="email_trabajo"/>
                                            <span class="input-group-text">@</span>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Email personal</label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" v-model="info_model.email" name="email" id="email"/>
                                            <span class="input-group-text">@</span>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Fecha de nacimiento</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="info_model.fecha_nacimiento" name="fecha_nacimiento" id="fecha_nacimiento"/>
                                            <span class="input-group-text">
                                                <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="separator mt-3 mb-5 border-gray-300"></div>
                                    <h3 class="mb-5">Información Fiscal</h3>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">RFC</label>
                                        <input type="text" class="form-control" v-model="info_model.rfc" name="rfc"/>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Dirección fiscal</label>
                                        <input type="text" class="form-control" v-model="info_model.domicilio_fiscal" name="domicilio_fiscal"/>
                                    </div>
                                    <div class="separator mt-3 mb-5 border-gray-300"></div>
                                    <h3 class="mb-5">Banco</h3>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Número de cuenta</label>
                                        <input type="text" class="form-control" v-model="info_model.no_cuenta" name="no_cuenta"/>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Número CLABE</label>
                                        <input type="text" class="form-control" v-model="info_model.no_clabe" name="no_clabe"/>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Número tarjeta</label>
                                        <input type="text" class="form-control" v-model="info_model.no_tarjeta" name="no_tarjeta"/>
                                    </div>
                                    <div class="text-center mt-10">
                                        <button type="button" class="btn btn-primary" @click="saveEmpleadoInfo">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane p-5 mt-5 fade" id="puesto" role="tabpanel" aria-divledby="puesto-tab">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success btn-sm" @click="isEditPuesto = true" v-if="!isEditPuesto">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="isEditPuesto = false" v-else>Cancelar</button>
                            </div>
                            <div class="row" v-if="!isEditPuesto">
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Área de la empresa</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_puesto?.area?.nombre ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Nombre del Puesto</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_puesto?.puesto?.nombre ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Jefe directo</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_puesto?.jefe?.nombre_completo ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <span>
                                        <span class="form-label text-dark mb-0">Sucursal principal</span>
                                        <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Sucursal donde desempeña sus labores"></i>
                                    </span>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_puesto?.sucursal?.nombre ?? ""]]</div>
                                </div>
                                <div class="col-12 mb-5" v-if="empleado.info_puesto?.horario">
                                    <div class="form-label text-dark mb-0">Horarios</div>
                                    <table class="table table-sm table-rounded table-striped border align-middle table-row-bordered fs-6" id="horariosAtención">
                                        <thead>
                                            <tr>
                                                <th class="p-2">Día</th>
                                                <th class="p-2">Horario</th>
                                                <th class="p-2">Hora de comida</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(ha, index) in empleado.info_puesto?.horario" :key="index">
                                                <td class="fw-bold px-2">[[ ha.dia  ?? ""]]</td>
                                                <td class="p-2">
                                                    <div class="d-flex flex-wrap gap-1">
                                                        <span class="badge badge-secondary" v-if="!ha.inicio">Sin horarios</span>
                                                        <span class="badge badge-primary" v-else>[[ha.inicio]] - [[ ha.fin]] <br></span>
                                                    </div>
                                                </td>
                                                <td class="p-2">
                                                    <div class="d-flex flex-wrap gap-1">
                                                        <span v-if="!ha.comida_inicio" class="badge badge-secondary">Sin horarios</span>
                                                        <span class="badge badge-primary" v-else>[[ ha.comida_inicio]] - [[ ha.comida_fin]] <br></span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <form id="puesto_tab_form" novalidate="novalidate" class="form" action="#" @submit.prevent="" v-show="isEditPuesto">
                                <div class="row">
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Área de la empresa</label>
                                        <input type="text" class="form-control" name="area" id="tag_area"/>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Nombre del Puesto</label>
                                        <input type="text" class="form-control" name="puesto" id="tag_puesto"/>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Jefe directo</label>
                                        <v-select 
                                            v-model="puesto_model.jefe_id"
                                            name="jefe"
                                            :options="listaEmpleados"
                                            data-allow-clear="true"
                                            data-placeholder="Selecciona un empleado">
                                        </v-select>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <span>
                                            <label class="form-label text-dark mb-0 ms-2">Sucursal principal</label>
                                            <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Sucursal donde desempeña sus labores"></i>
                                        </span>
                                        <v-select 
                                            v-model="puesto_model.sucursal_id"
                                            name="sucursal"
                                            :options="listaSucursales"
                                            data-allow-clear="true"
                                            data-placeholder="Selecciona una sucursal">
                                        </v-select>
                                    </div>
                                    <div class="col-12 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Horarios</label>
                                        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x nav-fill mb-5">
                                            <li class="nav-item mt-2" v-for="(dia, index) in dias" :key="dia">
                                                <a class="nav-link text-active-info border-active-info border-hover-info ms-0 me-10 fw-normal" :class="index == 0 ? 'active' : ''" data-bs-toggle="tab" :href="'#kt_tab_pane_' + index">[[dia ?? ""]]</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content" id="horariosTab">
                                            <div class="tab-pane fade" v-for="(dia, index) in dias" :key="dia" :class="index == 0 ? 'show active' : ''" :id="'kt_tab_pane_' + index" role="tabpanel">
                                                <p class="form-label text-dark mb-3 fw-semibold text-gray-800">Agrega los horarios para el día: <span class="fw-bold">[[dia ?? ""]]</span></p>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="card card-bordered p-4">
                                                            <div class="row">
                                                                <div class="col-6 mb-5 fv-row">
                                                                    <label class="form-label text-dark mb-0 ms-2">Hora de Inicio</label>
                                                                    <input type="time" class="form-control form-control-solid" v-model="puesto_model.horario[index].inicio" :name="`inicio-${dia}`">
                                                                </div>
                                                                <div class="col-6 mb-5 fv-row">
                                                                    <label class="form-label text-dark mb-0 ms-2">Hora de Fin</label>
                                                                    <input type="time" class="form-control form-control-solid" v-model="puesto_model.horario[index].fin" :name="`fin-${dia}`">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="card card-bordered p-4">
                                                            <div class="row">
                                                                <div class="col-6 mb-5 fv-row">
                                                                    <label class="form-label text-dark mb-0 ms-2">Hora de Comida Inicio</label>
                                                                    <input type="time" class="form-control form-control-solid" v-model="puesto_model.horario[index].comida_inicio" :name="`comida_inicio-${dia}`">
                                                                </div>
                                                                <div class="col-6 mb-5 fv-row">
                                                                    <label class="form-label text-dark mb-0 ms-2">Hora de Comida Fin</label>
                                                                    <input type="time" class="form-control form-control-solid" v-model="puesto_model.horario[index].comida_fin" :name="`comida_fin-${dia}`">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="text-center mt-10">
                                        <button type="button" class="btn btn-primary" @click="saveEmpleadoPuesto">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane p-5 mt-5 fade" id="nomina" role="tabpanel" aria-divledby="nomina-tab">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success btn-sm" @click="isEditNomina = true" v-if="!isEditNomina">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="isEditNomina = false" v-else>Cancelar</button>
                            </div>
                            <div class="row" v-if="!isEditNomina">
                                <h3 class="mb-5">Sueldo</h3>
                                <div class="col-6 mb-5">
                                    <span>
                                        <span class="form-label text-dark mb-0">Sueldo Neto Mensual</span>
                                        <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Incluye pago en transferencia más pago en efectivo"></i>
                                    </span>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.sueldo_mensual_neto | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Sueldo Bruto mensual (IMSS)</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.sueldo_mensual_bruto | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Sueldo mensual en efectivo</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.sueldo_mensual_efectivo | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <span>
                                        <span class="form-label text-dark mb-0">Sueldo Neto Quincenal</span>
                                        <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Incluye pago en transferencia más pago en efectivo"></i>
                                    </span>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.sueldo_quincenal_neto | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Sueldo primera quincena del mes en efectivo</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.sueldo_quincena1_efectivo | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Sueldo segunda quincena del mes en efectivo</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.sueldo_quincena2_efectivo | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Sueldo diario (IMSS)</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.sueldo_diario | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Sueldo diario integrado (IMSS)</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.sueldo_diario_integrado | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Gasto del 3% Nómina</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.gasto_nomina | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Gasto de Aportación Patronal</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.gasto_patronal | currency]]</div>
                                </div>
                                <div class="separator mt-3 mb-5 border-gray-300"></div>
                                <h3 class="mb-5">Prestaciones</h3>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Vehículo</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.pres_vehiculo | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Gasolina</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.pres_gasolina | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Celular</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.pres_celular | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Alimentos</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.pres_alimentos | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Seguro Médico Menor</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.pres_seguro_medico_menor | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Cursos Desarrollo Profesional</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.pres_cursos_profesional | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Curso Desarrollo Personal</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.pres_cursos_personal | currency]]</div>
                                </div>
                                <div class="col-6 mb-5">
                                    <div class="form-label text-dark mb-0">Otros</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.info_nomina?.pres_otros | currency]]</div>
                                </div>
                                <div class="separator mt-3 mb-5 border-gray-300"></div>
                                <div class="col-12 mb-5 fv-row text-center">
                                    <span>
                                        <span class="fw-bold fs-4 ms-2">Gasto total de Nómina</span>
                                        <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Suma sueldo bruto + impuestos + aportaciones patronales + pago en efectivo + prestaciones"></i>
                                    </span>
                                    <div class="fs-5 px-4">[[gastoTotalNomina | currency]]</div>
                                </div>
                            </div>
                            <form id="nomina_tab_form" novalidate="novalidate" class="form" action="#" @submit.prevent="" v-show="isEditNomina">
                                <div class="row">
                                    <div class="col-6 mb-5 fv-row">
                                        <span>
                                            <label class="form-label text-dark mb-0 ms-2">Sueldo Neto Mensual</label>
                                            <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Incluye pago en transferencia más pago en efectivo"></i>
                                        </span>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.sueldo_mensual_neto" name="suelto_neto_mensual"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Sueldo Bruto mensual (IMSS)</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.sueldo_mensual_bruto" name="sueldo_bruto_mensual"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Sueldo mensual en efectivo</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.sueldo_mensual_efectivo" name="sueldo_efectivo_mensual"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <span>
                                            <label class="form-label text-dark mb-0 ms-2">Sueldo Neto Quincenal</label>
                                            <i class="ki-solid ki-information-5 text-gray-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Incluye pago en transferencia más pago en efectivo"></i>
                                        </span>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.sueldo_quincenal_neto" name="sueldo_neto_quincenal"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Sueldo primera quincena del mes en efectivo</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.sueldo_quincena1_efectivo" name="sueldo_efectivo_quincena1"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Sueldo segunda quincena del mes en efectivo</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.sueldo_quincena2_efectivo" name="sueldo_efectivo_quincena2"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Sueldo diario (IMSS)</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.sueldo_diario" name="sueldo_diario"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Sueldo diario integrado (IMSS)</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.sueldo_diario_integrado" name="sueldo_diario_integrado"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Gasto del 3% Nómina</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.gasto_nomina" name="gasto_nomina"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Gasto de Aportación Patronal</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.gasto_patronal" name="gasto_aportacion"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Vehículo</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.pres_vehiculo" name="vehiculo"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Gasolina</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.pres_gasolina" name="gasolina"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Celular</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.pres_celular" name="celular"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Alimentos</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.pres_alimentos" name="alimentos"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Seguro Médico Menor</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.pres_seguro_medico_menor" name="seguro_menor"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Cursos Desarrollo Profesional</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.pres_cursos_profesional" name="cursos_profesional"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Curso Desarrollo Personal</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.pres_cursos_personal" name="cursos_personal"></v-currency>
                                    </div>
                                    <div class="col-6 mb-5 fv-row">
                                        <label class="form-label text-dark mb-0 ms-2">Otros</label>
                                        <v-currency class="form-control" placeholder="$" v-model="nomina_model.pres_otros" name="otros"></v-currency>
                                    </div>
                                    <div class="text-center mt-10">
                                        <button type="button" class="btn btn-primary" @click="saveEmpleadoNomina">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane p-5 mt-5 fade" id="papeleria" role="tabpanel" aria-divledby="papeleria-tab">
                            <div class="row">
                                <div class="col-6 mb-5" v-for="(doc, index) in papeleria_docs">
                                    <form :id="`archivos_${doc.slug}_form`" novalidate="novalidate" class="form" action="#" @submit.prevent="">
                                        <div class="form-label text-dark mb-0">[[doc.title]]</div>
                                        <div class="text-end mb-5" v-if="edit[doc.slug]">
                                            <button type="button" class="btn btn-primary btn-sm me-2" @click="saveFile(doc)">Guardar</button>
                                            <button type="button" class="btn btn-secondary btn-sm" @click="edit[doc.slug] = false">Cancelar</button>
                                        </div>
                                        <div class="text-end mb-5" v-else>
                                            <button class="btn btn-success btn-sm me-2" title="Adjuntar/Remplazar Archivo" @click="edit[doc.slug] = true">
                                                <i class="fa-solid fa-paperclip"></i>Adjuntar archivo
                                            </button>
                                            <button class="btn btn-danger btn-sm btn-icon" title="Eliminar Archivo" :disabled="loading" @click="deleteFile(doc)" v-if="doc.id">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <input type="file" class="form-control" name="archivo" v-if="edit[doc.slug]"/>
                                            <v-file :file="doc.archivo" class="border-1" v-else-if="doc.id"></v-file>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane p-5 mt-5 fade" id="entrevistas" role="tabpanel" aria-divledby="entrevistas-tab">
                            <div class="row">
                                <div class="col-6 mb-5" v-for="(doc, index) in entrevistas_docs">
                                    <form :id="`archivos_${doc.slug}_form`" novalidate="novalidate" class="form" action="#" @submit.prevent="">
                                        <div class="form-label text-dark mb-0">[[doc.title]]</div>
                                        <div class="text-end mb-5" v-if="edit[doc.slug]">
                                            <button type="button" class="btn btn-primary btn-sm me-2" @click="saveFile(doc)">Guardar</button>
                                            <button type="button" class="btn btn-secondary btn-sm" @click="edit[doc.slug] = false">Cancelar</button>
                                        </div>
                                        <div class="text-end mb-5" v-else>
                                            <button class="btn btn-success btn-sm me-2" title="Adjuntar/Remplazar Archivo" @click="edit[doc.slug] = true">
                                                <i class="fa-solid fa-paperclip"></i>Adjuntar archivo
                                            </button>
                                            <button class="btn btn-danger btn-sm btn-icon" title="Eliminar Archivo" :disabled="loading" @click="deleteFile(doc)" v-if="doc.id">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <input type="file" class="form-control" name="archivo" v-if="edit[doc.slug]"/>
                                            <v-file :file="doc.archivo" class="border-1" v-else-if="doc.id"></v-file>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane p-5 mt-5 fade" id="contratos" role="tabpanel" aria-divledby="contratos-tab">
                            <div class="row">
                                <h3 class="mb-5">1 Mes</h3>
                                <div class="col-6 mb-5" v-for="(doc, index) in contratos_docs_mes1">
                                    <form :id="`archivos_${doc.slug}_form`" novalidate="novalidate" class="form" action="#" @submit.prevent="">
                                        <div class="form-label text-dark mb-0">[[doc.title]]</div>
                                        <div class="text-end mb-5" v-if="edit[doc.slug]">
                                            <button type="button" class="btn btn-primary btn-sm me-2" @click="saveFile(doc)">Guardar</button>
                                            <button type="button" class="btn btn-secondary btn-sm" @click="edit[doc.slug] = false">Cancelar</button>
                                        </div>
                                        <div class="text-end mb-5" v-else>
                                            <button class="btn btn-success btn-sm me-2" title="Adjuntar/Remplazar Archivo" @click="edit[doc.slug] = true">
                                                <i class="fa-solid fa-paperclip"></i>Adjuntar archivo
                                            </button>
                                            <button class="btn btn-danger btn-sm btn-icon" title="Eliminar Archivo" :disabled="loading" @click="deleteFile(doc)" v-if="doc.id">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <input type="file" class="form-control" name="archivo" v-if="edit[doc.slug]"/>
                                            <v-file :file="doc.archivo" class="border-1" v-else-if="doc.id"></v-file>
                                        </div>
                                    </form>
                                </div>
                                <div class="separator mt-3 mb-5 border-gray-300"></div>
                                <h3 class="mb-5">3 Meses</h3>
                                <div class="col-6 mb-5" v-for="(doc, index) in contratos_docs_mes3">
                                    <form :id="`archivos_${doc.slug}_form`" novalidate="novalidate" class="form" action="#" @submit.prevent="">
                                        <div class="form-label text-dark mb-0">[[doc.title]]</div>
                                        <div class="text-end mb-5" v-if="edit[doc.slug]">
                                            <button type="button" class="btn btn-primary btn-sm me-2" @click="saveFile(doc)">Guardar</button>
                                            <button type="button" class="btn btn-secondary btn-sm" @click="edit[doc.slug] = false">Cancelar</button>
                                        </div>
                                        <div class="text-end mb-5" v-else>
                                            <button class="btn btn-success btn-sm me-2" title="Adjuntar/Remplazar Archivo" @click="edit[doc.slug] = true">
                                                <i class="fa-solid fa-paperclip"></i>Adjuntar archivo
                                            </button>
                                            <button class="btn btn-danger btn-sm btn-icon" title="Eliminar Archivo" :disabled="loading" @click="deleteFile(doc)" v-if="doc.id">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <input type="file" class="form-control" name="archivo" v-if="edit[doc.slug]"/>
                                            <v-file :file="doc.archivo" class="border-1" v-else-if="doc.id"></v-file>
                                        </div>
                                    </form>
                                </div>
                                <div class="separator mt-3 mb-5 border-gray-300"></div>
                                <h3 class="mb-5">1 Año</h3>
                                <div class="col-6 mb-5" v-for="(doc, index) in contratos_docs_ano1">
                                    <form :id="`archivos_${doc.slug}_form`" novalidate="novalidate" class="form" action="#" @submit.prevent="">
                                        <div class="form-label text-dark mb-0">[[doc.title]]</div>
                                        <div class="text-end mb-5" v-if="edit[doc.slug]">
                                            <button type="button" class="btn btn-primary btn-sm me-2" @click="saveFile(doc)">Guardar</button>
                                            <button type="button" class="btn btn-secondary btn-sm" @click="edit[doc.slug] = false">Cancelar</button>
                                        </div>
                                        <div class="text-end mb-5" v-else>
                                            <button class="btn btn-success btn-sm me-2" title="Adjuntar/Remplazar Archivo" @click="edit[doc.slug] = true">
                                                <i class="fa-solid fa-paperclip"></i>Adjuntar archivo
                                            </button>
                                            <button class="btn btn-danger btn-sm btn-icon" title="Eliminar Archivo" :disabled="loading" @click="deleteFile(doc)" v-if="doc.id">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <input type="file" class="form-control" name="archivo" v-if="edit[doc.slug]"/>
                                            <v-file :file="doc.archivo" class="border-1" v-else-if="doc.id"></v-file>
                                        </div>
                                    </form>
                                </div>
                                <div class="separator mt-3 mb-5 border-gray-300"></div>
                                <div class="col-6 mb-5" v-for="(doc, index) in contratos_docs_ano1">
                                    <form :id="`archivos_${doc.slug}_form`" novalidate="novalidate" class="form" action="#" @submit.prevent="">
                                        <div class="form-label text-dark mb-0">[[doc.title]]</div>
                                        <div class="text-end mb-5" v-if="edit[doc.slug]">
                                            <button type="button" class="btn btn-primary btn-sm me-2" @click="saveFile(doc)">Guardar</button>
                                            <button type="button" class="btn btn-secondary btn-sm" @click="edit[doc.slug] = false">Cancelar</button>
                                        </div>
                                        <div class="text-end mb-5" v-else>
                                            <button class="btn btn-success btn-sm me-2" title="Adjuntar/Remplazar Archivo" @click="edit[doc.slug] = true">
                                                <i class="fa-solid fa-paperclip"></i>Adjuntar archivo
                                            </button>
                                            <button class="btn btn-danger btn-sm btn-icon" title="Eliminar Archivo" :disabled="loading" @click="deleteFile(doc)" v-if="doc.id">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <input type="file" class="form-control" name="archivo" v-if="edit[doc.slug]"/>
                                            <v-file :file="doc.archivo" class="border-1" v-else-if="doc.id"></v-file>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane p-5 mt-5 fade" id="asistencias" role="tabpanel" aria-divledby="asistencias-tab">
                            <div class="row">
                                <div class="col-6 mb-5 fv-row">
                                    <div class="form-label text-dark mb-0">Entradas y salidas diarias</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.asistencias?.entradas_salidas ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5 fv-row">
                                    <div class="form-label text-dark mb-0">Llegadas tarde</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.asistencias?.llegadas_tarde ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5 fv-row">
                                    <div class="form-label text-dark mb-0">Faltas justificadas</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.asistencias?.faltas_justificadas ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5 fv-row">
                                    <div class="form-label text-dark mb-0">Faltas injustificadas</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.asistencias?.faltas_injustificadas ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5 fv-row">
                                    <div class="form-label text-dark mb-0">Horas extras</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.asistencias?.horas_extra ?? ""]]</div>
                                </div>
                                <div class="col-6 mb-5 fv-row">
                                    <div class="form-label text-dark mb-0">Días festivos trabajados</div>
                                    <div class="py-2 px-4 border border-0 bg-light rounded">[[empleado.asistencias?.festivos ?? ""]]</div>
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
    <script src="/common_assets/js/vue_components/v-file.js"></script>
    <script src="/assets-1/js/vue2-filters.min.js"></script>

    <script>
        const app = new Vue({
            el: '#app',
            delimiters: ['[[', ']]'],
            data: () => ({
                empleado: {!! $empleado !!},
                sucursales: [],
                empleados: [],
                areas: [],
                puestos: [],
                dias: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                tag_area: null,
                tag_puesto: null,

                info_model: {
                    no_empleado: null,
                    fecha_ingreso: null,
                    fecha_alta_imss: null,
                    nombre: null,
                    apellidos: null,
                    alias: null,
                    curp: null,
                    ine: null,
                    nss: null,
                    domicilio_ine: null,
                    domicilio_actual: null,
                    telefono: null,
                    celular: null,
                    email_trabajo: null,
                    email: null,
                    fecha_nacimiento: null,
                    rfc: null,
                    domicilio_fiscal: null,
                    no_cuenta: null,
                    no_clabe: null,
                    no_tarjeta: null,
                },
                puesto_model:{
                    horario: [
                        {dia: 'Lunes'},
                        {dia: 'Martes'},
                        {dia: 'Miércoles'},
                        {dia: 'Jueves'},
                        {dia: 'Viernes'},
                        {dia: 'Sábado'},
                        {dia: 'Domingo'},
                    ]
                },
                nomina_model: {},
                papeleria_docs: [
                    {
                        title: 'Solicitud de empleo',
                        categoria: 'papeleria',
                        slug: 'solicitud_empleo',
                    },
                    {
                        title: 'Currículum',
                        categoria: 'papeleria',
                        slug: 'curriculum',
                    },
                    {
                        title: 'RFC',
                        categoria: 'papeleria',
                        slug: 'archivo_rfc',
                    },
                    {
                        title: 'CURP',
                        categoria: 'papeleria',
                        slug: 'archivo_curp',
                    },
                    {
                        title: 'INE',
                        categoria: 'papeleria',
                        slug: 'archivo_ine',
                    },
                ],
                entrevistas_docs: [
                    {
                        title: 'Entrevista telefónica o de primer contacto',
                        categoria: 'entrevistas',
                        slug: 'entrevista_primer_contacto',
                    },
                    {
                        title: 'Entrevista Top Grading',
                        categoria: 'entrevistas',
                        slug: 'entrevista_top_grading',
                    },
                    {
                        title: 'Score Card llena',
                        categoria: 'entrevistas',
                        slug: 'entrevista_score_card',
                    },
                    {
                        title: 'Autorización del jefe de área para firma del contrato de 1 mes',
                        categoria: 'entrevistas',
                        slug: 'autorizacion_contracto_mes1',
                    },
                ],
                contratos_docs_mes1: [
                    {
                        categoria: 'contratos',
                        title: 'Perfil del puesto entregado al empleado',
                        slug: 'contrato_perfil_puesto'
                    },
                    {
                        categoria: 'contratos',
                        title: '5 actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo',
                        slug: 'contrato_actividades_mes1'
                    },
                    {
                        categoria: 'contratos',
                        title: 'Formato Junta Retroalimentación llenado por parte del jefe directo',
                        slug: 'contrato_retroalimentacion_mes1'
                    },
                    {
                        categoria: 'contratos',
                        title: 'Autorización del jefe de área para firma del siguiente contrato',
                        slug: 'contrato_autorizacion_contrato_mes1'
                    }
                ],
                contratos_docs_mes3: [
                    {
                        categoria: 'contratos',
                        title: '15 actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo',
                        slug: 'contrato_actividades_mes3'
                    },
                    {
                        categoria: 'contratos',
                        title: 'Formatos Junta Retroalimentación llenado (uno por mes) por parte del jefe directo',
                        slug: 'contrato_retroalimentacion_mes3'
                    },
                    {
                        categoria: 'contratos',
                        title: 'Autorización del jefe de área para firma del siguiente contrato',
                        slug: 'contrato_autorizacion_contrato_mes3'
                    }
                ],
                contratos_docs_ano1: [
                    {
                        categoria: 'contratos',
                        title: '20 actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo',
                        slug: 'contrato_actividades_ano1'
                    },
                    {
                        categoria: 'contratos',
                        title: 'Formato Junta Retroalimentación llenado (1 por mes) por parte del jefe directo',
                        slug: 'contrato_retroalimentacion_ano1'
                    },
                    {
                        categoria: 'contratos',
                        title: 'Autorización del jefe de área para firma del siguiente contrato',
                        slug: 'contrato_autorizacion_contrato_ano1'
                    },
                    {
                        categoria: 'contratos',
                        title: 'Autorización del CEO para firma del siguiente contrato',
                        slug: 'contrato_autorizacion_ceo_contrato'
                    }
                ],
                contratos_docs: [
                    {
                        categoria: 'contratos',
                        title: 'Contrato indefinido (sin fecha de terminación)',
                        slug: 'contrato_indefinido'
                    },
                    {
                        categoria: 'contratos',
                        title: 'Actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo',
                        slug: 'contrato_actividades_indefinido'
                    },
                    {
                        categoria: 'contratos',
                        title: 'Formato Junta Retroalimentación llenado (1 por mes) por parte del jefe directo',
                        slug: 'contrato_retroalimentacion_indefinido'
                    }
                ],

                edit: {
                    solicitud_empleo: false,
                    curriculum: false,
                    archivo_rfc: false,
                    archivo_curp: false,
                    archivo_ine: false,
                    entrevista_primer_contacto: false,
                    entrevista_top_grading: false,
                    entrevista_score_card: false,
                    autorizacion_contracto_mes1: false,
                    contrato_perfil_puesto: false,
                    contrato_actividades_mes1: false,
                    contrato_retroalimentacion_mes1: false,
                    contrato_autorizacion_contrato_mes1: false,
                    contrato_actividades_mes3: false,
                    contrato_retroalimentacion_mes3: false,
                    contrato_autorizacion_contrato_mes3: false,
                    contrato_actividades_ano1: false,
                    contrato_retroalimentacion_ano1: false,
                    contrato_autorizacion_contrato_ano1: false,
                    contrato_autorizacion_ceo_contrato: false,
                    contrato_indefinido: false,
                    contrato_actividades_indefinido: false,
                    contrato_retroalimentacion_indefinido: false,
                },
                isEditInfo: false,
                isEditPuesto: false,
                isEditNomina: false,
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
                        vm.isEditInfo = false;
                        vm.isEditPuesto = false;
                        vm.isEditNomina = false;
                        vm.edit = {
                            solicitud_empleo: false,
                            curriculum: false,
                            archivo_rfc: false,
                            archivo_curp: false,
                            archivo_ine: false,
                            entrevista_primer_contacto: false,
                            entrevista_top_grading: false,
                            entrevista_score_card: false,
                            autorizacion_contracto_mes1: false,
                            contrato_perfil_puesto: false,
                            contrato_actividades_mes1: false,
                            contrato_retroalimentacion_mes1: false,
                            contrato_autorizacion_contrato_mes1: false,
                            contrato_actividades_mes3: false,
                            contrato_retroalimentacion_mes3: false,
                            contrato_autorizacion_contrato_mes3: false,
                            contrato_actividades_ano1: false,
                            contrato_retroalimentacion_ano1: false,
                            contrato_autorizacion_contrato_ano1: false,
                            contrato_autorizacion_ceo_contrato: false,
                            contrato_indefinido: false,
                            contrato_actividades_indefinido: false,
                            contrato_retroalimentacion_indefinido: false,
                        };
                    })
                });

                vm.tag_puesto = new Tagify(document.querySelector("#tag_puesto"), {
                    enforceWhitelist: false,
                    whitelist: [],
                    dropdown: {
                        enabled: 1,
                    },
                    callbacks: {
                        add: e => {},
                        remove: e => {},
                        change: e => {
                            let tags = JSON.parse(e.detail.value)[0];
                            if(tags.value == '') {
                                vm.puesto_model.puesto_id = null;
                                vm.puesto_model.puesto = null;
                            } else {
                                if(tags.id && tags.id!=''){
                                    vm.puesto_model.puesto_id = tags.id;
                                    vm.puesto_model.puesto = null;
                                } else {
                                    vm.puesto_model.puesto_id = null;
                                    vm.puesto_model.puesto = tags.value;
                                }
                            }
                        },
                    }
                });

                vm.tag_area = new Tagify(document.querySelector("#tag_area"), {
                    enforceWhitelist: false,
                    whitelist: [],
                    dropdown: {
                        enabled: 1,
                    },
                    callbacks: {
                        add: e => {},
                        remove: e => {},
                        change: e => {
                            let tags = JSON.parse(e.detail.value)[0];
                            if(tags.value == '') {
                                vm.puesto_model.area_id = null;
                                vm.puesto_model.area = null;
                            } else {
                                if(tags.id && tags.id!=''){
                                    vm.puesto_model.area_id = tags.id;
                                    vm.puesto_model.area = null;
                                } else {
                                    vm.puesto_model.area_id = null;
                                    vm.puesto_model.area = tags.value;
                                }
                            }
                        },
                    }
                });

                vm.getSucursales();
                vm.getEmpleados();
                vm.getPuestos();
                vm.getAreas();
                vm.formatFilesList();
            },
            methods: {
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
                        document.getElementById('info_tab_form'), {
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
                getEmpleados() {
                    let vm = this;
                    $.get(
                        '/api/empleados/all',
                        res => {
                            vm.empleados = res.results;
                            vm.$nextTick(() => {
                                vm.puesto_model.jefe_id = this.empleado.info_puesto?.jefe_id;
                            });
                        }, 'json'
                    );
                },
                getSucursales() {
                    let vm = this;
                    $.get(
                        '/api/sucursales/all',
                        res => {
                            vm.sucursales = res.results;
                            vm.$nextTick(() => {
                                vm.puesto_model.sucursal_id = this.empleado.info_puesto?.sucursal_id;
                            });
                        }, 'json'
                    );
                },
                getPuestos() {
                    let vm = this;
                    $.get(
                        '/api/empleados/all',
                        res => {
                            vm.puestos = res.results;
                            vm.$nextTick(() => {
                                vm.tag_puesto.whitelist = vm.puestos.map(item => ({value: item.nombre, id: item.id}));
                            });
                        }, 'json'
                    );
                },
                getAreas() {
                    let vm = this;
                    $.get(
                        '/api/empleados/areas',
                        res => {
                            vm.areas = res.results;
                            vm.$nextTick(() => {
                                vm.tag_area.whitelist = vm.areas.map(item => ({value: item.nombre, id: item.id}));
                            });
                        }, 'json'
                    );
                },
                saveEmpleadoInfo() {
                    let vm = this;
                    if (vm.validator) {
                        vm.validator.validate().then(function (status) {
                            if (status == 'Valid') {
                                vm.loading = true;
                                vm.showLoader();
                                $.ajax({
                                    method: "POST",
                                    url: "/api/empleados/save-empleado",
                                    data: {
                                        empleado_id: vm.empleado.id,
                                        no_empleado: vm.info_model.no_empleado,
                                        nombre: vm.info_model.nombre,
                                        apellidos: vm.info_model.apellidos,
                                        alias: vm.info_model.alias,
                                        rfc: vm.info_model.rfc,
                                        curp: vm.info_model.curp,
                                        ine: vm.info_model.ine,
                                        nss: vm.info_model.nss,
                                        domicilio_ine: vm.info_model.domicilio_ine,
                                        domicilio_actual: vm.info_model.domicilio_actual,
                                        domicilio_fiscal: vm.info_model.domicilio_fiscal,
                                        telefono: vm.info_model.telefono,
                                        celular: vm.info_model.celular,
                                        email: vm.info_model.email,
                                        email_trabajo: vm.info_model.email_trabajo,
                                        fecha_nacimiento: vm.info_model.fecha_nacimiento,
                                        fecha_ingreso: vm.info_model.fecha_ingreso,
                                        fecha_alta_imss: vm.info_model.fecha_alta_imss,
                                        no_cuenta: vm.info_model.no_cuenta,
                                        no_clabe: vm.info_model.no_clabe,
                                        no_tarjeta: vm.info_model.no_tarjeta,
                                    }
                                }).done(function (res) {
                                    if (res.success === true) {
                                        Swal.fire(
                                            "¡Guardado!",
                                            "Los datos del empleado se han almacenado con éxito",
                                            "success"
                                        );
                                        vm.empleado = res.results;
                                        vm.isEditInfo = false;
                                    } else {
                                        Swal.fire(
                                            "¡Error!",
                                            res?.message ?? "No se pudo registrar al empleado",
                                            "warning"
                                        );
                                    }
                                }).fail(function (jqXHR, textStatus) {
                                    console.log("Request failed saveEmpleado: " + textStatus, jqXHR);
                                    Swal.fire("¡Error!", "Ocurrió un error inesperado al procesar la solicitud. Por favor, inténtelo nuevamente.", "error");
                                }).always(function (event, xhr, settings) {
                                    vm.loading = false;
                                    vm.stopLoader();
                                });
                            }
                        });
                    }
                },
                saveEmpleadoPuesto() {
                    let vm = this;
                    vm.loading = true;
                    vm.showLoader();

                    $.ajax({
                        method: "POST",
                        url: "/api/empleados/save-puesto-empleado",
                        data: {
                            empleado_id: vm.empleado.id,
                            area_id: vm.puesto_model.area_id,
                            area: vm.puesto_model.area,
                            puesto_id: vm.puesto_model.puesto_id,
                            puesto: vm.puesto_model.puesto,
                            jefe_id: vm.puesto_model.jefe_id,
                            sucursal_id: vm.puesto_model.sucursal_id,
                            horario: vm.puesto_model.horario,
                        }
                    }).done(function (res) {
                        if (res.success === true) {
                            Swal.fire(
                                "¡Guardado!",
                                "Los datos del empleado se han almacenado con éxito",
                                "success"
                            );
                            vm.$set(vm.empleado, 'info_puesto', res.infoPuesto);
                            vm.isEditPuesto = false;
                        } else {
                            Swal.fire(
                                "¡Error!",
                                res?.message ?? "No se pudo registrar al empleado",
                                "warning"
                            );
                        }
                    }).fail(function (jqXHR, textStatus) {
                        console.log("Request failed saveEmpleado: " + textStatus, jqXHR);
                        Swal.fire("¡Error!", "Ocurrió un error inesperado al procesar la solicitud. Por favor, inténtelo nuevamente.", "error");
                    }).always(function (event, xhr, settings) {
                        vm.loading = false;
                        vm.stopLoader();
                    });
                },
                saveEmpleadoNomina() {
                    let vm = this;
                    vm.loading = true;
                    vm.showLoader();
                    $.ajax({
                        method: "POST",
                        url: "/api/empleados/save-nomina-empleado",
                        data: {
                            empleado_id: vm.empleado.id,
                            sueldo_mensual_neto: vm.nomina_model.sueldo_mensual_neto,
                            sueldo_mensual_bruto: vm.nomina_model.sueldo_mensual_bruto,
                            sueldo_mensual_efectivo: vm.nomina_model.sueldo_mensual_efectivo,
                            sueldo_quincenal_neto: vm.nomina_model.sueldo_quincenal_neto,
                            sueldo_quincena1_efectivo: vm.nomina_model.sueldo_quincena1_efectivo,
                            sueldo_quincena2_efectivo: vm.nomina_model.sueldo_quincena2_efectivo,
                            sueldo_diario: vm.nomina_model.sueldo_diario,
                            sueldo_diario_integrado: vm.nomina_model.sueldo_diario_integrado,
                            gasto_nomina: vm.nomina_model.gasto_nomina,
                            gasto_patronal: vm.nomina_model.gasto_patronal,
                            pres_vehiculo: vm.nomina_model.pres_vehiculo,
                            pres_gasolina: vm.nomina_model.pres_gasolina,
                            pres_celular: vm.nomina_model.pres_celular,
                            pres_alimentos: vm.nomina_model.pres_alimentos,
                            pres_seguro_medico_menor: vm.nomina_model.pres_seguro_medico_menor,
                            pres_cursos_profesional: vm.nomina_model.pres_cursos_profesional,
                            pres_cursos_personal: vm.nomina_model.pres_cursos_personal,
                            pres_otros: vm.nomina_model.pres_otros,
                        }
                    }).done(function (res) {
                        if (res.success === true) {
                            Swal.fire(
                                "¡Guardado!",
                                "Los datos del empleado se han almacenado con éxito",
                                "success"
                            );
                            vm.$set(vm.empleado, 'info_nomina', res.infoNomina);
                            vm.isEditNomina = false;
                        } else {
                            Swal.fire(
                                "¡Error!",
                                res?.message ?? "No se pudo registrar al empleado",
                                "warning"
                            );
                        }
                    }).fail(function (jqXHR, textStatus) {
                        console.log("Request failed saveEmpleado: " + textStatus, jqXHR);
                        Swal.fire("¡Error!", "Ocurrió un error inesperado al procesar la solicitud. Por favor, inténtelo nuevamente.", "error");
                    }).always(function (event, xhr, settings) {
                        vm.loading = false;
                        vm.stopLoader();
                    });
                },
                saveFile(doc) {
                    let vm = this;
                    vm.loading = true;
                    vm.showLoader();
                    let form = document.querySelector(`#archivos_${doc.slug}_form`);
                    let data = new FormData(form);
                    data.append("empleado_id", vm.empleado.id);
                    data.append("categoria", doc.categoria);
                    data.append("slug", doc.slug);

                    $.ajax({
                        method: "POST",
                        url: "/api/empleados/save-file-empleado",
                        data: data,
                        processData: false,
                        contentType: false,
                        dataType: "JSON"
                    }).done(function (res) {
                        if (res.success === true) {
                            Swal.fire(
                                "¡Guardado!",
                                "El archivo se ha almacenado con éxito",
                                "success"
                            );
                            vm.$set(vm.edit, doc.slug, false);
                            vm.$set(vm.empleado, 'archivos', res.archivos);
                            vm.$nextTick(() => {
                                vm.formatFilesList();
                            })
                        } else {
                            Swal.fire(
                                "¡Error!",
                                res?.message ?? "No se pudo registrar el archivo",
                                "warning"
                            );
                        }
                    }).fail(function (jqXHR, textStatus) {
                        console.log("Request failed saveEmpleado: " + textStatus, jqXHR);
                        Swal.fire("¡Error!", "Ocurrió un error inesperado al procesar la solicitud. Por favor, inténtelo nuevamente.", "error");
                    }).always(function (event, xhr, settings) {
                        vm.loading = false;
                        vm.stopLoader();
                    });
                },
                deleteFile(doc) {
                    let vm = this;
                    Swal.fire({
                        title: '¿Estas seguro de que deseas eliminar el registro del archivo?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, eliminar',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            vm.loading = true;
                            vm.showLoader();
                            $.ajax({
                                method: "POST",
                                url: "/api/empleados/delete-file-empleado",
                                data: {
                                    empleado_id: vm.empleado.id,
                                    archivo_id: doc.id,
                                }
                            }).done(function (res) {
                                if (res.success === true) {
                                    Swal.fire(
                                        'Registro eliminado',
                                        'El registro del archivo ha sido eliminado con éxito',
                                        'success'
                                    );
                                    vm.$set(vm.empleado, 'archivos', res.archivos);
                                    vm.$nextTick(() => {
                                        vm.formatFilesList();
                                    })
                                } else {
                                    Swal.fire(
                                        "¡Error!",
                                        res?.message ?? "No se pudo eliminar el archivo",
                                        "warning"
                                    );
                                }
                            }).fail(function (jqXHR, textStatus) {
                                console.log("Request failed deleteEmpleado: " + textStatus, jqXHR);
                                Swal.fire("¡Error!", "Ocurrió un error inesperado al procesar la solicitud. Por favor, inténtelo nuevamente.", "error");
                            }).always(function (event, xhr, settings) {
                                vm.loading = false;
                                vm.stopLoader();
                            });
                        }
                    })
                },
                formatFilesList() {
                    let vm = this;

                    vm.papeleria_docs = [
                        {
                            title: 'Solicitud de empleo',
                            categoria: 'papeleria',
                            slug: 'solicitud_empleo',
                        },
                        {
                            title: 'Currículum',
                            categoria: 'papeleria',
                            slug: 'curriculum',
                        },
                        {
                            title: 'RFC',
                            categoria: 'papeleria',
                            slug: 'archivo_rfc',
                        },
                        {
                            title: 'CURP',
                            categoria: 'papeleria',
                            slug: 'archivo_curp',
                        },
                        {
                            title: 'INE',
                            categoria: 'papeleria',
                            slug: 'archivo_ine',
                        },
                    ],
                    vm.entrevistas_docs = [
                        {
                            title: 'Entrevista telefónica o de primer contacto',
                            categoria: 'entrevistas',
                            slug: 'entrevista_primer_contacto',
                        },
                        {
                            title: 'Entrevista Top Grading',
                            categoria: 'entrevistas',
                            slug: 'entrevista_top_grading',
                        },
                        {
                            title: 'Score Card llena',
                            categoria: 'entrevistas',
                            slug: 'entrevista_score_card',
                        },
                        {
                            title: 'Autorización del jefe de área para firma del contrato de 1 mes',
                            categoria: 'entrevistas',
                            slug: 'autorizacion_contracto_mes1',
                        },
                    ];
                    vm.contratos_docs_mes1 = [
                        {
                            categoria: 'contratos',
                            title: 'Perfil del puesto entregado al empleado',
                            slug: 'contrato_perfil_puesto'
                        },
                        {
                            categoria: 'contratos',
                            title: '5 actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo',
                            slug: 'contrato_actividades_mes1'
                        },
                        {
                            categoria: 'contratos',
                            title: 'Formato Junta Retroalimentación llenado por parte del jefe directo',
                            slug: 'contrato_retroalimentacion_mes1'
                        },
                        {
                            categoria: 'contratos',
                            title: 'Autorización del jefe de área para firma del siguiente contrato',
                            slug: 'contrato_autorizacion_contrato_mes1'
                        }
                    ];
                    vm.contratos_docs_mes3 = [
                        {
                            categoria: 'contratos',
                            title: '15 actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo',
                            slug: 'contrato_actividades_mes3'
                        },
                        {
                            categoria: 'contratos',
                            title: 'Formatos Junta Retroalimentación llenado (uno por mes) por parte del jefe directo',
                            slug: 'contrato_retroalimentacion_mes3'
                        },
                        {
                            categoria: 'contratos',
                            title: 'Autorización del jefe de área para firma del siguiente contrato',
                            slug: 'contrato_autorizacion_contrato_mes3'
                        }
                    ];
                    vm.contratos_docs_ano1 = [
                        {
                            categoria: 'contratos',
                            title: '20 actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo',
                            slug: 'contrato_actividades_ano1'
                        },
                        {
                            categoria: 'contratos',
                            title: 'Formato Junta Retroalimentación llenado (1 por mes) por parte del jefe directo',
                            slug: 'contrato_retroalimentacion_ano1'
                        },
                        {
                            categoria: 'contratos',
                            title: 'Autorización del jefe de área para firma del siguiente contrato',
                            slug: 'contrato_autorizacion_contrato_ano1'
                        },
                        {
                            categoria: 'contratos',
                            title: 'Autorización del CEO para firma del siguiente contrato',
                            slug: 'contrato_autorizacion_ceo_contrato'
                        }
                    ];
                    vm.contratos_docs = [
                        {
                            categoria: 'contratos',
                            title: 'Contrato indefinido (sin fecha de terminación)',
                            slug: 'contrato_indefinido'
                        },
                        {
                            categoria: 'contratos',
                            title: 'Actividades claves a evaluar durante el tiempo del contrato explicado por parte del jefe directo',
                            slug: 'contrato_actividades_indefinido'
                        },
                        {
                            categoria: 'contratos',
                            title: 'Formato Junta Retroalimentación llenado (1 por mes) por parte del jefe directo',
                            slug: 'contrato_retroalimentacion_indefinido'
                        }
                    ];

                    vm.papeleria_docs.forEach(el => {
                        let archivo = vm.empleado.archivos.find(item => item.categoria == el.categoria && item.slug == el.slug);
                        if(archivo){
                            el.id = archivo.id;
                            el.archivo = Object.assign({}, archivo.archivo);
                        }
                    });
                    vm.entrevistas_docs.forEach(el => {
                        let archivo = vm.empleado.archivos.find(item => item.categoria == el.categoria && item.slug == el.slug);
                        if(archivo){
                            el.id = archivo.id;
                            el.archivo = Object.assign({}, archivo.archivo);
                        }
                    });
                    vm.contratos_docs_mes1.forEach(el => {
                            let archivo = vm.empleado.archivos.find(item => item.categoria == el.categoria && item.slug == el.slug);
                            if(archivo){
                                el.id = archivo.id;
                                el.archivo = Object.assign({}, archivo.archivo);
                            }
                        });
                    vm.contratos_docs_mes3.forEach(el => {
                            let archivo = vm.empleado.archivos.find(item => item.categoria == el.categoria && item.slug == el.slug);
                            if(archivo){
                                el.id = archivo.id;
                                el.archivo = Object.assign({}, archivo.archivo);
                            }
                        });
                    vm.contratos_docs_ano1.forEach(el => {
                            let archivo = vm.empleado.archivos.find(item => item.categoria == el.categoria && item.slug == el.slug);
                            if(archivo){
                                el.id = archivo.id;
                                el.archivo = Object.assign({}, archivo.archivo);
                            }
                        });
                    vm.contratos_docs.forEach(el => {
                            let archivo = vm.empleado.archivos.find(item => item.categoria == el.categoria && item.slug == el.slug);
                            if(archivo){
                                el.id = archivo.id;
                                el.archivo = Object.assign({}, archivo.archivo);
                            }
                        });
                },
                showLoader(){
                    let vm = this;
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
                },
                stopLoader(){
                    let vm = this;
                    if (vm.blockUI && vm.blockUI.isBlocked()) {
                        vm.blockUI.release();
                    }
                },
                parseDecimals(num, decimals = 2) {
                    if (num) {
                        return Number(parseFloat(num).toFixed(decimals));
                    }
                    return 0.0;
                }
            },
            computed: {
                listaEmpleados(){
                    return this.empleados.map(item => ({id: item.id, text: item.nombre_completo}));
                },
                listaSucursales(){
                    return this.sucursales.map(item => ({id: item.id, text: item.nombre}));
                },
                gastoTotalNomina() {
                    return this.parseDecimals(this.empleado.info_nomina?.sueldo_mensual_bruto) +
                        this.parseDecimals(this.empleado.info_nomina?.sueldo_mensual_efectivo) +
                        this.parseDecimals(this.empleado.info_nomina?.gasto_patronal) +
                        this.parseDecimals(this.empleado.info_nomina?.pres_vehiculo) +
                        this.parseDecimals(this.empleado.info_nomina?.pres_gasolina) +
                        this.parseDecimals(this.empleado.info_nomina?.pres_celular) +
                        this.parseDecimals(this.empleado.info_nomina?.pres_alimentos) +
                        this.parseDecimals(this.empleado.info_nomina?.pres_seguro_medico_menor) +
                        this.parseDecimals(this.empleado.info_nomina?.pres_cursos_profesional) +
                        this.parseDecimals(this.empleado.info_nomina?.pres_cursos_personal) +
                        this.parseDecimals(this.empleado.info_nomina?.pres_otros);
                }
            },
            watch: {
                isEditInfo(n, o) {
                    if(n){
                        this.info_model = {
                            no_empleado: this.empleado.no_empleado,
                            fecha_ingreso: this.empleado.fecha_ingreso,
                            fecha_alta_imss: this.empleado.fecha_alta_imss,
                            nombre: this.empleado.nombre,
                            apellidos: this.empleado.apellidos,
                            alias: this.empleado.alias,
                            curp: this.empleado.curp,
                            ine: this.empleado.ine,
                            nss: this.empleado.nss,
                            domicilio_ine: this.empleado.domicilio_ine,
                            domicilio_actual: this.empleado.domicilio_actual,
                            telefono: this.empleado.telefono,
                            celular: this.empleado.celular,
                            email_trabajo: this.empleado.email_trabajo,
                            email: this.empleado.email,
                            fecha_nacimiento: this.empleado.fecha_nacimiento,
                            rfc: this.empleado.rfc,
                            domicilio_fiscal: this.empleado.domicilio_fiscal,
                            no_cuenta: this.empleado.no_cuenta,
                            no_clabe: this.empleado.no_clabe,
                            no_tarjeta: this.empleado.no_tarjeta,
                        };    
                    } else {
                        this.initformValidate();
                    }
                },
                isEditPuesto(n, o) {
                    if(n){
                        this.puesto_model = {
                            jefe_id: this.empleado.info_puesto?.jefe_id,
                            sucursal_id: this.empleado.info_puesto?.sucursal_id,
                            horario: this.empleado.info_puesto?.horario ?? [
                                {dia: 'Lunes'},
                                {dia: 'Martes'},
                                {dia: 'Miércoles'},
                                {dia: 'Jueves'},
                                {dia: 'Viernes'},
                                {dia: 'Sábado'},
                                {dia: 'Domingo'},
                            ],
                        };

                        if(this.empleado.info_puesto?.puesto){
                            this.tag_puesto.addTags([{value: this.empleado.info_puesto?.puesto?.nombre, id: this.empleado.info_puesto?.puesto?.id}]);
                            this.tag_puesto.value = [{value: this.empleado.info_puesto?.puesto?.nombre, id: this.empleado.info_puesto?.puesto?.id}];
                        }
                        if(this.empleado.info_puesto?.area){
                            this.tag_area.addTags([{value: this.empleado.info_puesto?.area?.nombre, id: this.empleado.info_puesto?.area?.id}]);
                            this.tag_area.value = [{value: this.empleado.info_puesto?.area?.nombre, id: this.empleado.info_puesto?.area?.id}];   
                        }
                    }
                },
                isEditNomina(n, o) {
                    if(n){
                        this.nomina_model = {
                            sueldo_mensual_neto: this.empleado.info_nomina?.sueldo_mensual_neto,
                            sueldo_mensual_bruto: this.empleado.info_nomina?.sueldo_mensual_bruto,
                            sueldo_mensual_efectivo: this.empleado.info_nomina?.sueldo_mensual_efectivo,
                            sueldo_quincenal_neto: this.empleado.info_nomina?.sueldo_quincenal_neto,
                            sueldo_quincena1_efectivo: this.empleado.info_nomina?.sueldo_quincena1_efectivo,
                            sueldo_quincena2_efectivo: this.empleado.info_nomina?.sueldo_quincena2_efectivo,
                            sueldo_diario: this.empleado.info_nomina?.sueldo_diario,
                            sueldo_diario_integrado: this.empleado.info_nomina?.sueldo_diario_integrado,
                            gasto_nomina: this.empleado.info_nomina?.gasto_nomina,
                            gasto_patronal: this.empleado.info_nomina?.gasto_patronal,
                            pres_vehiculo: this.empleado.info_nomina?.pres_vehiculo,
                            pres_gasolina: this.empleado.info_nomina?.pres_gasolina,
                            pres_celular: this.empleado.info_nomina?.pres_celular,
                            pres_alimentos: this.empleado.info_nomina?.pres_alimentos,
                            pres_seguro_medico_menor: this.empleado.info_nomina?.pres_seguro_medico_menor,
                            pres_cursos_profesional: this.empleado.info_nomina?.pres_cursos_profesional,
                            pres_cursos_personal: this.empleado.info_nomina?.pres_cursos_personal,
                            pres_otros: this.empleado.info_nomina?.pres_otros,
                        };
                    }
                },
            }
        });

        Vue.use(VueTables.ClientTable);
    </script>
@endsection
