<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import anagrafiche from '@/routes/anagrafiche';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Anagrafiche',
                href: anagrafiche.index().url,
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
    <Head title="Anagrafiche" />

    <ul>
        <li v-for="item in items" :key="item.id">
            {{ item }}
        </li>
    </ul>
</template>

<style scoped></style>
