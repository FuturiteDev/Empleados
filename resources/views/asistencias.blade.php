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
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Reporte de asistencias</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-line text-muted fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-muted text-hover-primary">Inicio</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('empleados.list') }}" class="text-muted text-hover-primary">Empleados</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="text-muted">Asistencias</span>
                            </li>
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
                <div class="d-flex gap-5 justify-content-end px-10 py-6">
                    <div>
                        <div class="input-group">
                            <input class="form-control" id="picker_range"/>
                            <span class="input-group-text"><i class="fas fa-calendar fs-2"></i></span>
                        </div>
                    </div>
                    <div class="min-w-200px">
                        <v-select
                            v-model="filter_sucursal"
                            :options="listaSucursales"
                            data-allow-clear="true"
                            data-placeholder="Filtrar Sucursal">
                        </v-select>
                    </div>
                    <div>
                        <button class="btn btn-success" :disabled="loading" @click="getEmpleados(true)"><i class="fas fa-search"></i> Buscar</button>
                    </div>
                    <div>
                        <button class="btn btn-info" :disabled="loading" @click="exportarExcel"><i class="fa-solid fa-file-export"></i> Exportar</button>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-4">
                    <v-client-table v-model="empleados" :columns="columns" :options="options" ref="asistencias">
                    </v-client-table>
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
    <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>

    <script>
        const app = new Vue({
            el: '#app',
            delimiters: ['[[', ']]'],
            data: () => ({
                empleados: [],
                sucursales: [],
                columns: ['no_empleado', 'nombre', 'asistencias', 'retardos', 'faltas'],
                options: {
                    headings: {
                        no_empleado: 'Número empleado',
                        nombre_completo: 'Empleado',
                        asistencias: 'asistencias',
                        retardos: 'retardos',
                        faltas: 'faltas',
                    },
                    columnsClasses: {
                        no_empleado: 'align-middle px-2 ',
                        nombre_completo: 'align-middle ',
                        asistencias: 'align-middle text-center ',
                        retardos: 'align-middle text-center ',
                        faltas: 'align-middle text-center ',
                    },
                    sortable: ['no_empleado', 'nombre_completo', 'asistencias', 'retardos', 'faltas'],
                    filterable: ['no_empleado', 'nombre_completo'],
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
                filter_sucursal: null,
                filter_fecha_inicio: null,
                filter_fecha_fin: null,
 
                loading: false,
                validator: null,
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
                vm.getSucursales();
                vm.initPickers();
            },
            methods: {
                initPickers() {
                    let vm = this;
                    vm.picker_entrega = $("#picker_range").flatpickr({
                        enableTime: false,
                        altInput: true,
                        altFormat: "d/m/Y",
                        dateFormat: "Y-m-d",
                        mode: "range",
                        locale: "es",
                        onChange: function (selectedDates, dateStr, instance) {
                            vm.filter_fecha_inicio = moment(selectedDates[0]).format("YYYY-MM-D");
                            vm.filter_fecha_fin = moment(selectedDates[1]).format("YYYY-MM-DD");
                        },
                    });
                },
                getEmpleados(showLoader) {
                    let vm = this;
                    if (showLoader && vm.blockUI) {
                        vm.blockUI.block();
                    }

                    if (vm.requestGet) {
                        vm.requestGet.abort();
                        vm.requestGet = null;
                    }

                    vm.loading = true;

                    vm.requestGet = $.ajax({
                        url: '/api/empleados/reportes/asistencias',
                        type: 'POST',
                        data: {
                            fecha_inicio: vm.filter_fecha_inicio,
                            fecha_fin: vm.filter_fecha_fin,
                            sucursal_id: vm.filter_sucursal,
                        }
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
                getSucursales() {
                    let vm = this;
                    $.get('/api/sucursales/all', res => {
                        vm.sucursales = res.results;
                    }, 'json');
                },
                async exportarExcel() {
                    let vm = this;
                    let tableref = vm.$refs.asistencias;
                    let columns = tableref.columns;
                    let headings = columns.map((col) => {
                        return tableref.options.headings[col].toUpperCase() ?? col.toUpperCase();
                    });

                    let data = [];
                    tableref.allFilteredData.forEach(item => {
                        let obj = {
                            no_empleado: item.no_empleado,
                            nombre: item.nombre,
                            asistencias: item.asistencias,
                            retardos: item.retardos,
                            faltas: item.faltas,
                        };

                        data.push(obj);
                    });

                    var ws = XLSX.utils.json_to_sheet(data, { header: columns });
                    XLSX.utils.sheet_add_aoa(ws, [headings], { origin: "A1" });

                    var wb = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(wb, ws, "Asistencias");
                    XLSX.writeFile(wb, "asistencias_" + moment().format('YYYY_MM_DD_HH_mm') + ".xlsx");
                },
            },
            computed: {
                listaSucursales() {
                    return this.sucursales.map(item => ({ id: item.id, text: item.nombre }));
                },
            },
        });

        Vue.use(VueTables.ClientTable);
    </script>
@endsection
