<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import ColumnSelectFilter from '@/components/letture/column-select-filter.vue';
import ColumnTextFilter from '@/components/letture/column-text-filter.vue';
import { columns } from '@/components/letture/columns';
import DataTable from '@/components/letture/data-table.vue';
import letture from '@/routes/letture';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Letture',
                href: letture.index().url,
            },
        ],
    },
});

defineProps({
    items: {
        type: Object,
        required: true,
    },
});

const page = usePage();
const unitaMisura = computed(() => page.props.unitaMisura);

console.log('unitaMisura: ', unitaMisura.value);
</script>
<template>
    <Head title="Letture" />
    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <section class="mx-auto w-full max-w-3/4">
            <DataTable :columns="columns" :data="items.data">
                <template #toolbar="{ table }">
                    <ColumnTextFilter
                        :table="table"
                        column-id="anagrafica"
                        placeholder="Filtra anagrafica..."
                    />
                    <ColumnSelectFilter
                        :table="table"
                        column-id="unita_misura"
                        :options="unitaMisura"
                        placeholder="Filtra tipo lettura..."
                    />
                </template>
            </DataTable>
        </section>
    </div>
</template>

<style scoped></style>
