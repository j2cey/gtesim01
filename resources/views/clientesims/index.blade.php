@extends('app', ['page_title' => "Clients"])

@section('app_content')

    <section class="section">

        <div class="container">

            <div class="tw-bg-white tw-shadow-md tw-rounded tw-px-3 md:tw-px-8 tw-pt-3 md:tw-pt-6 tw-pb-3 md:tw-pb-8 tw-mb-4">

                <div class="tw-mb-4">

                    <h2 class="tw-text-blue-600 tw-text-sm tw-font-bold tw-mb-3 tw-border-b tw-border-gray-400 tw-pb-2">
                        <span class="text text-align-left">Liste des Clients E-sim</span>
                        <span class="text text-align-right">
                            @can('clientesim-create')
                            <b-button size="is-small" type="is-info is-light" @click="$emit('create_new_clientesim', -1)"><i class="fas fa-plus"></i></b-button>
                            @endcan
                        </span>
                    </h2>

                    <!-- SEARCH FORM -->

                    <search-form
                        group="clientesim-search"
                        url="{{ route('clientesims.fetch') }}"
                        :params="{
                            search: '',
                            per_page: {{ $defaultPerPage }},
                            page: 1,
                            order_by: 'id:desc',
                            createdat_from: '',
                            createdat_to: '',
                            status: '',
                            }"
                        v-slot="{ params, update, change, clear, processing }"
                    >

                        <form class="tw-grid tw-grid-cols-10 tw-col-gap-4 tw-pb-3 tw-border-b tw-border-gray-400">
                            <div class="tw-col-span-4 md:tw-col-span-2">
                                <label
                                    for="createdat_from"
                                    class="tw-block tw-tracking-wide tw-text-gray-700 tw-text-xs tw-font-bold tw-mb-2"
                                >
                                    Du
                                </label>
                                <div class="relative">
                                    <vue2-datepicker id="createdat_from" lang="fr" style="width: 90%; height: 90%;" v-model="params.createdat_from" format="YYYY-MM-DD" @change="change"></vue2-datepicker>
                                </div>
                            </div>

                            <div class="tw-col-span-4 md:tw-col-span-2">
                                <label
                                    for="createdat_to"
                                    class="tw-block tw-tracking-wide tw-text-gray-700 tw-text-xs tw-font-bold tw-mb-2"
                                >
                                    Au
                                </label>
                                <div class="relative">
                                    <vue2-datepicker id="createdat_to" lang="fr" style="width: 90%; height: 90%;" v-model="params.createdat_to" format="YYYY-MM-DD" @change="change"></vue2-datepicker>
                                </div>
                            </div>

                            {{--                            TODO: PB de rafraichissement des parametres de filtre--}}

                            <div class="tw-col-span-4 md:tw-col-span-6">
                                <label class="tw-block tw-uppercase tw-tracking-wide tw-text-gray-700 tw-text-xs tw-font-bold tw-mb-2" for="search">
                                    Recherche
                                </label>
                                <div class="tw-relative">
                                    <span
                                        v-if="params.search"
                                        @click="clear({ search: '' })"
                                        class="tw-absolute tw-top-0 tw-right-0 tw-mt-4 mr-4 tw-text-gray-500 tw-cursor-pointer"
                                    >
                                        <times-circle
                                            class="tw-fill-current tw-h-4 tw-pointer-events-none"
                                        ></times-circle>
                                    </span>
                                    <input
                                        v-model="params.search"
                                        @input="update"
                                        @keydown.enter.prevent
                                        type="text"
                                        id="search"
                                        name="search"
                                        class="tw-appearance-none tw-block tw-w-full tw-bg-gray-200 focus:tw-bg-white tw-text-gray-700 tw-border tw-border-gray-400 focus:tw-border-gray-500 tw-rounded-sm tw-py-3 tw-pl-4 tw-pr-10 tw-mb-3 md:tw-mb-0 tw-leading-tight focus:tw-outline-none"
                                        placeholder="Rechercher..."
                                    >
                                </div>
                            </div>
                        </form>

                    </search-form>

                    <!--/ SEARCH FORM -->


                    <!-- RESULTS -->

                    <search-results group="clientesim-search" v-slot="{ total, records }">

                        <div class="tw-text-sm">

                            <div class="tw-flex tw-flex-wrap tw-p-4 tw-bg-gray-700 tw-text-white tw-rounded-sm">
                                <div class="tw-flex-auto tw-pr-3">Total : @{{ total }}</div>
                            </div>

                            <template v-if="records.length">

                                <table class="table-auto">
                                    <thead>
                                    <tr>
                                        <th class="tw-px-4 tw-py-2">#</th>
                                        <th class="tw-px-4 tw-py-2">Nom</th>
                                        <th class="tw-px-4 tw-py-2">Numéros Téléphone</th>
                                        <th class="tw-px-4 tw-py-2">Adresses mail</th>
                                        <th class="tw-px-4 tw-py-2">Status</th>
                                        @role('Admin')
                                        <th class="tw-px-4 tw-py-2">Creator</th>
                                        <th class="tw-px-4 tw-py-2">Departement</th>
                                        @endrole('Admin')
                                        <th class="tw-px-4 tw-py-2">Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="record in records"
                                        :key="record.id"
                                        class="tw-px-4 tw-border-b tw-border-dashed tw-border-gray-400 tw-text-gray-700 hover:tw-bg-gray-100"
                                    >
                                        <td class="tw-px-4 tw-py-2">
                                            <span class="tw-text-sm">@{{ record.id }}</span>
                                        </td>
                                        <td class="tw-px-4 tw-py-2">
                                            <span class="tw-text-sm">
                                                <b>@{{ record.nom_raison_sociale }}</b>&nbsp;<span class="tw-first-letter:text-4xl">@{{ record.prenom }}</span>
                                            </span>
                                        </td>
                                        <td class="tw-px-4 tw-py-2">
                                            <span class="tw-text-xs" v-if="record.phonenums">
                                                <div class="overflow-x">
                                                    <table class="table-auto tw-bg-gray-200 overflow-scroll w-full">
                                                        <thead>
                                                        <tr>
                                                            <th class="tw-px-2 tw-py-2"><span class="tw-text-xs">Numéro</span></th>
                                                            <th class="tw-px-2 tw-py-2"><span class="tw-text-xs">ICCID</span></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="phonenum in record.phonenums" :key="phonenum.id">
                                                                <td class="tw-px-2 tw-py-2">
                                                                    <span class="tw-text-xs">@{{ phonenum.numero }}</span>
                                                                </td>
                                                                <td class="tw-px-2 tw-py-2">
                                                                    <span class="tw-text-xs">@{{ phonenum.esim.iccid }}</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        </table>
                                                    </div>
                                            </span>
                                        </td>
                                        <td class="tw-px-4 tw-py-2">
                                            <span class="tw-text-xs" v-if="record.emailaddresses">
                                                <table class="table-auto tw-bg-gray-200">
                                                    <thead>
                                                    <tr>
                                                        <th class="tw-px-4 tw-py-2">e-mail</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="emailaddress in record.emailaddresses" :key="emailaddress.id">
                                                            <td class="tw-px-4 tw-py-2">
                                                                <span class="tw-text-xs">@{{ emailaddress.email }}</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </span>
                                        </td>
                                        <td class="tw-px-6 tw-py-2">
                                            <span class="tw-text-sm" v-if="record.status">
                                                <span v-if="record.status.code === 'active'" class="tw-text-xs tw-font-semibold tw-inline-block tw-py-1 tw-px-2 tw-rounded tw-text-green-600 tw-bg-green-200 tw-w-32 last:tw-mr-0 tw-mr-1">@{{ record.status.name }}</span>
                                                <span v-else class="tw-text-xs tw-font-semibold tw-inline-block tw-py-1 tw-px-2 tw-rounded tw-text-teal-600 tw-bg-red-200 tw-w-32 last:tw-mr-0 tw-mr-1">@{{ record.status.name }}</span>
                                            </span>
                                        </td>
                                        @role('Admin')
                                        <td class="tw-px-6 tw-py-2">
                                            <span class="tw-text-xs" v-if="record.creator">
                                                @{{ record.creator.name }}
                                            </span>
                                        </td>
                                        <td class="tw-px-6 tw-py-2">
                                            <span class="tw-text-xs" v-if="record.creator.employe">
                                                @{{ record.creator.employe.departement.intitule }}
                                            </span>
                                        </td>
                                        @endrole
                                        <td class="tw-px-4 tw-py-2">
                                            @can('clientesim-edit')
                                            <a @click="$emit('edit_clientesim', record)" class="tw-inline-block tw-mr-3 tw-text-green-500">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            @endcan
                                            @can('clientesim-show')
                                            <a :href="record.show_url" class="tw-inline-block tw-mr-3 tw-text-orange-500">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            @endcan
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>

                            </template>

                            <div
                                v-else
                                class="tw-flex tw-flex-wrap tw-p-4 border-b tw-border-dashed tw-border-gray-400 tw-text-gray-700"
                            >
                                Aucune Donnee
                            </div>

                        </div>

                    </search-results>

                    <!--/ RESULTS -->


                    <!-- PAGINATION -->

                    <search-pagination group="clientesim-search" :always-show="true"></search-pagination>

                    <!--/ PAGINATION -->

                </div>

                <clientesim-addupdate></clientesim-addupdate>
            </div>
        </div>

    </section>

@endsection
