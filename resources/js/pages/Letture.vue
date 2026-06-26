<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { letture } from '@/routes';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Letture',
                href: letture(),
            },
        ],
    },
});
</script>
<template>
    <Head title="Letture" />
</template>

<style scoped></style>
