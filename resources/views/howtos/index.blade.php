@extends('app', ['page_title' => "Rubrique Pour file de Tutos"])

@section('app_content')

    <section class="section">

        <div class="container">

            <div class="tw-bg-white tw-shadow-md tw-rounded tw-px-3 md:tw-px-8 tw-pt-3 md:tw-pt-6 tw-pb-3 md:tw-pb-8 tw-mb-4">

                <div class="tw-mb-4">

                    <h5 class="tw-text-blue-600 tw-text-sm tw-font-bold tw-mb-3 tw-border-b tw-border-gray-400 tw-pb-2">
                        <span class="text text-align-left">Rubriques de Tutos</span>
                        <span class="text text-align-right">
                            @can('howto-create')
                                <b-button size="is-small" type="is-info is-light" @click="$emit('create_new_howto', -1)"><i class="fas fa-plus"></i></b-button>
                            @endcan
                        </span>
                    </h5>

                    <!-- SEARCH FORM -->

                    <search-form
                        group="howto-search"
                        url="{{ route('howtos.fetch') }}"
                        :params="{
                            search: '',
                            per_page: {{ $defaultPerPage }},
                            page: 1,
                            order_by: 'id:desc',
                            status: '',
                            }"
                        v-slot="{ params, update, change, clear, processing }"
                    >

                        <form class="tw-grid tw-grid-cols-8 tw-col-gap-4 tw-pb-3 tw-border-b tw-border-gray-400">

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

                    <search-results group="howto-search" v-slot="{ total, records }">

                        <div class="tw-text-sm">

                            <div class="tw-flex tw-flex-wrap tw-p-1 tw-bg-gray-500 tw-text-white tw-rounded-sm">
                                <div class="tw-flex-auto tw-pr-3">Total : @{{ total }}</div>
                            </div>

                            <template v-if="records.length">

                                <div class="container tw-mt-4 tw-mx-auto">
                                    <div class="tw-grid tw-grid-cols-3 tw-sm:grid-cols-2 tw-md:grid-cols-3 tw-lg:grid-cols-4">
                                        <div v-for="record in records"
                                             :key="record.id" class="card tw-m-2 tw-border tw-border-gray-400 tw-rounded-lg hover:tw-shadow-md hover:tw-border-opacity-0 transform hover:tw--translate-y-1 tw-transition-all tw-duration-200">
                                            <div class="tw-m-3">
                                                <h5 class="tw-text-sm tw-mb-2 tw-cursor-pointer">
                                                    <a :href="record.readhtml_url" class="tw-inline-block tw-mr-3">
                                                    @{{ record.title }}
                                                    </a>
                                                    <span class="tw-text-xs tw-text-teal-800 tw-font-mono tw-bg-teal-100 tw-inline tw-rounded-full tw-px-2 align-top float-right tw-animate-pulse">
                                                        @can('howto-edit')
                                                        <span class="tw-inline-block tw-mr-3 tw-text-green-500">
                                                            <i class="fa fa-pencil-square-o" @click="$emit('edit_howto', record)"></i>
                                                        </span>
                                                        @endcan
                                                        @can('howto-edithtml')
                                                        <a :href="record.edithtml_url" class="tw-inline-block tw-mr-3 tw-text-red-500">
                                                            <i class="fa fa-file-code-o" aria-hidden="true"></i>
                                                        </a>
                                                        @endcan
                                                    </span>
                                                </h5>
                                                <p class="tw-font-light tw-font-mono tw-text-sm tw-text-gray-700 tw-hover:tw-text-gray-900 tw-transition-all tw-duration-200">
                                                    @{{ record.description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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

                    <search-pagination group="howto-search" :always-show="true"></search-pagination>

                    <!--/ PAGINATION -->

                </div>

                <clientesim-addupdate></clientesim-addupdate>
            </div>
        </div>

    </section>

@endsection
