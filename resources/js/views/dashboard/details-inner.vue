<template>
    <section>
        <p>
            <small>
                <strong>{{ detailsAgenceText }}</strong>
            </small>
            <br />
            <small>{{ detailsPeriodText }}</small>
        </p>
        <b-field grouped group-multiline>
            <b-select v-model="perPage" :disabled="!isPaginated">
                <option value="5">5 par page</option>
                <option value="10">10 par page</option>
                <option value="15">15 par page</option>
                <option value="20">20 par page</option>
            </b-select>
        </b-field>
        <b-table
            :data="statdetails"
            ref="table"
            :debounce-search="1000"
            :paginated="isPaginated"
            :per-page="perPage"
            :opened-detailed="defaultOpenedDetails"
            detailed
            detail-key="id"
            :detail-transition="transitionName"
            :show-detail-icon="showDetailIcon"
            :current-page.sync="currentPage"
            :pagination-simple="isPaginationSimple"
            :pagination-position="paginationPosition"
            :default-sort-direction="defaultSortDirection"
            :pagination-rounded="isPaginationRounded"
            :sort-icon="sortIcon"
            :sort-icon-size="sortIconSize"
            :sticky-header="stickyHeaders"
            default-sort="row.name"
            aria-next-label="Suivant"
            aria-previous-label="Precedent"
            aria-page-label="Page"
            aria-current-label="Current page" :before-destroy="false">

            <template v-for="column in columns">
                <b-table-column :key="column.id" v-bind="column" :sortable="column.sortable">
                    <template
                        v-if="column.searchable && !column.numeric"
                        #searchable="props">
                        <b-input
                            v-model="props.filters[props.column.field]"
                            placeholder="Rech..."
                            icon="magnify"
                            size="is-small"
                            icon-right="close-circle"
                            icon-right-clickable
                            @icon-right-click="props.filters[props.column.field] = ''"
                        />
                    </template>

                    <template v-slot="props">
                        <span v-if="column.field === 'id'" class="text-xs">
                            {{ props.row[column.field] }}
                        </span>
                        <span v-else-if="column.field === 'name'" class="has-text-primary is-italic text-xs">
                            <a @click="showUser(props.row)">
                                {{ props.row[column.field] }}
                            </a>
                        </span>
                        <span v-else-if="column.field === 'esimsattributed'">
                            <b-taglist>
                                <b-tag type="is-primary is-light">{{ props.row.esimsattributed.length }}</b-tag>
                            </b-taglist>
                        </span>
                        <span v-else-if="column.field === 'departement'" class="has-text-info is-italic text-xs">
                            <span v-if="props.row.employe.departement">
                                {{ props.row.employe.departement.intitule }}
                            </span>
                        </span>
                        <span v-else class="text-xs">
                            {{ props.row[column.field] }}
                        </span>
                    </template>
                </b-table-column>
            </template>

            <template #detail="props">
                <b-field grouped group-multiline>
                    <div class="form-inline float-left">
                        <span class="help-inline pr-1 text-sm"> eSIM(s) attribuee(s) </span>
                    </div>
                </b-field>
                <hr />

                <esimsListDetails v-if="props.row.esimsattributed" :esims_prop="props.row.esimsattributed"></esimsListDetails>

            </template>

            <template #empty>
                <div class="has-text-centered">Aucune Données</div>
            </template>

        </b-table>
    </section>
</template>

<script>

    export default {
        name: "details-inner",
        props: {
            statdetails_prop: {},
            stat_agence_prop: '',
            stat_period_prop: '',
        },
        components: {
            esimsListDetails: () => import('../esims/list-details'),
        },
        data() {
            return {
                statdetails: this.statdetails_prop,

                stat_agence: this.stat_agence_prop,
                stat_period: this.stat_period_prop,

                //data: this.workflowsteps_prop,
                isPaginated: true,
                isPaginationSimple: false,
                isPaginationRounded: true,
                paginationPosition: 'bottom',
                defaultSortDirection: 'asc',
                sortIcon: 'arrow-up',
                sortIconSize: 'is-small',
                currentPage: 1,
                perPage: 5,
                defaultOpenedDetails: [-1],
                showDetailIcon: true,
                useTransition: false,
                stickyHeaders: false,
                columns: [
                    {
                        field: 'id',
                        key: 'id',
                        label: 'ID',
                        numeric: true,
                        searchable: false,
                        sortable: true,
                    },
                    {
                        field: 'name',
                        key: 'name',
                        label: 'Nom',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        field: 'email',
                        key: 'email',
                        label: 'Email',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        field: 'departement',
                        key: 'departement',
                        label: 'Departement',
                        searchable: false,
                        sortable: true,
                    },
                    {
                        field: 'esimsattributed',
                        key: 'esimsattributed',
                        label: 'Esim(s)',
                        width: '100',
                        centered: true,
                        sortable: false,
                    }
                ]
            };
        },
        methods: {
            showUser(row) {

            },
            searchTitre(row, input) {
                console.log('Searching Titre ...', row, input)
                return input && row.titre && row.titre.includes(input);
            },
            searchDescription(row, input) {
                console.log('Searching Description ...', row, input)
                return input && row.description && row.description.includes(input);
            },
            searchDefault(row, input) {
                console.log('Searching Default ...', row, input)
                return true;
            },
            columnTdAttrs(row, column) {
                if (row.id === 'Total') {
                    if (column.label === 'ID') {
                        return {
                            colspan: 4,
                            class: 'has-text-weight-bold',
                            style: {
                                'text-align': 'left !important'
                            }
                        }
                    } else if (column.label === 'Gender') {
                        return {
                            class: 'has-text-weight-semibold'
                        }
                    } else {
                        return {
                            style: {display: 'none'}
                        }
                    }
                }
                return null
            }
        },
        computed: {
            detailsAgenceText() {
                if (this.stat_agence) {
                    return this.stat_agence.intitule
                }
                return ""
            },
            detailsPeriodText() {
                if (this.stat_period) {
                    return this.stat_period
                }
                return ""
            },
            transitionName() {
                if (this.useTransition) {
                    return 'fade'
                }
            }
        }
    }
</script>

<style scoped>

</style>
