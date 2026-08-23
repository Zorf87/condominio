<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import DataTable from '@/components/letture/data-table.vue';
import letture from '@/routes/letture';
import { columns } from '../../components/letture/columns';

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
</script>
<template>
    <Head title="Letture" />
    <DataTable :columns="columns" :data="items.data" />
</template>

<style scoped></style>
