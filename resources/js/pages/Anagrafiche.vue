<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { anagrafiche } from '@/routes';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Anagrafiche',
                href: anagrafiche(),
            },
        ],
    },
});
</script>
<template>
    <Head title="Anagrafiche" />
</template>

<style scoped></style>
