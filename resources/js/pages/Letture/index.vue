<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
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
</script>
<template>
    <Head title="Letture" />
    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <section class="mx-auto w-full max-w-3/4">
            <DataTable :columns="columns" :data="items.data" />
        </section>
    </div>
</template>

<style scoped></style>
